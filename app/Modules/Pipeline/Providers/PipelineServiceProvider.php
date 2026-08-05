<?php

declare(strict_types=1);

namespace App\Modules\Pipeline\Providers;

use App\Core\Container;
use App\Core\Contracts\ServiceProviderInterface;
use App\Modules\Pipeline\PipelineManager;
use App\Modules\Pipeline\PipelineRegistry;

/**
 * Registers every Detection Pipeline service into the dependency injection
 * container.
 *
 * This provider groups Detection Pipeline service registrations into a single
 * cohesive unit. It serves as the composition root for the Detection Pipeline
 * module and performs service registration only.
 *
 * Responsibilities:
 *
 * - Register the PipelineRegistry as an intentionally empty registry.
 * - Register the PipelineManager wired to the registry.
 *
 * Design philosophy:
 *
 * - Service Provider: registrations are grouped into cohesive units.
 * - Composition Root: the provider is the single place that wires the
 *   Detection Pipeline's public services together.
 * - Dependency Injection and Inversion of Control: consumers depend on the
 *   public Detection Pipeline services; collaborators are wired through the
 *   container.
 * - Single Responsibility Principle: Detection Pipeline registration only.
 * - Open/Closed Principle: the provider is independent of concrete pipeline
 *   stages. Future stages are introduced through a PipelineRegistryFactory
 *   without modifying this provider, so this provider never requires
 *   modification when new stages are added.
 * - Lazy service registration: services are constructed only on first
 *   resolution.
 * - Idempotent: no registration overwrites an already registered service.
 * - Stateless, side-effect free, and deterministic.
 */
final class PipelineServiceProvider implements ServiceProviderInterface
{
    /**
     * Register the Detection Pipeline services with the given container.
     *
     * Registers the PipelineRegistry as an intentionally empty registry and
     * the PipelineManager wired to the registry resolved from the container.
     * Every registration is idempotent: if a service is already registered,
     * nothing changes.
     *
     * @param Container $container The application dependency injection
     *                             container receiving the registrations.
     *
     * @return void
     */
    public function register(Container $container): void
    {
        if (!$container->has(PipelineRegistry::class)) {
            $container->set(
                PipelineRegistry::class,
                static fn (): PipelineRegistry => new PipelineRegistry(),
            );
        }

        if (!$container->has(PipelineManager::class)) {
            $container->set(
                PipelineManager::class,
                static fn (Container $container): PipelineManager => new PipelineManager(
                    $container->get(PipelineRegistry::class),
                ),
            );
        }
    }
}
