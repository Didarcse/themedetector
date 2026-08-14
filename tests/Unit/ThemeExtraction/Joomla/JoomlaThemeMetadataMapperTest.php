<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\Joomla;

use App\Modules\ThemeExtraction\Joomla\JoomlaThemeMetadataMapper;
use App\Modules\ThemeExtraction\Joomla\RawJoomlaTemplateMetadata;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the JoomlaThemeMetadataMapper.
 *
 * Verifies the complete public contract of the mapper: the raw template
 * directory name maps to the ThemeMetadata name trimmed of surrounding
 * whitespace, and every other ThemeMetadata field stays null because the
 * Joomla template path exposes no reliable explicit metadata.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use only real objects with no mocks.
 */
final class JoomlaThemeMetadataMapperTest extends TestCase
{
    /**
     * Create a real mapper instance.
     *
     * @return JoomlaThemeMetadataMapper The mapper under test.
     */
    private function mapper(): JoomlaThemeMetadataMapper
    {
        return new JoomlaThemeMetadataMapper();
    }

    /**
     * Verify that the template slug maps to the theme name.
     */
    public function test_map_uses_template_slug_as_theme_name(): void
    {
        $theme = $this->mapper()->map(new RawJoomlaTemplateMetadata('cassiopeia'));

        self::assertSame('cassiopeia', $theme->name());
    }

    /**
     * Verify that surrounding whitespace is trimmed.
     */
    public function test_map_trims_the_template_slug(): void
    {
        $theme = $this->mapper()->map(new RawJoomlaTemplateMetadata('  cassiopeia  '));

        self::assertSame('cassiopeia', $theme->name());
    }

    /**
     * Verify that every other metadata field stays null.
     */
    public function test_map_leaves_unreliable_fields_null(): void
    {
        $theme = $this->mapper()->map(new RawJoomlaTemplateMetadata('cassiopeia'));

        self::assertNull($theme->version());
        self::assertNull($theme->author());
        self::assertNull($theme->authorUrl());
        self::assertNull($theme->themeUrl());
        self::assertNull($theme->description());
        self::assertNull($theme->license());
        self::assertNull($theme->licenseUrl());
        self::assertNull($theme->textDomain());
        self::assertNull($theme->parentTheme());
        self::assertNull($theme->screenshotUrl());
        self::assertNull($theme->requiresPhp());
        self::assertNull($theme->requiresCms());
        self::assertSame([], $theme->tags());
        self::assertSame([], $theme->extra());
    }
}
