<?php

declare(strict_types=1);

namespace Tests\Integration\Http;

use App\Modules\Http\Curl\CurlAdapterInterface;
use App\Modules\Http\Curl\CurlResponse;
use App\Modules\Http\Curl\NativeCurlAdapter;
use App\Modules\Http\CurlHttpClient;
use App\Modules\Http\Exceptions\HttpClientException;
use App\Modules\Http\HttpClient;
use App\Modules\Http\HttpException;
use App\Modules\Http\UrlHostPolicy;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Response-header size limit integration tests against a real fixture
 * server.
 *
 * A real PHP built-in web server serves responses with header regions of
 * exact, known sizes on 127.0.0.1. The native cURL adapter is exercised
 * directly with small injected header limits, so the streaming header
 * callback can be proven to accept header regions up to the limit and fail
 * closed above it without allocating huge amounts of memory. Redirect hop
 * isolation is covered at the CurlHttpClient layer with a mocked adapter,
 * because the SSRF destination policy blocks loopback before any transport
 * I/O and no external network is permitted.
 */
final class ResponseHeaderSizeLimitTest extends TestCase
{
    private const ROUTER = __DIR__ . '/../../Fixtures/Http/body-size-router.php';

    private const PROBE_LIMIT = 1024 * 1024;

    private int $port;

    /** @var resource|false|null */
    private $process;

    /** @var resource[] */
    private array $pipes = [];

    protected function setUp(): void
    {
        $this->port = $this->freePort();
        $this->startServer();

        try {
            $this->waitUntilReady();
        } catch (\Throwable $exception) {
            $this->tearDown();

            throw $exception;
        }
    }

    protected function tearDown(): void
    {
        foreach ($this->pipes as $pipe) {
            if (is_resource($pipe)) {
                fclose($pipe);
            }
        }

        if (isset($this->process) && is_resource($this->process)) {
            $process = $this->process;
            $this->terminateServer();
            proc_close($process);
        }

        if (PHP_OS_FAMILY === 'Windows' && $this->isPortListening()) {
            $listener = $this->listenerPidOnPort();

            if ($listener > 0) {
                exec('taskkill /F /T /PID ' . $listener . ' 2>NUL');
                $this->waitForPortRelease();
            }
        }
    }

    private function waitForPortRelease(): void
    {
        $deadline = microtime(true) + 2.0;

        while (microtime(true) < $deadline) {
            if (!$this->isPortListening()) {
                return;
            }

            usleep(100000);
        }
    }

    private function terminateServer(): void
    {
        $process = $this->process;

        if (!is_resource($process)) {
            return;
        }

        $status = proc_get_status($process);
        $pid = (int) $status['pid'];

        if ($pid > 0) {
            if (PHP_OS_FAMILY === 'Windows') {
                exec('taskkill /F /T /PID ' . $pid . ' 2>NUL');
            } else {
                proc_terminate($process);
            }
        }

        $deadline = microtime(true) + 3.0;

        while (microtime(true) < $deadline) {
            $status = proc_get_status($process);

            if (!$status['running']) {
                return;
            }

            usleep(100000);
        }

        if ($pid > 0 && PHP_OS_FAMILY === 'Windows') {
            exec('taskkill /F /T /PID ' . $pid . ' 2>NUL');
        }

        proc_terminate($process);
    }

    private function isPortListening(): bool
    {
        $socket = @fsockopen('127.0.0.1', $this->port, $errno, $errstr, 0.2);

        if (!is_resource($socket)) {
            return false;
        }

        fclose($socket);

        return true;
    }

    private function listenerPidOnPort(): int
    {
        $output = [];
        exec('netstat -ano | findstr 127.0.0.1:' . (int) $this->port . ' | findstr LISTENING', $output);

        foreach ($output as $line) {
            $parts = preg_split('/\s+/', trim($line));

            if (is_array($parts) && $parts !== []) {
                $pid = (int) end($parts);

                if ($pid > 0) {
                    return $pid;
                }
            }
        }

        return 0;
    }

    public function test_headers_below_the_limit_are_collected_fully(): void
    {
        $overhead = $this->headerOverhead();
        $adapter = new NativeCurlAdapter(maxHeaderBytes: $overhead + 4096 + 256);

        $response = $adapter->execute("http://127.0.0.1:{$this->port}/headers/4096", 5, 'Test/1.0');

        self::assertSame(200, $response->statusCode());
        self::assertSame($overhead + 4096, strlen($response->rawHeaders()));
        self::assertStringContainsString('X-Fill', $response->rawHeaders());
    }

    public function test_headers_exactly_at_the_limit_are_accepted(): void
    {
        $overhead = $this->headerOverhead();
        $adapter = new NativeCurlAdapter(maxHeaderBytes: $overhead + 4096);

        $response = $adapter->execute("http://127.0.0.1:{$this->port}/headers/4096", 5, 'Test/1.0');

        self::assertSame(200, $response->statusCode());
        self::assertSame($overhead + 4096, strlen($response->rawHeaders()));
    }

    public function test_headers_above_the_limit_fail_closed(): void
    {
        $overhead = $this->headerOverhead();
        $adapter = new NativeCurlAdapter(maxHeaderBytes: $overhead + 4096 - 1);

        $this->expectException(HttpClientException::class);
        $this->expectExceptionMessage('Response headers exceed the maximum allowed size.');

        $adapter->execute("http://127.0.0.1:{$this->port}/headers/4096", 5, 'Test/1.0');
    }

    public function test_adapter_handles_a_normal_request_after_a_prior_overflow(): void
    {
        $overhead = $this->headerOverhead();
        $adapter = new NativeCurlAdapter(maxHeaderBytes: $overhead + 256);

        try {
            $adapter->execute("http://127.0.0.1:{$this->port}/headers/2048", 5, 'Test/1.0');
            self::fail('An oversized header region must fail closed.');
        } catch (HttpClientException $exception) {
            self::assertSame('Response headers exceed the maximum allowed size.', $exception->getMessage());
        }

        $response = $adapter->execute("http://127.0.0.1:{$this->port}/size/512", 5, 'Test/1.0');

        self::assertSame(200, $response->statusCode());
        self::assertSame(str_repeat('x', 512), $response->body());
    }

    public function test_normal_body_streaming_works_with_the_default_header_limit(): void
    {
        $adapter = new NativeCurlAdapter();

        $response = $adapter->execute("http://127.0.0.1:{$this->port}/size/512", 5, 'Test/1.0');

        self::assertSame(200, $response->statusCode());
        self::assertSame(str_repeat('x', 512), $response->body());
    }

    public function test_redirect_hop_with_oversized_headers_fails_closed(): void
    {
        $adapter = $this->createAdapter();
        $url = 'https://example.com/';
        $redirectUrl = 'https://example.com/headers/65536';

        $adapter->expects(self::exactly(2))
            ->method('execute')
            ->willReturnCallback(function (string $currentUrl) use ($url, $redirectUrl): CurlResponse {
                return $currentUrl === $url
                    ? $this->redirectResponse($currentUrl, $redirectUrl)
                    : throw new HttpClientException('Response headers exceed the maximum allowed size.');
            });

        $client = new CurlHttpClient($adapter, 15, 'ThemeDetectorTool/2.0', $this->policy());

        $this->expectException(HttpClientException::class);
        $this->expectExceptionMessage('Response headers exceed the maximum allowed size.');

        $client->get($url);
    }

    public function test_legacy_http_client_rejects_loopback_before_the_header_limit_applies(): void
    {
        $client = new HttpClient(maxHeaderBytes: 1024);

        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Invalid URL.');

        $client->get("http://127.0.0.1:{$this->port}/headers/2048");
    }

    /**
     * Measure the fixed header-region overhead emitted by the fixture for
     * a non-empty fill value. The built-in server adds a small,
     * constant-size block around X-Fill, so the delivered header region for
     * /headers/N is exactly overhead + N bytes.
     *
     * The probe must use a non-empty fill value: PHP trims the trailing
     * space of a header whose value is empty, which would make the /headers/0
     * header line one byte shorter than the overhead + N formula.
     */
    private function headerOverhead(): int
    {
        $adapter = new NativeCurlAdapter(maxHeaderBytes: self::PROBE_LIMIT);

        $response = $adapter->execute("http://127.0.0.1:{$this->port}/headers/1", 5, 'Test/1.0');

        return strlen($response->rawHeaders()) - 1;
    }

    /**
     * @return CurlAdapterInterface&MockObject
     */
    private function createAdapter(): CurlAdapterInterface&MockObject
    {
        return $this->createMock(CurlAdapterInterface::class);
    }

    private function redirectResponse(string $url, string $location, int $status = 302): CurlResponse
    {
        return new CurlResponse(
            originalUrl: $url,
            finalUrl: $url,
            statusCode: $status,
            rawHeaders: "HTTP/1.1 {$status} Found\r\nLocation: {$location}\r\n\r\n",
            body: '',
        );
    }

    private function policy(): UrlHostPolicy
    {
        return new UrlHostPolicy(
            static fn (string $host): array => match ($host) {
                'example.com' => ['93.184.216.34'],
                default => [],
            },
        );
    }

    private function freePort(): int
    {
        $socket = stream_socket_server('tcp://127.0.0.1:0', $errno, $errstr);

        if ($socket === false) {
            self::fail("Could not allocate a free port: {$errstr}");
        }

        $name = stream_socket_get_name($socket, false);

        fclose($socket);

        return (int) substr((string) $name, strrpos((string) $name, ':') + 1);
    }

    private function startServer(): void
    {
        $command = sprintf(
            '%s -S 127.0.0.1:%d %s',
            escapeshellarg(PHP_BINARY),
            $this->port,
            escapeshellarg(self::ROUTER),
        );

        $descriptors = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];

        $this->process = proc_open($command, $descriptors, $this->pipes, null, null, ['bypass_shell' => true]);

        if (!is_resource($this->process)) {
            self::fail('Could not start the fixture web server.');
        }
    }

    private function waitUntilReady(): void
    {
        $deadline = microtime(true) + 5.0;

        while (microtime(true) < $deadline) {
            $socket = @fsockopen('127.0.0.1', $this->port, $errno, $errstr, 0.1);

            if (is_resource($socket)) {
                fclose($socket);

                return;
            }

            if (!is_resource($this->process)) {
                self::fail('Fixture web server is not running.');
            }

            $status = proc_get_status($this->process);

            if (!$status['running']) {
                $error = stream_get_contents($this->pipes[2]);

                self::fail('Fixture web server exited before becoming ready: ' . (string) $error);
            }

            usleep(100000);
        }

        self::fail('Fixture web server did not become ready in time.');
    }
}
