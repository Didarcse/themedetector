<?php

declare(strict_types=1);

namespace Tests\Integration\Api;

use App\Core\Response;
use App\Modules\Http\Curl\NativeCurlAdapter;
use App\Modules\Http\CurlHttpClient;
use PHPUnit\Framework\Attributes\BackupGlobals;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\Support\ApiTestKernel;

/**
 * SSRF regression tests for the public API against a real local fixture.
 *
 * A real PHP built-in web server is started on 127.0.0.1 for the duration
 * of the suite. The API endpoint is exercised through a production-shaped
 * kernel whose primary HTTP client is the real CurlHttpClient, so the only
 * way any request could reach the fixture is through the API itself. Every
 * request the fixture receives is appended to an SSRF_HIT_LOG file, so the
 * tests can assert both the public error contract and the fact that no
 * request ever reached the fixture.
 *
 * Design philosophy:
 *
 * - Real transport: no fake is installed for the outbound path, so a
 *   regression in UrlHostPolicy or the fan-out would be detected.
 * - Deterministic: loopback and private targets are rejected before any
 *   connection, so no test ever depends on network availability.
 */
#[BackupGlobals(true)]
final class ApiV1SsrfProtectionTest extends TestCase
{
    private const ROUTER = __DIR__ . '/../../Fixtures/Http/ssrf-router.php';

    private int $port;

    /** @var resource|false|null */
    private $process;

    /** @var resource[] */
    private array $pipes = [];

    private string $hitLog;

    private ApiTestKernel $kernel;

    protected function setUp(): void
    {
        $this->port = $this->freePort();
        $this->hitLog = sys_get_temp_dir() . '/ssrf-api-hit-' . uniqid('', true);
        $this->startServer();

        try {
            $this->waitUntilReady();
            $this->kernel = ApiTestKernel::create(
                client: new CurlHttpClient(new NativeCurlAdapter()),
            );
        } catch (\Throwable $exception) {
            $this->tearDown();

            throw $exception;
        }
    }

    protected function tearDown(): void
    {
        if (isset($this->kernel)) {
            $this->kernel->cleanup();
        }

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

        @unlink($this->hitLog);
    }

    #[DataProvider('unsafeUrlProvider')]
    public function test_internal_targets_are_never_reached(string $urlTemplate): void
    {
        $url = sprintf($urlTemplate, $this->port);

        $response = $this->kernel->handle(
            json_encode(['url' => $url], JSON_THROW_ON_ERROR),
            ['HTTP_CONTENT_TYPE' => 'application/json'],
        );

        self::assertSame(200, $response->status());

        $payload = json_decode($response->content(), true);
        self::assertIsArray($payload);
        self::assertFalse($payload['success']);
        self::assertNull($payload['data']);

        $errors = $payload['errors'];
        self::assertIsArray($errors);

        $error = $errors[0];
        self::assertIsArray($error);
        self::assertSame('transport_failure', $error['code']);
        self::assertSame(['code', 'message'], array_keys($error));

        self::assertHitLogEmpty($this->hitLog);
    }

    public function test_validation_errors_never_reach_the_network(): void
    {
        $response = $this->kernel->handle('{not json', ['HTTP_CONTENT_TYPE' => 'application/json']);

        self::assertSame(400, $response->status());
        self::assertHitLogEmpty($this->hitLog);
    }

    public function test_unsupported_schemes_never_reach_the_network(): void
    {
        $urls = [
            'ftp://example.com',
            'file:///etc/passwd',
            'gopher://example.com',
        ];

        foreach ($urls as $url) {
            $response = $this->kernel->handle(
                json_encode(['url' => $url], JSON_THROW_ON_ERROR),
                ['HTTP_CONTENT_TYPE' => 'application/json'],
            );

            self::assertSame(422, $response->status(), 'url: ' . $url);
            self::assertSame('url_invalid_format', $this->errorCode($response), 'url: ' . $url);
        }

        self::assertHitLogEmpty($this->hitLog);
    }

    /**
     * Return the first envelope error code of a response.
     */
    private function errorCode(Response $response): string
    {
        $payload = json_decode($response->content(), true);
        self::assertIsArray($payload);

        $errors = $payload['errors'];
        self::assertIsArray($errors);

        $error = $errors[0];
        self::assertIsArray($error);

        $code = $error['code'];
        self::assertIsString($code);

        return $code;
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

        $env = array_merge(getenv(), ['SSRF_HIT_LOG' => $this->hitLog]);

        $descriptors = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];

        $this->process = proc_open($command, $descriptors, $this->pipes, null, $env, ['bypass_shell' => true]);

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
            $current = proc_get_status($process);

            if (!$current['running']) {
                return;
            }

            usleep(100000);
        }

        if ($pid > 0 && PHP_OS_FAMILY === 'Windows') {
            exec('taskkill /F /T /PID ' . $pid . ' 2>NUL');
        }

        proc_terminate($process);
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

    private static function assertHitLogEmpty(string $hitLog): void
    {
        $contents = is_file($hitLog) ? (string) file_get_contents($hitLog) : '';

        self::assertSame('', $contents, 'A request reached the fixture server.');
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function unsafeUrlProvider(): iterable
    {
        yield 'loopback' => ['http://127.0.0.1:%d/internal'];
        yield 'loopback short dotted' => ['http://127.1:%d/internal'];
        yield 'loopback integer' => ['http://2130706433:%d/internal'];
        yield 'loopback hex' => ['http://0x7f000001:%d/internal'];
        yield 'loopback octal parts' => ['http://0177.0.0.1:%d/internal'];
        yield 'any address' => ['http://0:%d/internal'];
        yield 'private 10/8' => ['http://10.0.0.1:%d/internal'];
        yield 'private 172.16/12' => ['http://172.16.0.1:%d/internal'];
        yield 'private 192.168/16' => ['http://192.168.1.1:%d/internal'];
        yield 'link local' => ['http://169.254.169.254:%d/internal'];
        yield 'loopback v6' => ['http://[::1]:%d/internal'];
        yield 'mapped loopback v6' => ['http://[::ffff:127.0.0.1]:%d/internal'];
        yield 'mapped private v6' => ['http://[::ffff:10.0.0.1]:%d/internal'];
        yield 'localhost hostname' => ['http://localhost:%d/internal'];
    }
}
