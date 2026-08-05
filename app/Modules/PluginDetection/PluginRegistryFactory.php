<?php

declare(strict_types=1);

namespace App\Modules\PluginDetection;

use App\Core\Container;
use App\Modules\PluginDetection\WordPress\PluginMetadataMapper;
use App\Modules\PluginDetection\WordPress\PluginSlugExtractor;
use App\Modules\PluginDetection\WordPress\Rules\PluginPathRule;
use App\Modules\PluginDetection\WordPress\WordPressPluginDetector;

/**
 * Assembles the production-ready PluginRegistry for the Plugin Detection
 * Engine.
 *
 * PluginRegistryFactory wires every supported plugin detector into a single
 * PluginRegistry. It is the composition point for introducing plugin
 * detectors without coupling the registry to a concrete platform.
 *
 * Responsibilities:
 *
 * - Build every supported plugin detector with its pipeline.
 * - Register the detectors on a new PluginRegistry.
 * - Return the fully populated PluginRegistry.
 *
 * Design philosophy:
 *
 * - Factory: object creation is centralized and reusable.
 * - Composition Root: plugin detector wiring happens exclusively here.
 * - Single Responsibility Principle: assembling the registry is the only
 *   concern; it performs no detection.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class PluginRegistryFactory
{
    /**
     * Build the fully populated PluginRegistry.
     *
     * @param Container $container The application dependency injection
     *                             container (kept for signature symmetry
     *                             with the other registry factories).
     *
     * @return PluginRegistry The registry containing every supported
     *                        plugin detector.
     */
    public function create(Container $container): PluginRegistry
    {
        $registry = new PluginRegistry();

        $registry->register(new WordPressPluginDetector(
            new PluginPathRule(),
            new PluginSlugExtractor(),
            new PluginMetadataMapper(),
        ));

        return $registry;
    }
}
