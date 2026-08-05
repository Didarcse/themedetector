<?php

declare(strict_types=1);

namespace App\Modules\PluginDetection;

use App\Modules\PluginDetection\Contracts\PluginDetectorInterface;

/**
 * Provides a central registry for every Plugin Detector supported by the
 * Plugin Detection Engine.
 *
 * The registry is the composition point for plugin detector
 * implementations. It is responsible only for registering and exposing
 * detector instances. It performs no detection, no orchestration, no
 * confidence calculation, and no HTTP requests.
 *
 * Responsibilities:
 *
 * - Register PluginDetectorInterface implementations.
 * - Return all registered detectors.
 * - Nothing else.
 *
 * Design philosophy:
 *
 * - Registry Pattern: the registry owns the plugin detector collection and
 *   nothing more.
 * - Single Responsibility Principle: the registry has no business logic,
 *   no detection logic, no parsing, and no HTTP.
 * - Open/Closed Principle: it works exclusively with
 *   PluginDetectorInterface and has no knowledge of any concrete
 *   platform (WordPress, Shopify, Ghost, Browser Extensions, CMS Modules,
 *   etc.), so new detectors can be registered without modifying the
 *   registry.
 * - Detectors are never reordered, filtered, deduplicated, or
 *   transformed. The all() accessor returns exactly what was registered,
 *   in the order it was registered.
 * - The registry is deterministic and side-effect free, holding no state
 *   other than the detector collection itself.
 *
 * Future Compatibility:
 *
 * - Every future plugin detector implementation — WordPress Plugins,
 *   Shopify Apps, Ghost Integrations, Browser Extensions, CMS Modules,
 *   and future platforms — is registered through this registry.
 */
final class PluginRegistry
{
    /**
     * @var list<PluginDetectorInterface>
     */
    private array $detectors = [];

    /**
     * Register a plugin detector implementation.
     *
     * The detector is appended to the registry in the exact order it is
     * registered.
     *
     * @param PluginDetectorInterface $detector The detector to register.
     */
    public function register(PluginDetectorInterface $detector): void
    {
        $this->detectors[] = $detector;
    }

    /**
     * Return every registered plugin detector.
     *
     * Detectors are returned exactly as registered: no reordering, no
     * filtering, and no transformation.
     *
     * @return list<PluginDetectorInterface> The registered detectors.
     */
    public function all(): array
    {
        return $this->detectors;
    }
}
