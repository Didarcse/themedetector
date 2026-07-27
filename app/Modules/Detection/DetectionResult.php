<?php

declare(strict_types=1);

namespace App\Modules\Detection;

/**
 * Immutable value object representing a technology detection result.
 *
 * Returned by every detector implementing DetectorInterface.
 * Carries the outcome of a single detection attempt in a standardized,
 * read-only structure.
 */
final class DetectionResult
{
    /**
     * @param string              $technology Technology name (e.g. "WordPress", "Shopify").
     * @param bool                $detected   Whether detection succeeded.
     * @param int                 $confidence Confidence score (0–100).
     * @param string|null         $theme      Detected theme name, null if unknown.
     * @param list<string>        $plugins    List of detected plugins.
     * @param array<string,mixed> $metadata   Additional information (generator, version, evidence, etc.).
     */
    public function __construct(
        private readonly string $technology,
        private readonly bool $detected,
        private readonly int $confidence,
        private readonly ?string $theme,
        private readonly array $plugins,
        private readonly array $metadata,
    ) {
        if ($confidence < 0 || $confidence > 100) {
            throw new \InvalidArgumentException(
                'Confidence must be between 0 and 100.'
            );
        }
    }

    public function technology(): string
    {
        return $this->technology;
    }

    public function isDetected(): bool
    {
        return $this->detected;
    }

    public function confidence(): int
    {
        return $this->confidence;
    }

    public function theme(): ?string
    {
        return $this->theme;
    }

    /** @return list<string> */
    public function plugins(): array
    {
        return $this->plugins;
    }

    /** @return array<string, mixed> */
    public function metadata(): array
    {
        return $this->metadata;
    }
}
