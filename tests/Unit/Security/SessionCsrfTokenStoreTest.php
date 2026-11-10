<?php

declare(strict_types=1);

namespace Tests\Unit\Security;

use App\Security\SessionCsrfTokenStore;
use App\Security\SessionManager;
use PHPUnit\Framework\TestCase;
use Tests\Support\FakeSessionDriver;

/**
 * Unit tests for the session-backed CSRF token store.
 */
final class SessionCsrfTokenStoreTest extends TestCase
{
    public function test_token_round_trips_through_the_session(): void
    {
        $driver = new FakeSessionDriver();
        $store = new SessionCsrfTokenStore($this->session($driver));

        $store->put('token-value');

        self::assertSame('token-value', $store->get());
    }

    public function test_empty_stored_value_is_treated_as_missing(): void
    {
        $driver = new FakeSessionDriver();
        $driver->cookiePresent = true;
        $session = $this->session($driver);
        $session->set('_csrf_token', '');

        $store = new SessionCsrfTokenStore($session);

        self::assertNull($store->get());
    }

    public function test_token_remains_available_after_the_session_lock_is_released(): void
    {
        $driver = new FakeSessionDriver();
        $store = new SessionCsrfTokenStore($this->session($driver));
        $store->put('token-value');

        $store->close();

        self::assertSame(1, $driver->closeCount);
        self::assertSame('token-value', $store->get());
    }

    public function test_clear_removes_the_token(): void
    {
        $driver = new FakeSessionDriver();
        $store = new SessionCsrfTokenStore($this->session($driver));
        $store->put('token-value');

        $store->clear();

        self::assertNull($store->get());
        self::assertNull($driver->get('_csrf_token'));
    }

    private function session(FakeSessionDriver $driver): SessionManager
    {
        return new SessionManager($driver, sys_get_temp_dir(), false);
    }
}
