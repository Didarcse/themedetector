<?php

declare(strict_types=1);

namespace Tests\Unit\Api;

use App\Api\ApiKeyStore;
use PHPUnit\Framework\Attributes\BackupGlobals;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the API key store.
 *
 * Verifies that keys are trimmed and deduplicated at construction, validated
 * in constant time, and loaded from the environment exactly as the
 * configuration contract prescribes (API_KEYS bulk list plus the API_KEY
 * single fallback).
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Fast, deterministic, and independent.
 * - Environment mutations are saved and restored so tests never leak
 *   process state.
 */
#[BackupGlobals(true)]
final class ApiKeyStoreTest extends TestCase
{
    protected function tearDown(): void
    {
        $this->restoreEnvironment('API_KEYS');
        $this->restoreEnvironment('API_KEY');
    }

    public function test_accepts_configured_keys_and_trims_them(): void
    {
        $store = new ApiKeyStore(['alpha', ' beta ', '', 'alpha']);

        self::assertTrue($store->hasKeys());
        self::assertTrue($store->validate('alpha'));
        self::assertTrue($store->validate('beta'));
        self::assertFalse($store->validate(''));
        self::assertFalse($store->validate('gamma'));
        self::assertFalse($store->validate(' alpha '));
    }

    public function test_empty_store_has_no_keys(): void
    {
        $store = new ApiKeyStore([]);

        self::assertFalse($store->hasKeys());
        self::assertFalse($store->validate('anything'));
    }

    public function test_validation_is_case_sensitive(): void
    {
        $store = new ApiKeyStore(['SecretKey']);

        self::assertTrue($store->validate('SecretKey'));
        self::assertFalse($store->validate('secretkey'));
        self::assertFalse($store->validate('SECRETKEY'));
    }

    public function test_from_environment_reads_comma_separated_keys(): void
    {
        $this->setEnvironment('API_KEYS', 'k1, k2 ,k3');

        $store = ApiKeyStore::fromEnvironment();

        self::assertTrue($store->validate('k1'));
        self::assertTrue($store->validate('k2'));
        self::assertTrue($store->validate('k3'));
        self::assertFalse($store->validate('k4'));
    }

    public function test_from_environment_falls_back_to_single_key(): void
    {
        $this->setEnvironment('API_KEY', 'solo');

        $store = ApiKeyStore::fromEnvironment();

        self::assertTrue($store->validate('solo'));
        self::assertFalse($store->validate('other'));
    }

    public function test_from_environment_combines_bulk_and_single_keys(): void
    {
        $this->setEnvironment('API_KEYS', 'k1');
        $this->setEnvironment('API_KEY', 'k2');

        $store = ApiKeyStore::fromEnvironment();

        self::assertTrue($store->validate('k1'));
        self::assertTrue($store->validate('k2'));
    }

    public function test_from_environment_without_configuration_has_no_keys(): void
    {
        $this->setEnvironment('API_KEYS', '');
        $this->setEnvironment('API_KEY', '');

        $store = ApiKeyStore::fromEnvironment();

        self::assertFalse($store->hasKeys());
    }

    private function setEnvironment(string $name, string $value): void
    {
        if ($value === '') {
            putenv($name);
            unset($_ENV[$name], $_SERVER[$name]);

            return;
        }

        putenv($name . '=' . $value);
        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }

    private function restoreEnvironment(string $name): void
    {
        putenv($name);
        unset($_ENV[$name], $_SERVER[$name]);
    }
}
