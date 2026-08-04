<?php

declare(strict_types=1);

namespace App\Core\Providers;

use App\Core\Container;
use App\Core\Contracts\ServiceProviderInterface;

/**
 * Registers the core framework services into the dependency injection
 * container.
 *
 * This provider groups framework-level service registrations into a single
 * cohesive unit. It serves as the foundation for all future service
 * providers and performs service registration only.
 *
 * Responsibilities:
 *
 * - Register framework-level services into the container.
 *
 * Design philosophy:
 *
 * - Service Provider: registrations are grouped into cohesive units.
 * - Dependency Injection and Inversion of Control: services are wired into
 *   the container; consumers never construct them directly.
 * - Single Responsibility Principle: framework registration only.
 * - Open/Closed Principle: bootstrap grows by adding providers, never by
 *   modifying existing ones.
 * - Stateless, side-effect free, and deterministic.
 */
final class FrameworkServiceProvider implements ServiceProviderInterface
{
    /**
     * Register the framework-level services with the given container.
     *
     * The container registers itself under Container::class so that every
     * framework service can resolve it. The registration is idempotent: if
     * the service is already registered, nothing changes.
     *
     * @param Container $container The application dependency injection
     *                             container receiving the registrations.
     *
     * @return void
     */
    public function register(Container $container): void
    {
        if ($container->has(Container::class)) {
            return;
        }

        $container->set(Container::class, $container);
    }
}
