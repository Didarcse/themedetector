<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Providers;

use App\Core\Container;
use App\Core\Contracts\ServiceProviderInterface;
use App\Modules\TechnologyDetection\TechnologyDetectionManager;
use App\Modules\TechnologyDetection\TechnologyRegistry;

/**
 * Registers every Technology Detection Engine service into the dependency
 * injection container.
 *
 * This provider groups Technology Detection service registrations into a single
 * cohesive unit. It serves as the composition root for the Technology Detection
 * module and performs service registration only.
 *
 * Responsibilities:
 *
 * - Register the TechnologyRegistry as an intentionally empty registry.
 * - Register the TechnologyDetectionManager wired to the registry.
 *
 * Design philosophy:
 *
 * - Service Provider: registrations are grouped into cohesive units.
 * - Composition Root: the provider is the single place that wires the
 *   Technology Detection Engine's public services together.
 * - Dependency Injection and Inversion of Control: consumers depend on the
 *   public Technology Detection services; collaborators are wired through the
 *   container.
 * - Single Responsibility Principle: Technology Detection registration only.
 * - Open/Closed Principle: the provider is independent of concrete technology
 *   detectors. Future detectors are introduced through a
 *   TechnologyRegistryFactory without modifying this provider, so this
 *   provider never requires modification when new detectors are added.
 * - Lazy service registration: services are constructed only on first
 *   resolution.
 * - Idempotent: no registration overwrites an already registered service.
 * - Stateless, side-effect free, and deterministic.
 */
final class TechnologyDetectionServiceProvider implements ServiceProviderInterface
{
    /**
     * Register the Technology Detection Engine services with the given
     * container.
     *
     * Registers the TechnologyRegistry as an intentionally empty registry and
     * the TechnologyDetectionManager wired to the registry resolved from the
     * container. Every registration is idempotent: if a service is already
     * registered, nothing changes.
     *
     * @param Container $container The application dependency injection
     *                             container receiving the registrations.
     *
     * @return void
     */
    public function register(Container $container): void
    {
        if (!$container->has(TechnologyRegistry::class)) {
            $container->set(
                TechnologyRegistry::class,
                static fn (): TechnologyRegistry => new TechnologyRegistry(),
            );
        }

        if (!$container->has(TechnologyDetectionManager::class)) {
            $container->set(
                TechnologyDetectionManager::class,
                static fn (Container $container): TechnologyDetectionManager => new TechnologyDetectionManager(
                    $container->get(TechnologyRegistry::class),
                ),
            );
        }
    }
}
