<?php

declare(strict_types=1);

namespace Tests\Integration\Http;

use App\Modules\Detection\WordPress\Rules\WPJsonRule;
use App\Modules\Http\Curl\NativeCurlAdapter;
use App\Modules\Http\CurlHttpClient;
use App\Modules\Http\Exceptions\HttpClientException;
use App\Modules\Http\HttpClient;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssDownloader;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * SSRF protection integration tests against a real local fixture server.
 *
 * A real PHP built-in web server is started on 127.0.0.1 for the duration
 * of the suite. Every request the fixture server receives is appended to
 * an SSRF_HIT_LOG file, so tests can assert both the client behaviour and
 * the fact that no request ever reached the fixture.
 */
final class SsrfProtectionTest extends TestCase
{
    private const ROUTER = __DIR__ . '/../../Fixtures/Http/ssrf-router.php';

    private int $port;

    /** @var resource|false|null */
    private $process;

    /** @var resource[] */
    private array $pipes = [];

    private string $hitLog;

    protected function setUp(): void
    {
        $this->port = $this->freePort();
        $this->hitLog = sys_get_temp_dir() . '/ssrf-hit-' . uniqid('', true) . '.log';
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

        @unlink($this->hitLog);
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

    /**
     * Terminate the fixture web server with a bounded shutdown timeout.
     *
     * On Windows proc_open wraps the command in a cmd.exe shim unless
     * bypass_shell is set; the real php -S server is its child. Killing only
     * the shim orphans the server while its port keeps accepting, so the whole
     * process tree is terminated instead.
     */
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

    #[DataProvider('unsafeUrlProvider')]
    public function test_unsafe_initial_urls_are_rejected_without_any_request(string $urlTemplate): void
    {
        $url = sprintf($urlTemplate, $this->port);

        $this->expectException(HttpClientException::class);
        $this->expectExceptionMessage('Invalid URL.');

        $this->client()->get($url);

        self::assertHitLogEmpty($this->hitLog);
    }

    public function test_loopback_oracle_is_eliminated(): void
    {
        $openPort = $this->port;
        $closedPort = $this->port + 100;

        $openMessage = $this->captureExceptionMessage($this->client(), "http://127.0.0.1:{$openPort}/");
        $closedMessage = $this->captureExceptionMessage($this->client(), "http://127.0.0.1:{$closedPort}/");

        self::assertSame('Invalid URL.', $openMessage);
        self::assertSame($openMessage, $closedMessage);
        self::assertHitLogEmpty($this->hitLog);
    }

    public function test_localhost_hostname_is_rejected(): void
    {
        $url = "http://localhost:{$this->port}/internal";

        $this->expectException(HttpClientException::class);
        $this->expectExceptionMessage('Invalid URL.');

        $this->client()->get($url);

        self::assertHitLogEmpty($this->hitLog);
    }

    public function test_style_css_fan_out_download_is_blocked(): void
    {
        $downloader = new WordPressStyleCssDownloader(
            new CurlHttpClient(new NativeCurlAdapter(), 5, 'ThemeDetectorTool/2.0'),
        );

        $result = $downloader->download("http://127.0.0.1:{$this->port}/internal");

        self::assertNull($result);
        self::assertHitLogEmpty($this->hitLog);
    }

    public function test_wp_json_probe_fan_out_is_blocked(): void
    {
        $rule = new WPJsonRule(new HttpClient());
        $result = $rule->evaluate('', "http://127.0.0.1:{$this->port}/");

        self::assertFalse($result['matched']);
        self::assertHitLogEmpty($this->hitLog);
    }

    public function test_safe_public_target_is_reachable_when_network_is_available(): void
    {
        $response = $this->client()->get('https://example.com/');

        self::assertSame(200, $response->statusCode());
    }

    private function client(): CurlHttpClient
    {
        return new CurlHttpClient(new NativeCurlAdapter(), 15, 'ThemeDetectorTool/2.0');
    }

    private function captureExceptionMessage(CurlHttpClient $client, string $url): ?string
    {
        try {
            $client->get($url);

            return null;
        } catch (HttpClientException $exception) {
            return $exception->getMessage();
        }
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
        yield 'ftp scheme' => ['ftp://example.com/'];
        yield 'file scheme' => ['file:///etc/passwd'];
        yield 'gopher scheme' => ['gopher://example.com/'];
    }
}
