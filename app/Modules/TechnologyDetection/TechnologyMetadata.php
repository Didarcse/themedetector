<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection;

/**
 * Immutable value object representing normalized website technology
 * metadata.
 *
 * TechnologyMetadata is the canonical metadata model shared by every
 * Technology Detector implementation. It provides a platform-agnostic
 * representation of technology information so that consumers work with one
 * normalized structure regardless of the underlying technology category.
 *
 * Responsibilities:
 *
 * - Represent normalized technology metadata (name, slug, category,
 *   version, vendor, and related attributes).
 * - Act as the single shared metadata model for every Technology Detector.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Technology Agnostic: the model expresses category-independent
 *   technology facts only and contains no category-specific logic.
 * - Normalized Metadata Model: every detector populates the same shape.
 * - Single Responsibility Principle: it stores metadata only and performs
 *   no detection logic.
 * - Stateless, deterministic, and side-effect free.
 * - It performs no detection, no HTTP requests, and contains no parsing
 *   logic. It knows nothing about JavaScript libraries, analytics
 *   platforms, CDNs, or any other technology.
 *
 * Future Compatibility:
 *
 * - The model supports JavaScript Libraries, Analytics, CDN, and future
 *   technology categories without modification.
 * - Category-specific values must be stored in extra() instead of changing
 *   the public API, keeping the model backward compatible.
 */
final readonly class TechnologyMetadata
{
    /**
     * Create a technology metadata instance.
     *
     * @param string               $name             The technology name.
     * @param string|null          $slug             The technology slug.
     * @param string|null          $category         The technology category
     *                                               (e.g. "JavaScript
     *                                               Library", "Analytics",
     *                                               "CDN").
     * @param string|null          $version          The technology version.
     * @param string|null          $vendor           The technology vendor
     *                                               name.
     * @param string|null          $vendorUrl        The technology vendor
     *                                               URL.
     * @param string|null          $description      The technology
     *                                               description.
     * @param string|null          $documentationUrl The technology
     *                                               documentation URL.
     * @param string|null          $license          The technology license
     *                                               identifier.
     * @param list<string>         $tags             The technology tags.
     * @param array<string, mixed> $extra            Category-specific
     *                                               metadata.
     */
    public function __construct(
        private string $name,
        private ?string $slug = null,
        private ?string $category = null,
        private ?string $version = null,
        private ?string $vendor = null,
        private ?string $vendorUrl = null,
        private ?string $description = null,
        private ?string $documentationUrl = null,
        private ?string $license = null,
        private array $tags = [],
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
     * Return the technology slug.
     *
     * @return string|null The technology slug, or null when unknown.
     */
    public function slug(): ?string
    {
        return $this->slug;
    }

    /**
     * Return the technology category.
     *
     * @return string|null The technology category, or null when unknown.
     */
    public function category(): ?string
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
     * Return the technology vendor name.
     *
     * @return string|null The technology vendor name, or null when unknown.
     */
    public function vendor(): ?string
    {
        return $this->vendor;
    }

    /**
     * Return the technology vendor URL.
     *
     * @return string|null The technology vendor URL, or null when unknown.
     */
    public function vendorUrl(): ?string
    {
        return $this->vendorUrl;
    }

    /**
     * Return the technology description.
     *
     * @return string|null The technology description, or null when unknown.
     */
    public function description(): ?string
    {
        return $this->description;
    }

    /**
     * Return the technology documentation URL.
     *
     * @return string|null The technology documentation URL, or null when
     *                     unknown.
     */
    public function documentationUrl(): ?string
    {
        return $this->documentationUrl;
    }

    /**
     * Return the technology license identifier.
     *
     * @return string|null The technology license identifier, or null when
     *                     unknown.
     */
    public function license(): ?string
    {
        return $this->license;
    }

    /**
     * Return the technology tags.
     *
     * @return list<string> The technology tags.
     */
    public function tags(): array
    {
        return $this->tags;
    }

    /**
     * Return the category-specific metadata.
     *
     * The extra payload is the extension point for technology facts that do
     * not fit the first-class TechnologyMetadata properties. It must only
     * contain category-specific metadata and must never duplicate any
     * first-class property exposed on this value object.
     *
     * @return array<string, mixed> The category-specific metadata.
     */
    public function extra(): array
    {
        return $this->extra;
    }
}
