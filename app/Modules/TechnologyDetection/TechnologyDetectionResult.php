<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection;

use InvalidArgumentException;

/**
 * Immutable value object representing the result of a technology detection.
 *
 * TechnologyDetectionResult is the canonical result produced by every
 * Technology Detector implementation. It contains the outcome of a
 * technology detection operation — whether a technology was detected, the
 * confidence of that outcome, and the normalized TechnologyMetadata
 * describing the detected technology when detection succeeded.
 *
 * Responsibilities:
 *
 * - Represent the outcome of a technology detection operation.
 * - Carry the normalized technology metadata and confidence score.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Fail Fast: an out-of-range confidence score is rejected at
 *   construction time, so a result can never carry an invalid state.
 * - Single Responsibility Principle: it stores result data only and
 *   performs no detection logic.
 * - Stateless, deterministic, and side-effect free.
 * - It contains no parsing logic and knows nothing about JavaScript
 *   libraries, analytics platforms, CDNs, or any other technology.
 *
 * Future Compatibility:
 *
 * - Future technology detectors must produce this normalized result model.
 * - The model supports JavaScript Libraries, Analytics, CDN, and future
 *   technology categories without modification.
 */
final readonly class TechnologyDetectionResult
{
    /**
     * Create a technology detection result instance.
     *
     * @param bool                    $detected   Whether a technology was
     *                                            detected.
     * @param TechnologyMetadata|null $metadata   The normalized technology
     *                                            metadata, null when no
     *                                            technology was detected.
     * @param int                     $confidence The confidence score (0–100).
     *
     * @throws InvalidArgumentException When confidence is outside 0–100.
     */
    public function __construct(
        private bool $detected,
        private ?TechnologyMetadata $metadata,
        private int $confidence,
    ) {
        if ($this->confidence < 0 || $this->confidence > 100) {
            throw new InvalidArgumentException(
                'Confidence must be between 0 and 100.'
            );
        }
    }

    /**
     * Return whether a technology was detected.
     *
     * @return bool True when the detection identified a technology.
     */
    public function isDetected(): bool
    {
        return $this->detected;
    }

    /**
     * Return the normalized technology metadata.
     *
     * @return TechnologyMetadata|null The detected technology metadata, or
     *                                 null when no technology was detected.
     */
    public function metadata(): ?TechnologyMetadata
    {
        return $this->metadata;
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
