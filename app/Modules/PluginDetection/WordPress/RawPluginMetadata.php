<?php

declare(strict_types=1);

namespace App\Modules\PluginDetection\WordPress;

/**
 * Raw metadata extracted directly from the WordPress plugin detection
 * rules.
 *
 * RawPluginMetadata is an immutable transport object exchanged between
 * the plugin detection rules and PluginMetadataMapper. It carries the raw
 * plugin metadata exactly as it was produced by the detection rules,
 * without interpretation of any kind.
 *
 * Responsibilities:
 *
 * - Store raw plugin metadata (slug, confidence, and additional
 *   platform-specific data).
 * - Expose it through typed getters.
 * - Nothing else.
 *
 * Design philosophy:
 *
 * - Transport Object: it exists only to carry data from the detection
 *   rules to the mapper and performs no processing of its own.
 * - No validation, no normalization, no mapping, no parsing, and no
 *   business logic: values are stored and returned exactly as supplied.
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Stateless, deterministic, and side-effect free.
 *
 * Future Compatibility:
 *
 * - Future rules may populate additional metadata through the extra()
 *   array without changing the responsibility of this object.
 *
 * The class knows nothing about PluginMetadata, PluginDetectionResult, or
 * the detection workflow that surrounds it; it is a plain,
 * platform-neutral field container.
 */
final readonly class RawPluginMetadata
{
    /**
     * @param string               $slug       The detected plugin slug.
     * @param int                  $confidence The rule-provided confidence
     *                                         score.
     * @param array<string, mixed> $extra      Additional raw metadata.
     */
    public function __construct(
        private string $slug,
        private int $confidence = 0,
        private array $extra = [],
    ) {
    }

    /**
     * Return the detected plugin slug.
     *
     * @return string The detected plugin slug, exactly as supplied.
     */
    public function slug(): string
    {
        return $this->slug;
    }

    /**
     * Return the rule-provided confidence score.
     *
     * @return int The rule-provided confidence score, exactly as supplied.
     */
    public function confidence(): int
    {
        return $this->confidence;
    }

    /**
     * Return the additional raw metadata.
     *
     * @return array<string, mixed> The additional raw metadata, exactly as
     *                              supplied.
     */
    public function extra(): array
    {
        return $this->extra;
    }
}
