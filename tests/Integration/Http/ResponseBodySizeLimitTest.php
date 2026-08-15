<?php

declare(strict_types=1);

namespace Tests\Integration\Http;

use App\Modules\Http\Curl\NativeCurlAdapter;
use App\Modules\Http\Exceptions\HttpClientException;
use PHPUnit\Framework\TestCase;

/**
 * Response-body size limit integration tests against a real fixture server.
 *
 * A real PHP built-in web server serves bodies of exact, known sizes on
 * 127.0.0.1. The native cURL adapter is exercised directly with small
 * injected limits, so the streaming write callback can be proven to accept
 * bodies up to the limit and fail closed above it without allocating huge
 * amounts of memory.
 */
final class ResponseBodySizeLimitTest extends TestCase
{
    private const ROUTER = __DIR__ . '/../../Fixtures/Http/body-size-router.php';

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

    public function test_response_below_the_limit_is_collected_fully(): void
    {
        $adapter = new NativeCurlAdapter(maxResponseBytes: 1024);

        $response = $adapter->execute("http://127.0.0.1:{$this->port}/size/512", 5, 'Test/1.0');

        self::assertSame(200, $response->statusCode());
        self::assertSame(str_repeat('x', 512), $response->body());
        self::assertStringContainsString('Content-Type', $response->rawHeaders());
    }

    public function test_response_exactly_at_the_limit_is_accepted(): void
    {
        $adapter = new NativeCurlAdapter(maxResponseBytes: 1024);

        $response = $adapter->execute("http://127.0.0.1:{$this->port}/size/1024", 5, 'Test/1.0');

        self::assertSame(200, $response->statusCode());
        self::assertSame(1024, strlen($response->body()));
    }

    public function test_response_above_the_limit_fails_closed(): void
    {
        $adapter = new NativeCurlAdapter(maxResponseBytes: 1024);

        $this->expectException(HttpClientException::class);
        $this->expectExceptionMessage('Response body exceeds the maximum allowed size.');

        $adapter->execute("http://127.0.0.1:{$this->port}/size/2048", 5, 'Test/1.0');
    }

    public function test_normal_response_is_accepted_with_the_default_limit(): void
    {
        $adapter = new NativeCurlAdapter();

        $response = $adapter->execute("http://127.0.0.1:{$this->port}/size/512", 5, 'Test/1.0');

        self::assertSame(200, $response->statusCode());
        self::assertSame(str_repeat('x', 512), $response->body());
    }

    public function test_limit_is_enforced_per_request(): void
    {
        $adapter = new NativeCurlAdapter(maxResponseBytes: 1024);

        $response = $adapter->execute("http://127.0.0.1:{$this->port}/size/512", 5, 'Test/1.0');

        self::assertSame(512, strlen($response->body()));

        $this->expectException(HttpClientException::class);
        $this->expectExceptionMessage('Response body exceeds the maximum allowed size.');

        $adapter->execute("http://127.0.0.1:{$this->port}/size/2048", 5, 'Test/1.0');
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
