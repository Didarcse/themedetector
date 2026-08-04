<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\Providers;

use App\Core\Container;
use App\Core\Contracts\ServiceProviderInterface;
use App\Modules\ThemeExtraction\ThemeExtractionManager;
use App\Modules\ThemeExtraction\ThemeExtractorRegistry;

/**
 * Registers every Theme Extraction Engine service into the dependency
 * injection container.
 *
 * This provider groups Theme Extraction service registrations into a single
 * cohesive unit. It serves as the composition root for the Theme Extraction
 * module and performs service registration only.
 *
 * Responsibilities:
 *
 * - Register the ThemeExtractorRegistry as an intentionally empty registry.
 * - Register the ThemeExtractionManager wired to the registry.
 *
 * Design philosophy:
 *
 * - Service Provider: registrations are grouped into cohesive units.
 * - Composition Root: the provider is the single place that wires the Theme
 *   Extraction Engine's public services together.
 * - Dependency Injection and Inversion of Control: consumers depend on the
 *   public Theme Extraction services; collaborators are wired through the
 *   container.
 * - Single Responsibility Principle: Theme Extraction registration only.
 * - Open/Closed Principle: the provider is independent of concrete theme
 *   extractors. Future extractors are introduced through a
 *   ThemeExtractorRegistryFactory without modifying this provider, so this
 *   provider never requires modification when new extractors are added.
 * - Lazy service registration: services are constructed only on first
 *   resolution.
 * - Idempotent: no registration overwrites an already registered service.
 * - Stateless, side-effect free, and deterministic.
 */
final class ThemeExtractionServiceProvider implements ServiceProviderInterface
{
    /**
     * Register the Theme Extraction Engine services with the given container.
     *
     * Registers the ThemeExtractorRegistry as an intentionally empty
     * registry and the ThemeExtractionManager wired to the registry resolved
     * from the container. Every registration is idempotent: if a service is
     * already registered, nothing changes.
     *
     * @param Container $container The application dependency injection
     *                             container receiving the registrations.
     *
     * @return void
     */
    public function register(Container $container): void
    {
        if (!$container->has(ThemeExtractorRegistry::class)) {
            $container->set(
                ThemeExtractorRegistry::class,
                static fn (): ThemeExtractorRegistry => new ThemeExtractorRegistry([]),
            );
        }

        if (!$container->has(ThemeExtractionManager::class)) {
            $container->set(
                ThemeExtractionManager::class,
                static fn (Container $container): ThemeExtractionManager => new ThemeExtractionManager(
                    $container->get(ThemeExtractorRegistry::class),
                ),
            );
        }
    }
}
