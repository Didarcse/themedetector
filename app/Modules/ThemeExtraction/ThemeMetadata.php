<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction;

/**
 * Immutable value object representing normalized website theme metadata.
 *
 * ThemeMetadata is the canonical metadata model shared by every Theme
 * Extractor implementation. It provides a CMS-agnostic representation of
 * theme information so that consumers work with one normalized structure
 * regardless of the underlying platform.
 *
 * Responsibilities:
 *
 * - Represent normalized theme metadata (name, version, author, license,
 *   and related attributes).
 * - Act as the single shared metadata model for every Theme Extractor.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - CMS Agnostic: the model expresses platform-independent theme facts
 *   only and contains no platform-specific logic.
 * - Normalized Metadata Model: every extractor populates the same shape.
 * - Single Responsibility Principle: it stores metadata only and performs
 *   no extraction logic.
 * - Stateless, deterministic, and side-effect free.
 * - It performs no extraction, no HTTP requests, and contains no parsing
 *   logic. It knows nothing about WordPress, Shopify, Ghost, Joomla,
 *   Drupal, TYPO3, or any other platform.
 *
 * Future Compatibility:
 *
 * - The model supports WordPress, Shopify, Ghost, Drupal, TYPO3, Magento,
 *   Webflow, Wix, and Squarespace without modification.
 * - CMS-specific values must be stored in extra() instead of changing the
 *   public API.
 */
final readonly class ThemeMetadata
{
    /**
     * @param string              $name          The theme name.
     * @param string|null         $version       The theme version.
     * @param string|null         $author        The theme author name.
     * @param string|null         $authorUrl     The theme author URL.
     * @param string|null         $themeUrl      The theme homepage URL.
     * @param string|null         $description   The theme description.
     * @param string|null         $license       The theme license identifier.
     * @param string|null         $licenseUrl    The theme license URL.
     * @param string|null         $textDomain    The theme text domain.
     * @param string|null         $parentTheme   The parent theme name, when
     *                                           the theme is a child theme.
     * @param string|null         $screenshotUrl The theme screenshot URL.
     * @param array<int, string>  $tags          The theme tags.
     * @param string|null         $requiresPhp   The minimum required PHP version.
     * @param string|null         $requiresCms   The minimum required CMS version.
     * @param array<string, mixed> $extra        Platform-specific metadata.
     */
    public function __construct(
        private string $name,
        private ?string $version = null,
        private ?string $author = null,
        private ?string $authorUrl = null,
        private ?string $themeUrl = null,
        private ?string $description = null,
        private ?string $license = null,
        private ?string $licenseUrl = null,
        private ?string $textDomain = null,
        private ?string $parentTheme = null,
        private ?string $screenshotUrl = null,
        private array $tags = [],
        private ?string $requiresPhp = null,
        private ?string $requiresCms = null,
        private array $extra = [],
    ) {
    }

    /**
     * Return the theme name.
     *
     * @return string The theme name.
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Return the theme version.
     *
     * @return string|null The theme version, or null when unknown.
     */
    public function version(): ?string
    {
        return $this->version;
    }

    /**
     * Return the theme author name.
     *
     * @return string|null The theme author name, or null when unknown.
     */
    public function author(): ?string
    {
        return $this->author;
    }

    /**
     * Return the theme author URL.
     *
     * @return string|null The theme author URL, or null when unknown.
     */
    public function authorUrl(): ?string
    {
        return $this->authorUrl;
    }

    /**
     * Return the theme homepage URL.
     *
     * @return string|null The theme homepage URL, or null when unknown.
     */
    public function themeUrl(): ?string
    {
        return $this->themeUrl;
    }

    /**
     * Return the theme description.
     *
     * @return string|null The theme description, or null when unknown.
     */
    public function description(): ?string
    {
        return $this->description;
    }

    /**
     * Return the theme license identifier.
     *
     * @return string|null The theme license identifier, or null when unknown.
     */
    public function license(): ?string
    {
        return $this->license;
    }

    /**
     * Return the theme license URL.
     *
     * @return string|null The theme license URL, or null when unknown.
     */
    public function licenseUrl(): ?string
    {
        return $this->licenseUrl;
    }

    /**
     * Return the theme text domain.
     *
     * @return string|null The theme text domain, or null when unknown.
     */
    public function textDomain(): ?string
    {
        return $this->textDomain;
    }

    /**
     * Return the parent theme name.
     *
     * @return string|null The parent theme name, or null when the theme is
     *                     not a child theme.
     */
    public function parentTheme(): ?string
    {
        return $this->parentTheme;
    }

    /**
     * Return the theme screenshot URL.
     *
     * @return string|null The theme screenshot URL, or null when unknown.
     */
    public function screenshotUrl(): ?string
    {
        return $this->screenshotUrl;
    }

    /**
     * Return the theme tags.
     *
     * @return array<int, string> The theme tags.
     */
    public function tags(): array
    {
        return $this->tags;
    }

    /**
     * Return the minimum required PHP version.
     *
     * @return string|null The minimum required PHP version, or null when
     *                     unknown.
     */
    public function requiresPhp(): ?string
    {
        return $this->requiresPhp;
    }

    /**
     * Return the minimum required CMS version.
     *
     * @return string|null The minimum required CMS version, or null when
     *                     unknown.
     */
    public function requiresCms(): ?string
    {
        return $this->requiresCms;
    }

    /**
     * Return the platform-specific metadata.
     *
     * @return array<string, mixed> The platform-specific metadata.
     */
    public function extra(): array
    {
        return $this->extra;
    }
}
