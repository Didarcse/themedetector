<?php

declare(strict_types=1);

namespace Tests\Integration\Core;

use App\Api\RateLimiter;
use App\Api\WorkloadGuard;
use App\Core\Container;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\BackupGlobals;
use PHPUnit\Framework\TestCase;

#[BackupGlobals(true)]
final class BootstrapEnvironmentConfigurationTest extends TestCase
{
    private const API_MAX_CONCURRENT = 'API_MAX_CONCURRENT';
    private const WEB_LIMIT = 'WEB_DETECT_LIMIT';
    private const WEB_WINDOW = 'WEB_DETECT_WINDOW';

    protected function setUp(): void
    {
        $this->clearEnvironment(self::API_MAX_CONCURRENT);
        $this->clearEnvironment(self::WEB_LIMIT);
        $this->clearEnvironment(self::WEB_WINDOW);
    }

    protected function tearDown(): void
    {
        $this->clearEnvironment(self::API_MAX_CONCURRENT);
        $this->clearEnvironment(self::WEB_LIMIT);
        $this->clearEnvironment(self::WEB_WINDOW);
    }

    public function test_bootstrap_reads_web_configuration_from_env_superglobal(): void
    {
        $_ENV[self::WEB_LIMIT] = '3';
        $_ENV[self::WEB_WINDOW] = '120';

        self::assertSame(
            ['limit' => 3, 'window' => 120],
            $this->webRateLimitConfig(),
        );
    }

    public function test_bootstrap_reads_web_configuration_from_process_environment(): void
    {
        putenv(self::WEB_LIMIT . '=5');
        putenv(self::WEB_WINDOW . '=60');

        self::assertSame(
            ['limit' => 5, 'window' => 60],
            $this->webRateLimitConfig(),
        );
    }

    public function test_bootstrap_uses_defaults_when_web_configuration_is_missing(): void
    {
        $_ENV[self::WEB_LIMIT] = '';
        $_ENV[self::WEB_WINDOW] = '';
        $_SERVER[self::WEB_LIMIT] = '';
        $_SERVER[self::WEB_WINDOW] = '';

        self::assertSame(
            ['limit' => 10, 'window' => 900],
            $this->webRateLimitConfig(),
        );
    }

    public function test_bootstrap_reads_zero_max_concurrent_from_env_superglobal(): void
    {
        $_ENV[self::API_MAX_CONCURRENT] = '0';

        $guard = $this->bootstrapContainer()->get(WorkloadGuard::class);
        self::assertInstanceOf(WorkloadGuard::class, $guard);

        self::assertSame(
            0,
            $this->readIntegerProperty(new \ReflectionClass($guard), $guard, 'maxConcurrent'),
        );
    }

    public function test_bootstrap_rejects_non_integer_web_limit(): void
    {
        $_ENV[self::WEB_LIMIT] = 'not-an-integer';
        $_ENV[self::WEB_WINDOW] = '900';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(self::WEB_LIMIT);

        $this->webRateLimitConfig();
    }

    public function test_bootstrap_rejects_zero_web_window(): void
    {
        $_ENV[self::WEB_LIMIT] = '10';
        $_ENV[self::WEB_WINDOW] = '0';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('at least 1 second');

        $this->webRateLimitConfig();
    }

    /**
     * @return array{limit: int, window: int}
     */
    private function webRateLimitConfig(): array
    {
        $limiter = $this->bootstrapContainer()->get('web.rate_limiter');
        self::assertInstanceOf(RateLimiter::class, $limiter);

        $reflection = new \ReflectionClass($limiter);

        return [
            'limit' => $this->readIntegerProperty($reflection, $limiter, 'limit'),
            'window' => $this->readIntegerProperty($reflection, $limiter, 'windowSeconds'),
        ];
    }

    private function bootstrapContainer(): Container
    {
        require dirname(__DIR__, 3) . '/bootstrap/app.php';

        $container = $GLOBALS['app'] ?? null;
        self::assertInstanceOf(Container::class, $container);

        return $container;
    }

    /**
     * @param \ReflectionClass<object> $reflection
     */
    private function readIntegerProperty(
        \ReflectionClass $reflection,
        object $subject,
        string $property,
    ): int {
        $value = $reflection->getProperty($property)->getValue($subject);
        self::assertIsInt($value);

        return $value;
    }

    private function clearEnvironment(string $name): void
    {
        putenv($name);
        unset($_ENV[$name], $_SERVER[$name]);
    }
}
