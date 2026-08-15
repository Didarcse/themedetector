<?php

declare(strict_types=1);

namespace App\Domain\DetectionReport;

use InvalidArgumentException;

/**
 * Immutable value object representing a technology detected on a website.
 *
 * DetectedTechnology is the domain-level projection of a Technology
 * Detection Engine result. It carries the normalized name, category,
 * confidence score, and optional version of a technology so that views,
 * API responses, and report consumers read a single stable model.
 *
 * Responsibilities:
 *
 * - Represent a detected technology's name, category, confidence, and
 *   optional version.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Fail Fast: an out-of-range confidence score is rejected at
 *   construction time, so a value can never carry an invalid state.
 * - Single Responsibility Principle: it stores technology facts only and
 *   performs no detection logic.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class DetectedTechnology
{
    /**
     * Create a detected technology instance.
     *
     * @param string      $name       The technology name.
     * @param string      $category   The technology category.
     * @param int         $confidence The detection confidence (0–100).
     * @param string|null $version    The technology version, null when
     *                                unknown.
     *
     * @throws InvalidArgumentException When confidence is outside 0–100.
     */
    public function __construct(
        private string $name,
        private string $category,
        private int $confidence,
        private ?string $version = null,
    ) {
        if ($this->confidence < 0 || $this->confidence > 100) {
            throw new InvalidArgumentException(
                'Confidence must be between 0 and 100.'
            );
        }
    }

    /**
     * Return the technology name.
     *
     * @return string The technology name.
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Return the technology category.
     *
     * @return string The technology category.
     */
    public function category(): string
    {
        return $this->category;
    }

    /**
     * Return the detection confidence.
     *
     * @return int The confidence score (0–100).
     */
    public function confidence(): int
    {
        return $this->confidence;
    }

    /**
     * Return the technology version.
     *
     * @return string|null The technology version, or null when unknown.
     */
    public function version(): ?string
    {
        return $this->version;
    }
}
