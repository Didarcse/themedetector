<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\Shopify;

use App\Modules\ThemeExtraction\ThemeMetadata;

/**
 * Converts RawShopifyThemeMetadata into the ThemeMetadata domain object.
 *
 * ShopifyThemeMetadataMapper is responsible only for translating the raw
 * theme fields read from a window.Shopify object literal into the
 * canonical, CMS-agnostic ThemeMetadata value object. It applies
 * lightweight normalization (missing fields become null or the empty
 * string, surrounding whitespace is trimmed) and nothing else: no version
 * or URL validation, no value inference, and no business logic.
 *
 * Responsibilities:
 *
 * - Translate the raw theme name into the ThemeMetadata name.
 * - Treat a missing name as the empty string.
 * - Store fields without a dedicated ThemeMetadata property (the Shopify
 *   theme id and role) in the platform-specific extra() array.
 *
 * Design philosophy:
 *
 * - Mapper: it translates data between two representations and nothing
 *   more.
 * - Single Responsibility Principle: translating raw metadata is the only
 *   concern. It performs no HTTP requests, no parsing, no confidence
 *   calculation, and no Shopify business rules.
 * - Stateless, deterministic, and side-effect free: given the same raw
 *   metadata, it always produces the same ThemeMetadata.
 * - Dependency Injection friendly: it needs no collaborators and depends
 *   only on the RawShopifyThemeMetadata it receives.
 *
 * The class creates no ThemeExtractionResult and knows nothing about the
 * extraction workflow that surrounds it.
 */
final readonly class ShopifyThemeMetadataMapper
{
    /**
     * Map the raw metadata to a ThemeMetadata value object.
     *
     * The raw theme name maps to the ThemeMetadata name, trimmed of
     * surrounding whitespace; a missing name maps to the empty string. The
     * Shopify theme id and role have no dedicated ThemeMetadata property
     * and are stored under the 'shopify_theme_id' and
     * 'shopify_theme_role' keys of the extra() array.
     *
     * @param RawShopifyThemeMetadata $raw The raw metadata read from the
     *                                     window.Shopify object literal.
     *
     * @return ThemeMetadata The normalized ThemeMetadata value object.
     */
    public function map(RawShopifyThemeMetadata $raw): ThemeMetadata
    {
        $name = $raw->name() !== null ? trim($raw->name()) : '';

        $extra = [];

        $id = $raw->id();

        if (is_string($id)) {
            $id = trim($id);

            if ($id === '') {
                $id = null;
            }
        }

        if ($id !== null) {
            $extra['shopify_theme_id'] = $id;
        }

        $role = $raw->role() !== null ? trim($raw->role()) : '';

        if ($role !== '') {
            $extra['shopify_theme_role'] = $role;
        }

        return new ThemeMetadata(
            name: $name,
            extra: $extra,
        );
    }
}
