<?php

declare(strict_types=1);

namespace Tests\Unit\Security;

use App\Security\SessionManager;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Tests\Support\FakeSessionDriver;

/**
 * Unit tests for session configuration, fixation protection, and failures.
 */
final class SessionManagerTest extends TestCase
{
    /** @var list<string> */
    private array $paths = [];

    protected function tearDown(): void
    {
        foreach ($this->paths as $path) {
            if (is_dir($path)) {
                @rmdir($path);
            } elseif (is_file($path)) {
                @unlink($path);
            }
        }

        $this->paths = [];
    }

    public function test_options_enable_strict_secure_session_defaults(): void
    {
        $options = SessionManager::options(true);

        self::assertSame('1', $options['session.use_strict_mode']);
        self::assertSame('1', $options['session.use_only_cookies']);
        self::assertSame('0', $options['session.use_trans_sid']);
        self::assertSame('1', $options['session.cookie_httponly']);
        self::assertSame('Lax', $options['session.cookie_samesite']);
        self::assertSame('1', $options['session.cookie_secure']);
        self::assertSame('/', $options['session.cookie_path']);
        self::assertSame('', $options['session.cookie_domain']);
        self::assertSame('48', $options['session.sid_length']);
        self::assertSame('6', $options['session.sid_bits_per_character']);
    }

    public function test_options_disable_secure_cookie_for_plain_http(): void
    {
        self::assertSame('0', SessionManager::options(false)['session.cookie_secure']);
    }

    public function test_start_applies_the_expected_name_options_and_path(): void
    {
        $driver = new FakeSessionDriver();
        $path = $this->temporaryPath();
        $manager = new SessionManager($driver, $path, true);

        $manager->start();

        self::assertSame(SessionManager::COOKIE_NAME, $driver->name);
        self::assertSame($path, $driver->savePath);
        self::assertSame('1', $driver->options['session.cookie_secure']);
    }

    public function test_new_session_regenerates_its_identifier_once(): void
    {
        $driver = new FakeSessionDriver();
        $manager = new SessionManager($driver, $this->temporaryPath(), false);

        $manager->start();
        $manager->start();

        self::assertSame(1, $driver->startCount);
        self::assertSame(1, $driver->regenerateCount);
    }

    public function test_existing_session_does_not_regenerate_its_identifier(): void
    {
        $driver = new FakeSessionDriver();
        $driver->cookiePresent = true;
        $manager = new SessionManager($driver, $this->temporaryPath(), false);

        $manager->start();

        self::assertSame(0, $driver->regenerateCount);
    }

    public function test_startup_failure_fails_closed(): void
    {
        $driver = new FakeSessionDriver();
        $driver->startResult = false;
        $manager = new SessionManager($driver, $this->temporaryPath(), false);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unable to start the session.');

        $manager->start();
    }

    public function test_identifier_regeneration_failure_fails_closed(): void
    {
        $driver = new FakeSessionDriver();
        $driver->regenerateResult = false;
        $manager = new SessionManager($driver, $this->temporaryPath(), false);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unable to establish a fresh session identifier.');

        $manager->start();
    }

    public function test_starting_after_output_fails_closed(): void
    {
        $driver = new FakeSessionDriver();
        $driver->headersSent = true;
        $manager = new SessionManager($driver, $this->temporaryPath(), false);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Cannot start the session after output has been sent.');

        $manager->start();
    }

    public function test_persistence_failure_fails_closed(): void
    {
        $driver = new FakeSessionDriver();
        $driver->closeResult = false;
        $manager = new SessionManager($driver, $this->temporaryPath(), false);
        $manager->start();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unable to persist the session.');

        $manager->close();
    }

    public function test_close_is_a_no_op_when_the_session_is_not_active(): void
    {
        $driver = new FakeSessionDriver();
        $manager = new SessionManager($driver, $this->temporaryPath(), false);

        $manager->close();

        self::assertSame(0, $driver->closeCount);
    }

    public function test_session_values_round_trip(): void
    {
        $driver = new FakeSessionDriver();
        $manager = new SessionManager($driver, $this->temporaryPath(), false);

        $manager->set('key', 'value');

        self::assertSame('value', $manager->get('key'));

        $manager->remove('key');

        self::assertNull($manager->get('key'));
    }

    public function test_missing_storage_directory_is_created(): void
    {
        $driver = new FakeSessionDriver();
        $path = $this->temporaryPath();
        $manager = new SessionManager($driver, $path, false);

        $manager->start();

        self::assertDirectoryExists($path);
    }

    public function test_storage_path_that_is_a_file_fails_closed(): void
    {
        $driver = new FakeSessionDriver();
        $path = $this->temporaryPath();
        file_put_contents($path, 'not a directory');
        $this->paths[] = $path;
        $manager = new SessionManager($driver, $path, false);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unable to create the session storage directory.');

        $manager->start();
    }

    private function temporaryPath(): string
    {
        $path = sys_get_temp_dir() . '/session-manager-test-' . uniqid('', true);
        $this->paths[] = $path;

        return $path;
    }
}
