<?php

declare(strict_types=1);

namespace App\Modules\Detection\Providers;

use App\Core\Container;
use App\Core\Contracts\ServiceProviderInterface;
use App\Modules\Detection\DetectionContextFactory;
use App\Modules\Detection\DetectionManager;
use App\Modules\Detection\DetectorRegistry;
use App\Modules\Detection\WebsiteDetector;
use App\Modules\Http\HttpClientInterface;

/**
 * Registers every public Detection module service into the dependency
 * injection container.
 *
 * This provider groups Detection module service registrations into a single
 * cohesive unit. It serves as the composition root for the Detection module
 * and performs service registration only.
 *
 * Responsibilities:
 *
 * - Register the DetectorRegistry as an intentionally empty registry.
 * - Register the DetectionManager wired to the registry.
 * - Register the DetectionContextFactory.
 * - Register the WebsiteDetector as the only public Detection API.
 *
 * Design philosophy:
 *
 * - Service Provider: registrations are grouped into cohesive units.
 * - Composition Root: the provider is the single place that wires the
 *   Detection module's public services together.
 * - Dependency Injection and Inversion of Control: consumers depend on the
 *   public Detection API; collaborators are wired through the container.
 * - Single Responsibility Principle: Detection module registration only.
 * - Open/Closed Principle: the provider is independent of concrete CMS
 *   detectors. Future detectors are introduced through a
 *   DetectorRegistryFactory without modifying this provider, and the
 *   WebsiteDetector remains the only public Detection API.
 * - Lazy service registration: services are constructed only on first
 *   resolution.
 * - Idempotent: no registration overwrites an already registered service.
 * - Stateless, side-effect free, and deterministic.
 */
final class DetectionServiceProvider implements ServiceProviderInterface
{
    /**
     * Register the Detection module services with the given container.
     *
     * Registers the DetectorRegistry as an intentionally empty registry,
     * the DetectionManager wired to the registry resolved from the
     * container, the stateless DetectionContextFactory, and the
     * WebsiteDetector facade wired to the HTTP client, the context
     * factory, and the detection manager. Every registration is
     * idempotent: if a service is already registered, nothing changes.
     *
     * @param Container $container The application dependency injection
     *                             container receiving the registrations.
     *
     * @return void
     */
    public function register(Container $container): void
    {
        if (!$container->has(DetectorRegistry::class)) {
            $container->set(
                DetectorRegistry::class,
                static fn (): DetectorRegistry => new DetectorRegistry([]),
            );
        }

        if (!$container->has(DetectionManager::class)) {
            $container->set(
                DetectionManager::class,
                static fn (Container $container): DetectionManager => new DetectionManager(
                    $container->get(DetectorRegistry::class),
                ),
            );
        }

        if (!$container->has(DetectionContextFactory::class)) {
            $container->set(
                DetectionContextFactory::class,
                static fn (): DetectionContextFactory => new DetectionContextFactory(),
            );
        }

        if (!$container->has(WebsiteDetector::class)) {
            $container->set(
                WebsiteDetector::class,
                static fn (Container $container): WebsiteDetector => new WebsiteDetector(
                    $container->get(HttpClientInterface::class),
                    $container->get(DetectionManager::class),
                    $container->get(DetectionContextFactory::class),
                ),
            );
        }
    }
}
