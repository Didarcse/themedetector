<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection;

/**
 * Immutable value object representing normalized technology metadata.
 *
 * TechnologyMetadata is the canonical metadata model shared by every
 * Technology Detector implementation. It provides a CMS-agnostic
 * representation of technology information so that consumers work with one
 * normalized structure regardless of the underlying technology.
 *
 * Responsibilities:
 *
 * - Represent normalized technology metadata (name, category, version, and
 *   confidence score).
 * - Act as the single shared metadata model for every Technology Detector.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Technology Agnostic: the model expresses technology-agnostic facts only
 *   and contains no platform-specific logic.
 * - Normalized Metadata Model: every detector populates the same shape.
 * - Single Responsibility Principle: it stores metadata only and performs
 *   no detection logic.
 * - Stateless, deterministic, and side-effect free.
 * - It performs no detection, no HTTP requests, and contains no parsing
 *   logic. It knows nothing about PHP, Laravel, React, Vue, Cloudflare,
 *   Nginx, or any other technology.
 *
 * Future Compatibility:
 *
 * - The model supports PHP, JavaScript, CSS frameworks, CDNs, web servers,
 *   and future technologies without modification.
 * - Technology-specific values must be stored in extra() instead of changing
 *   the public API, keeping the model backward compatible.
 */
final readonly class TechnologyMetadata
{
    /**
     * Create a technology metadata instance.
     *
     * @param string               $name       The technology name.
     * @param string               $category   The technology category (for
     *                                         example framework, language,
     *                                         cdn, or server).
     * @param string|null          $version    The technology version.
     * @param int                  $confidence The confidence score (0-100).
     * @param array<string, mixed> $extra      Technology-specific metadata.
     */
    public function __construct(
        private string $name,
        private string $category,
        private ?string $version = null,
        private int $confidence = 0,
        private array $extra = [],
    ) {
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
     * Return the technology version.
     *
     * @return string|null The technology version, or null when unknown.
     */
    public function version(): ?string
    {
        return $this->version;
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

    /**
     * Return the technology-specific metadata.
     *
     * The extra payload is the extension point for technology facts that do
     * not fit the first-class TechnologyMetadata properties. It must only
     * contain technology-specific metadata and must never duplicate any
     * first-class property exposed on this value object.
     *
     * @return array<string, mixed> The technology-specific metadata.
     */
    public function extra(): array
    {
        return $this->extra;
    }
}
