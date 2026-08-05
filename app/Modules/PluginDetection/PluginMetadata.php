<?php

declare(strict_types=1);

namespace App\Modules\PluginDetection;

/**
 * Immutable value object representing normalized website plugin metadata.
 *
 * PluginMetadata is the canonical metadata model shared by every Plugin
 * Detector implementation. It provides a CMS-agnostic representation of
 * plugin information so that consumers work with one normalized structure
 * regardless of the underlying platform.
 *
 * Responsibilities:
 *
 * - Represent normalized plugin metadata (name, slug, version, author,
 *   license, and related attributes).
 * - Act as the single shared metadata model for every Plugin Detector.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - CMS Agnostic: the model expresses platform-independent plugin facts
 *   only and contains no platform-specific logic.
 * - Normalized Metadata Model: every detector populates the same shape.
 * - Single Responsibility Principle: it stores metadata only and performs
 *   no detection logic.
 * - Stateless, deterministic, and side-effect free.
 * - It performs no detection, no HTTP requests, and contains no parsing
 *   logic. It knows nothing about WordPress, Shopify, Ghost, or any other
 *   platform.
 *
 * Future Compatibility:
 *
 * - The model supports WordPress Plugins, Shopify Apps, Ghost Integrations,
 *   Browser Extensions, CMS Modules, and future platforms without
 *   modification.
 * - Platform-specific values must be stored in extra() instead of changing
 *   the public API, keeping the model backward compatible.
 */
final readonly class PluginMetadata
{
    /**
     * Create a plugin metadata instance.
     *
     * @param string               $name        The plugin name.
     * @param string|null          $slug        The plugin slug.
     * @param string|null          $version     The plugin version.
     * @param string|null          $author      The plugin author name.
     * @param string|null          $authorUrl   The plugin author URL.
     * @param string|null          $pluginUrl   The plugin homepage URL.
     * @param string|null          $description The plugin description.
     * @param string|null          $license     The plugin license identifier.
     * @param list<string>         $tags        The plugin tags.
     * @param string|null          $requiresPhp The minimum required PHP version.
     * @param string|null          $requiresCms The minimum required CMS version.
     * @param array<string, mixed> $extra       Platform-specific metadata.
     */
    public function __construct(
        private string $name,
        private ?string $slug = null,
        private ?string $version = null,
        private ?string $author = null,
        private ?string $authorUrl = null,
        private ?string $pluginUrl = null,
        private ?string $description = null,
        private ?string $license = null,
        private array $tags = [],
        private ?string $requiresPhp = null,
        private ?string $requiresCms = null,
        private array $extra = [],
    ) {
    }

    /**
     * Return the plugin name.
     *
     * @return string The plugin name.
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Return the plugin slug.
     *
     * @return string|null The plugin slug, or null when unknown.
     */
    public function slug(): ?string
    {
        return $this->slug;
    }

    /**
     * Return the plugin version.
     *
     * @return string|null The plugin version, or null when unknown.
     */
    public function version(): ?string
    {
        return $this->version;
    }

    /**
     * Return the plugin author name.
     *
     * @return string|null The plugin author name, or null when unknown.
     */
    public function author(): ?string
    {
        return $this->author;
    }

    /**
     * Return the plugin author URL.
     *
     * @return string|null The plugin author URL, or null when unknown.
     */
    public function authorUrl(): ?string
    {
        return $this->authorUrl;
    }

    /**
     * Return the plugin homepage URL.
     *
     * @return string|null The plugin homepage URL, or null when unknown.
     */
    public function pluginUrl(): ?string
    {
        return $this->pluginUrl;
    }

    /**
     * Return the plugin description.
     *
     * @return string|null The plugin description, or null when unknown.
     */
    public function description(): ?string
    {
        return $this->description;
    }

    /**
     * Return the plugin license identifier.
     *
     * @return string|null The plugin license identifier, or null when unknown.
     */
    public function license(): ?string
    {
        return $this->license;
    }

    /**
     * Return the plugin tags.
     *
     * @return list<string> The plugin tags.
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
     * The extra payload is the extension point for plugin facts that do not
     * fit the first-class PluginMetadata properties. It must only contain
     * platform-specific metadata and must never duplicate any first-class
     * property exposed on this value object.
     *
     * @return array<string, mixed> The platform-specific metadata.
     */
    public function extra(): array
    {
        return $this->extra;
    }
}
