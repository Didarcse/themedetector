<?php

declare(strict_types=1);

namespace App\Modules\PluginDetection;

/**
 * Immutable value object representing the result of a plugin detection.
 *
 * PluginDetectionResult is the canonical result produced by every Plugin
 * Detector implementation. It contains the outcome of a plugin detection
 * operation — whether a plugin was detected, the confidence of that
 * outcome, and the normalized PluginMetadata describing the detected
 * plugin when detection succeeded.
 *
 * Responsibilities:
 *
 * - Represent the outcome of a plugin detection operation.
 * - Carry the normalized plugin metadata and confidence score.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it stores result data only and
 *   performs no detection logic.
 * - Stateless, deterministic, and side-effect free.
 * - It contains no parsing logic and knows nothing about WordPress,
 *   Shopify, Ghost, or any other platform.
 *
 * Future Compatibility:
 *
 * - Future plugin detectors must produce this normalized result model.
 * - The model supports WordPress Plugins, Shopify Apps, Ghost
 *   Integrations, and future platforms without modification.
 */
final readonly class PluginDetectionResult
{
    /**
     * Create a plugin detection result instance.
     *
     * @param bool                 $detected   Whether a plugin was detected.
     * @param PluginMetadata|null  $plugin     The normalized plugin metadata,
     *                                         null when no plugin was detected.
     * @param int                  $confidence The confidence score (0–100).
     */
    public function __construct(
        private bool $detected,
        private ?PluginMetadata $plugin,
        private int $confidence,
    ) {
    }

    /**
     * Return whether a plugin was detected.
     *
     * @return bool True when the detection identified a plugin.
     */
    public function isDetected(): bool
    {
        return $this->detected;
    }

    /**
     * Return the normalized plugin metadata.
     *
     * @return PluginMetadata|null The detected plugin metadata, or null when
     *                             no plugin was detected.
     */
    public function plugin(): ?PluginMetadata
    {
        return $this->plugin;
    }

    /**
     * Return the confidence score of the detection.
     *
     * @return int The confidence score (0–100).
     */
    public function confidence(): int
    {
        return $this->confidence;
    }
}
