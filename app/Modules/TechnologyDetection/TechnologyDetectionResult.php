<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection;

/**
 * Immutable value object representing the result of a technology detection.
 *
 * TechnologyDetectionResult is the canonical result produced by every
 * Technology Detector implementation. It contains the outcome of a technology
 * detection operation — whether a technology was detected, the normalized
 * TechnologyMetadata describing the detected technology, and the confidence
 * of that outcome.
 *
 * Responsibilities:
 *
 * - Represent the outcome of a technology detection operation.
 * - Carry the normalized technology metadata and confidence score.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it stores result data only and
 *   performs no detection logic.
 * - Stateless, deterministic, and side-effect free.
 * - It contains no parsing logic and knows nothing about PHP, Laravel,
 *   React, Vue, Cloudflare, Nginx, or any other technology.
 *
 * Future Compatibility:
 *
 * - Future technology detectors must produce this normalized result model.
 * - The model supports PHP, JavaScript, CSS frameworks, CDNs, web servers,
 *   and future technologies without modification.
 */
final readonly class TechnologyDetectionResult
{
    /**
     * Create a technology detection result instance.
     *
     * @param bool                        $detected   Whether a technology was
     *                                                detected.
     * @param TechnologyMetadata|null     $technology The normalized technology
     *                                                metadata, null when no
     *                                                technology was detected.
     * @param int                         $confidence The confidence score (0-100).
     */
    public function __construct(
        private bool $detected,
        private ?TechnologyMetadata $technology,
        private int $confidence,
    ) {
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
     * @return TechnologyMetadata|null The detected technology metadata, or null
     *                                 when no technology was detected.
     */
    public function technology(): ?TechnologyMetadata
    {
        return $this->technology;
    }

    /**
     * Return the confidence score of the detection.
     *
     * @return int The confidence score (0-100).
     */
    public function confidence(): int
    {
        return $this->confidence;
    }
}
