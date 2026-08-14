<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\Shopify;

/**
 * Raw metadata extracted directly from a window.Shopify object literal.
 *
 * RawShopifyThemeMetadata is a temporary transport object exchanged
 * between ShopifyThemeParser and ShopifyThemeMetadataMapper. It carries the
 * theme fields exactly as they were read from the object literal, without
 * interpretation of any kind.
 *
 * Responsibilities:
 *
 * - Store the raw theme name, id, and role fields.
 * - Expose them through the name(), id(), and role() accessors.
 *
 * Design philosophy:
 *
 * - Transport Object: it exists only to carry data from the parser to the
 *   mapper and performs no processing of its own.
 * - No validation, no normalization, no mapping, and no business logic:
 *   values are stored and returned exactly as supplied.
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about ThemeMetadata, Shopify, or any other
 * platform; it is a plain, platform-neutral field container.
 */
final readonly class RawShopifyThemeMetadata
{
    /**
     * @param string|null          $name The raw theme name, null when the
     *                                   object carries no name.
     * @param int|string|null      $id   The raw theme id, null when the
     *                                   object carries no id.
     * @param string|null          $role The raw theme role, null when the
     *                                   object carries no role.
     */
    public function __construct(
        private ?string $name = null,
        private int|string|null $id = null,
        private ?string $role = null,
    ) {
    }

    /**
     * Return the raw theme name.
     *
     * @return string|null The theme name, or null when the object carries
     *                     no name.
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * Return the raw theme id.
     *
     * @return int|string|null The theme id, or null when the object
     *                         carries no id.
     */
    public function id(): int|string|null
    {
        return $this->id;
    }

    /**
     * Return the raw theme role.
     *
     * @return string|null The theme role, or null when the object carries
     *                     no role.
     */
    public function role(): ?string
    {
        return $this->role;
    }
}
