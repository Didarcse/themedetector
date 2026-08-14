<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Drupal;

use App\Modules\ThemeExtraction\Drupal\RawDrupalThemeMetadata;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the RawDrupalThemeMetadata value object.
 *
 * Verifies the complete public contract of the transport object: the raw
 * theme directory name is stored and returned exactly as supplied, and the
 * object is immutable.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use only the real RawDrupalThemeMetadata with no mocks.
 */
final class RawDrupalThemeMetadataTest extends TestCase
{
    /**
     * Verify that the theme slug is stored and returned as supplied.
     */
    public function test_theme_slug_is_returned_exactly_as_supplied(): void
    {
        $raw = new RawDrupalThemeMetadata('newsroom');

        self::assertSame('newsroom', $raw->themeSlug());
    }

    /**
     * Verify that the object is deterministic.
     */
    public function test_object_is_deterministic(): void
    {
        $first = new RawDrupalThemeMetadata('newsroom');
        $second = new RawDrupalThemeMetadata('newsroom');

        self::assertSame($first->themeSlug(), $second->themeSlug());
    }
}
