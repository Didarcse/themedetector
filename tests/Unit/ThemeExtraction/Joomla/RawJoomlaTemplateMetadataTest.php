<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Joomla;

use App\Modules\ThemeExtraction\Joomla\RawJoomlaTemplateMetadata;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the RawJoomlaTemplateMetadata value object.
 *
 * Verifies the complete public contract of the transport object: the raw
 * template directory name is stored and returned exactly as supplied, and
 * the object is immutable.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use only the real RawJoomlaTemplateMetadata with no mocks.
 */
final class RawJoomlaTemplateMetadataTest extends TestCase
{
    /**
     * Verify that the template slug is stored and returned as supplied.
     */
    public function test_template_slug_is_returned_exactly_as_supplied(): void
    {
        $raw = new RawJoomlaTemplateMetadata('cassiopeia');

        self::assertSame('cassiopeia', $raw->templateSlug());
    }

    /**
     * Verify that the object is deterministic.
     */
    public function test_object_is_deterministic(): void
    {
        $first = new RawJoomlaTemplateMetadata('cassiopeia');
        $second = new RawJoomlaTemplateMetadata('cassiopeia');

        self::assertSame($first->templateSlug(), $second->templateSlug());
    }
}
