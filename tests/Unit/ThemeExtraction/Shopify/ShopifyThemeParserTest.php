<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Shopify;

use App\Modules\ThemeExtraction\Shopify\RawShopifyThemeMetadata;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeParser;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the ShopifyThemeParser.
 *
 * Verifies the complete public contract of the parser: the raw theme name,
 * id, and role fields are extracted from a window.Shopify object literal,
 * double- and single-quoted strings and JSON-style keys are supported,
 * quotes are unescaped, extra properties are ignored, array properties are
 * skipped, a theme property that is missing or not an object yields null,
 * a malformed or non-object literal yields null, and parsing is
 * deterministic.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use only a real ShopifyThemeParser with no mocks.
 */
final class ShopifyThemeParserTest extends TestCase
{
    /**
     * Create a real parser instance.
     *
     * @return ShopifyThemeParser The parser under test.
     */
    private function parser(): ShopifyThemeParser
    {
        return new ShopifyThemeParser();
    }

    /**
     * Verify that the theme metadata is extracted from a canonical object.
     */
    public function test_parse_extracts_theme_metadata(): void
    {
        $raw = $this->parser()->parse('{ theme: { id: 8, name: "Dawn", role: "main" } }');

        self::assertNotNull($raw);
        self::assertSame('Dawn', $raw->name());
        self::assertSame(8, $raw->id());
        self::assertSame('main', $raw->role());
    }

    /**
     * Verify that double-quoted JSON-style objects are supported.
     */
    public function test_parse_handles_double_quoted_json_style(): void
    {
        $raw = $this->parser()->parse('{"theme":{"id":123,"name":"Dawn","role":"main"}}');

        self::assertNotNull($raw);
        self::assertSame('Dawn', $raw->name());
        self::assertSame(123, $raw->id());
        self::assertSame('main', $raw->role());
    }

    /**
     * Verify that single-quoted strings are supported.
     */
    public function test_parse_handles_single_quoted_strings(): void
    {
        $raw = $this->parser()->parse("{ theme: { name: 'Dawn', role: 'main' } }");

        self::assertNotNull($raw);
        self::assertSame('Dawn', $raw->name());
        self::assertNull($raw->id());
        self::assertSame('main', $raw->role());
    }

    /**
     * Verify that extra properties around theme are ignored.
     */
    public function test_parse_ignores_extra_properties(): void
    {
        $raw = $this->parser()->parse(
            '{ routes: { root: "/" }, theme: { id: 8, name: "Dawn" }, shop: { name: "x" } }',
        );

        self::assertNotNull($raw);
        self::assertSame('Dawn', $raw->name());
        self::assertSame(8, $raw->id());
        self::assertNull($raw->role());
    }

    /**
     * Verify that array properties are skipped without breaking parsing.
     */
    public function test_parse_skips_array_properties(): void
    {
        $raw = $this->parser()->parse('{ sections: [{ id: 1 }, { id: 2 }], theme: { name: "Dawn" } }');

        self::assertNotNull($raw);
        self::assertSame('Dawn', $raw->name());
    }

    /**
     * Verify that quotes inside a name are unescaped.
     */
    public function test_parse_unescapes_quotes(): void
    {
        $raw = $this->parser()->parse('{ theme: { name: "Deux \\"Tours\\"" } }');

        self::assertNotNull($raw);
        self::assertSame('Deux "Tours"', $raw->name());
    }

    /**
     * Verify that the interior form without outer braces is supported.
     *
     * The locator delivers object interiors; the parser must accept them
     * as well as fully braced literals.
     */
    public function test_parse_handles_interior_form_without_braces(): void
    {
        $raw = $this->parser()->parse(' theme: { id: 8, name: "Dawn", role: "main" } ');

        self::assertNotNull($raw);
        self::assertSame('Dawn', $raw->name());
        self::assertSame(8, $raw->id());
        self::assertSame('main', $raw->role());
    }

    /**
     * Verify that a missing theme property yields null.
     */
    public function test_parse_returns_null_for_missing_theme(): void
    {
        self::assertNull($this->parser()->parse('{ routes: { root: "/" } }'));
    }

    /**
     * Verify that a non-object theme property yields null.
     */
    public function test_parse_returns_null_when_theme_not_object(): void
    {
        self::assertNull($this->parser()->parse('{ theme: "Dawn" }'));
    }

    /**
     * Verify that a malformed object literal yields null.
     */
    public function test_parse_returns_null_for_malformed_object(): void
    {
        self::assertNull($this->parser()->parse('{ theme: { name: "Dawn" '));
    }

    /**
     * Verify that an empty string yields null.
     */
    public function test_parse_returns_null_for_empty_string(): void
    {
        self::assertNull($this->parser()->parse(''));
    }

    /**
     * Verify that non-object text yields null.
     */
    public function test_parse_returns_null_for_non_object_text(): void
    {
        self::assertNull($this->parser()->parse('hello'));
    }

    /**
     * Verify that a theme object without a name yields a null name.
     */
    public function test_parse_missing_name_yields_null_name(): void
    {
        $raw = $this->parser()->parse('{ theme: { id: 8, role: "main" } }');

        self::assertNotNull($raw);
        self::assertNull($raw->name());
        self::assertSame(8, $raw->id());
        self::assertSame('main', $raw->role());
    }

    /**
     * Verify that a numeric string id is preserved as a string.
     */
    public function test_parse_preserves_numeric_string_id(): void
    {
        $raw = $this->parser()->parse('{ theme: { id: "8", name: "Dawn" } }');

        self::assertNotNull($raw);
        self::assertSame('8', $raw->id());
    }

    /**
     * Verify that parsing is deterministic.
     */
    public function test_parse_is_deterministic(): void
    {
        $parser = $this->parser();

        $first = $parser->parse('{ theme: { id: 8, name: "Dawn", role: "main" } }');
        $second = $parser->parse('{ theme: { id: 8, name: "Dawn", role: "main" } }');

        self::assertNotNull($first);
        self::assertNotNull($second);
        self::assertSame($first->name(), $second->name());
        self::assertSame($first->id(), $second->id());
        self::assertSame($first->role(), $second->role());
    }

    /**
     * Verify that the returned object is a RawShopifyThemeMetadata.
     */
    public function test_parse_returns_raw_metadata_object(): void
    {
        self::assertInstanceOf(
            RawShopifyThemeMetadata::class,
            $this->parser()->parse('{ theme: { name: "Dawn" } }'),
        );
    }
}
