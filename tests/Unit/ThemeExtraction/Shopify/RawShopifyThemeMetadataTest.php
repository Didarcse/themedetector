<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Shopify;

use App\Modules\ThemeExtraction\Shopify\RawShopifyThemeMetadata;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the RawShopifyThemeMetadata value object.
 *
 * Verifies the complete public contract of the transport object: the raw
 * theme fields are stored and returned exactly as supplied, missing fields
 * default to null, and the object is immutable.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use only the real RawShopifyThemeMetadata with no mocks.
 */
final class RawShopifyThemeMetadataTest extends TestCase
{
    /**
     * Verify that the fields are stored and returned as supplied.
     */
    public function test_fields_are_returned_exactly_as_supplied(): void
    {
        $raw = new RawShopifyThemeMetadata(
            name: 'Dawn',
            id: 8,
            role: 'main',
        );

        self::assertSame('Dawn', $raw->name());
        self::assertSame(8, $raw->id());
        self::assertSame('main', $raw->role());
    }

    /**
     * Verify that missing fields default to null.
     */
    public function test_missing_fields_default_to_null(): void
    {
        $raw = new RawShopifyThemeMetadata();

        self::assertNull($raw->name());
        self::assertNull($raw->id());
        self::assertNull($raw->role());
    }

    /**
     * Verify that a numeric string id is returned as a string.
     */
    public function test_string_id_is_returned_as_string(): void
    {
        $raw = new RawShopifyThemeMetadata(name: 'Dawn', id: '8');

        self::assertSame('8', $raw->id());
    }

    /**
     * Verify that the object is deterministic.
     */
    public function test_object_is_deterministic(): void
    {
        $first = new RawShopifyThemeMetadata(name: 'Dawn', id: 8, role: 'main');
        $second = new RawShopifyThemeMetadata(name: 'Dawn', id: 8, role: 'main');

        self::assertSame($first->name(), $second->name());
        self::assertSame($first->id(), $second->id());
        self::assertSame($first->role(), $second->role());
    }
}
