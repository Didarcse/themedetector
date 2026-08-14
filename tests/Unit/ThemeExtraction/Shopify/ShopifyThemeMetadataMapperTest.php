<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Shopify;

use App\Modules\ThemeExtraction\Shopify\RawShopifyThemeMetadata;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeMetadataMapper;
use App\Modules\ThemeExtraction\ThemeMetadata;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the ShopifyThemeMetadataMapper.
 *
 * Verifies the complete public contract of the mapper: the raw theme name
 * maps to the ThemeMetadata name trimmed of surrounding whitespace, a
 * missing or whitespace-only name maps to the empty string, the Shopify
 * theme id and role are stored in the extra() array, empty values are
 * omitted, and all other fields default to their null or empty forms.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use only real objects with no mocks.
 */
final class ShopifyThemeMetadataMapperTest extends TestCase
{
    /**
     * Create a real mapper instance.
     *
     * @return ShopifyThemeMetadataMapper The mapper under test.
     */
    private function mapper(): ShopifyThemeMetadataMapper
    {
        return new ShopifyThemeMetadataMapper();
    }

    /**
     * Verify that a complete raw object maps to a complete ThemeMetadata.
     */
    public function test_map_returns_complete_theme_metadata(): void
    {
        $metadata = $this->mapper()->map(
            new RawShopifyThemeMetadata(name: 'Dawn', id: 8, role: 'main'),
        );

        self::assertInstanceOf(ThemeMetadata::class, $metadata);
        self::assertSame('Dawn', $metadata->name());
        self::assertSame(8, $metadata->extra()['shopify_theme_id']);
        self::assertSame('main', $metadata->extra()['shopify_theme_role']);
    }

    /**
     * Verify that a numeric string id is preserved in the extra() array.
     */
    public function test_map_preserves_numeric_string_id(): void
    {
        $metadata = $this->mapper()->map(
            new RawShopifyThemeMetadata(name: 'Dawn', id: '8'),
        );

        self::assertSame('8', $metadata->extra()['shopify_theme_id']);
    }

    /**
     * Verify that the name is trimmed of surrounding whitespace.
     */
    public function test_map_trims_name(): void
    {
        $metadata = $this->mapper()->map(
            new RawShopifyThemeMetadata(name: '  Dawn  '),
        );

        self::assertSame('Dawn', $metadata->name());
    }

    /**
     * Verify that a missing name maps to the empty string.
     */
    public function test_map_missing_name_yields_empty_string(): void
    {
        $metadata = $this->mapper()->map(new RawShopifyThemeMetadata());

        self::assertSame('', $metadata->name());
    }

    /**
     * Verify that a whitespace-only name maps to the empty string.
     */
    public function test_map_whitespace_name_yields_empty_string(): void
    {
        $metadata = $this->mapper()->map(new RawShopifyThemeMetadata(name: '   '));

        self::assertSame('', $metadata->name());
    }

    /**
     * Verify that a missing id is omitted from the extra() array.
     */
    public function test_map_missing_id_is_omitted(): void
    {
        $metadata = $this->mapper()->map(new RawShopifyThemeMetadata(name: 'Dawn'));

        self::assertArrayNotHasKey('shopify_theme_id', $metadata->extra());
    }

    /**
     * Verify that an empty string id is omitted from the extra() array.
     */
    public function test_map_empty_string_id_is_omitted(): void
    {
        $metadata = $this->mapper()->map(new RawShopifyThemeMetadata(name: 'Dawn', id: '  '));

        self::assertArrayNotHasKey('shopify_theme_id', $metadata->extra());
    }

    /**
     * Verify that a missing role is omitted from the extra() array.
     */
    public function test_map_missing_role_is_omitted(): void
    {
        $metadata = $this->mapper()->map(new RawShopifyThemeMetadata(name: 'Dawn'));

        self::assertArrayNotHasKey('shopify_theme_role', $metadata->extra());
    }

    /**
     * Verify that a whitespace-only role is omitted from the extra() array.
     */
    public function test_map_whitespace_role_is_omitted(): void
    {
        $metadata = $this->mapper()->map(new RawShopifyThemeMetadata(name: 'Dawn', role: '  '));

        self::assertArrayNotHasKey('shopify_theme_role', $metadata->extra());
    }

    /**
     * Verify that fields without a Shopify value keep their defaults.
     */
    public function test_map_keeps_defaults_for_unknown_fields(): void
    {
        $metadata = $this->mapper()->map(new RawShopifyThemeMetadata(name: 'Dawn'));

        self::assertNull($metadata->version());
        self::assertNull($metadata->author());
        self::assertNull($metadata->authorUrl());
        self::assertNull($metadata->themeUrl());
        self::assertNull($metadata->description());
        self::assertNull($metadata->license());
        self::assertNull($metadata->licenseUrl());
        self::assertNull($metadata->textDomain());
        self::assertNull($metadata->parentTheme());
        self::assertNull($metadata->requiresPhp());
        self::assertNull($metadata->requiresCms());
        self::assertSame([], $metadata->tags());
    }
}
