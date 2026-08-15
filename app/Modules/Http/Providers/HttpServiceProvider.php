<?php

declare(strict_types=1);

namespace App\Modules\Http\Providers;

use App\Core\Container;
use App\Core\Contracts\ServiceProviderInterface;
use App\Modules\Http\BoundedBodyCollector;
use App\Modules\Http\BoundedHeaderCollector;
use App\Modules\Http\Curl\NativeCurlAdapter;
use App\Modules\Http\CurlHttpClient;
use App\Modules\Http\HttpClientInterface;

/**
 * Registers all HTTP Infrastructure services into the dependency injection
 * container.
 *
 * This provider groups HTTP-related service registrations into a single
 * cohesive unit. It serves as the composition root for the HTTP module and
 * performs service registration only.
 *
 * Responsibilities:
 *
 * - Register HTTP Infrastructure services into the container.
 *
 * Design philosophy:
 *
 * - Service Provider: registrations are grouped into cohesive units.
 * - Dependency Injection and Inversion of Control: HTTP consumers depend
 *   on HttpClientInterface, never on a concrete transport.
 * - Single Responsibility Principle: HTTP registration only.
 * - Open/Closed Principle: the HTTP module grows by adding providers,
 *   never by modifying existing ones.
 * - Lazy service registration: the client is constructed only on first
 *   resolution.
 * - Stateless, side-effect free, and deterministic.
 */
final class HttpServiceProvider implements ServiceProviderInterface
{
    /**
     * Register the HTTP Infrastructure services with the given container.
     *
     * Binds HttpClientInterface to a lazy factory that constructs the
     * cURL-backed client on first resolution. The registration is
     * idempotent: if the service is already registered, nothing changes.
     *
     * @param Container $container The application dependency injection
     *                             container receiving the registrations.
     *
     * @return void
     */
    public function register(Container $container): void
    {
        if ($container->has(HttpClientInterface::class)) {
            return;
        }

        $container->set(
            HttpClientInterface::class,
            fn (Container $container): HttpClientInterface => new CurlHttpClient(
                new NativeCurlAdapter(
                    maxResponseBytes: self::maxResponseBytes(),
                    maxHeaderBytes: self::maxHeaderBytes(),
                ),
            ),
        );
    }

    /**
     * Resolve the configured maximum response-body size in bytes.
     *
     * Reads the HTTP_MAX_RESPONSE_BYTES environment variable when it holds
     * a positive integer and falls back to the collector default otherwise.
     *
     * @return int The maximum response-body size in bytes.
     */
    private static function maxResponseBytes(): int
    {
        $value = getenv('HTTP_MAX_RESPONSE_BYTES');

        return is_string($value) && is_numeric($value) && (int) $value > 0
            ? (int) $value
            : BoundedBodyCollector::DEFAULT_MAX_BYTES;
    }

    /**
     * Resolve the configured maximum response-header size in bytes.
     *
     * Reads the HTTP_MAX_HEADER_BYTES environment variable when it holds a
     * positive integer and falls back to the collector default otherwise.
     *
     * @return int The maximum response-header size in bytes.
     */
    private static function maxHeaderBytes(): int
    {
        $value = getenv('HTTP_MAX_HEADER_BYTES');

        return is_string($value) && is_numeric($value) && (int) $value > 0
            ? (int) $value
            : BoundedHeaderCollector::DEFAULT_MAX_BYTES;
    }
}
