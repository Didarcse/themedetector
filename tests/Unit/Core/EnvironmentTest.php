<?php

declare(strict_types=1);

namespace Tests\Unit\Core;

use App\Core\Environment;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\BackupGlobals;
use PHPUnit\Framework\TestCase;

#[BackupGlobals(true)]
final class EnvironmentTest extends TestCase
{
    private const NAME = 'THEMEDETECTOR_ENVIRONMENT_TEST';

    protected function setUp(): void
    {
        $this->clearEnvironment();
    }

    protected function tearDown(): void
    {
        $this->clearEnvironment();
    }

    public function test_get_reads_process_environment(): void
    {
        putenv(self::NAME . '=process');

        self::assertSame('process', Environment::get(self::NAME));
    }

    public function test_get_reads_env_superglobal(): void
    {
        $_ENV[self::NAME] = 'env';

        self::assertSame('env', Environment::get(self::NAME));
    }

    public function test_get_reads_server_superglobal(): void
    {
        $_SERVER[self::NAME] = 'server';

        self::assertSame('server', Environment::get(self::NAME));
    }

    public function test_get_prefers_process_environment_over_superglobals(): void
    {
        putenv(self::NAME . '=process');
        $_ENV[self::NAME] = 'env';
        $_SERVER[self::NAME] = 'server';

        self::assertSame('process', Environment::get(self::NAME));
    }

    public function test_get_prefers_env_superglobal_over_server_superglobal(): void
    {
        $_ENV[self::NAME] = 'env';
        $_SERVER[self::NAME] = 'server';

        self::assertSame('env', Environment::get(self::NAME));
    }

    public function test_get_treats_empty_values_as_missing(): void
    {
        putenv(self::NAME . '=');
        $_ENV[self::NAME] = '';
        $_SERVER[self::NAME] = '';

        self::assertNull(Environment::get(self::NAME));
    }

    public function test_int_reads_process_environment(): void
    {
        putenv(self::NAME . '=42');

        self::assertSame(42, Environment::int(self::NAME, 10));
    }

    public function test_int_reads_env_superglobal(): void
    {
        $_ENV[self::NAME] = '42';

        self::assertSame(42, Environment::int(self::NAME, 10));
    }

    public function test_int_returns_default_when_missing(): void
    {
        self::assertSame(10, Environment::int(self::NAME, 10));
    }

    public function test_int_allows_zero(): void
    {
        putenv(self::NAME . '=0');

        self::assertSame(0, Environment::int(self::NAME, 10));
    }

    public function test_int_rejects_non_integer(): void
    {
        $_ENV[self::NAME] = 'not-an-integer';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(self::NAME);

        Environment::int(self::NAME, 10);
    }

    public function test_int_rejects_float(): void
    {
        $_ENV[self::NAME] = '1.5';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(self::NAME);

        Environment::int(self::NAME, 10);
    }

    private function clearEnvironment(): void
    {
        putenv(self::NAME);
        unset($_ENV[self::NAME], $_SERVER[self::NAME]);
    }
}
