<?php

declare(strict_types=1);

namespace Tests\Unit\Security;

use App\Security\CsrfTokenManager;
use PHPUnit\Framework\TestCase;
use Tests\Support\InMemoryCsrfTokenStore;

/**
 * Unit tests for the synchronizer CSRF token manager.
 */
final class CsrfTokenManagerTest extends TestCase
{
    public function test_token_is_generated_with_256_bits_of_entropy(): void
    {
        $manager = new CsrfTokenManager(new InMemoryCsrfTokenStore());

        $token = $manager->token();

        self::assertSame(64, strlen($token));
        self::assertMatchesRegularExpression('/^[0-9a-f]{64}$/', $token);
    }

    public function test_token_is_stable_for_the_life_of_the_store(): void
    {
        $manager = new CsrfTokenManager(new InMemoryCsrfTokenStore());

        self::assertSame($manager->token(), $manager->token());
    }

    public function test_valid_token_is_accepted(): void
    {
        $manager = new CsrfTokenManager(new InMemoryCsrfTokenStore());
        $token = $manager->token();

        self::assertTrue($manager->validate($token));
    }

    public function test_missing_token_is_rejected(): void
    {
        $manager = new CsrfTokenManager(new InMemoryCsrfTokenStore());

        self::assertFalse($manager->validate(null));
        self::assertFalse($manager->validate(''));
    }

    public function test_non_string_token_is_rejected(): void
    {
        $manager = new CsrfTokenManager(new InMemoryCsrfTokenStore());
        $manager->token();

        self::assertFalse($manager->validate(123));
        self::assertFalse($manager->validate(['token']));
    }

    public function test_invalid_token_is_rejected(): void
    {
        $manager = new CsrfTokenManager(new InMemoryCsrfTokenStore());
        $manager->token();

        self::assertFalse($manager->validate(str_repeat('a', 64)));
    }

    public function test_expired_token_is_rejected(): void
    {
        $store = new InMemoryCsrfTokenStore();
        $manager = new CsrfTokenManager($store);
        $token = $manager->token();

        $store->clear();

        self::assertFalse($manager->validate($token));
    }

    public function test_validation_does_not_create_a_token(): void
    {
        $store = new InMemoryCsrfTokenStore();
        $manager = new CsrfTokenManager($store);

        self::assertFalse($manager->validate('anything'));
        self::assertNull($store->get());
    }

    public function test_sessions_are_isolated(): void
    {
        $first = new CsrfTokenManager(new InMemoryCsrfTokenStore());
        $second = new CsrfTokenManager(new InMemoryCsrfTokenStore());

        self::assertNotSame($first->token(), $second->token());
        self::assertFalse($second->validate($first->token()));
    }

    public function test_rotation_issues_a_new_token(): void
    {
        $manager = new CsrfTokenManager(new InMemoryCsrfTokenStore());
        $original = $manager->token();

        $manager->rotate();
        $rotated = $manager->token();

        self::assertNotSame($original, $rotated);
        self::assertFalse($manager->validate($original));
        self::assertTrue($manager->validate($rotated));
    }

    public function test_release_closes_the_backing_store(): void
    {
        $store = new InMemoryCsrfTokenStore();
        $manager = new CsrfTokenManager($store);

        $manager->release();

        self::assertSame(1, $store->closeCount());
    }
}
