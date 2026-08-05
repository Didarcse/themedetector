<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\WordPress;

use App\Modules\ThemeExtraction\ThemeMetadata;
use App\Modules\ThemeExtraction\WordPress\RawWordPressThemeMetadata;
use App\Modules\ThemeExtraction\WordPress\WordPressThemeMetadataMapper;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the WordPressThemeMetadataMapper.
 *
 * Verifies the complete public contract of the mapper: every recognized
 * field is translated into its ThemeMetadata counterpart, the Tags field
 * is preserved without splitting, Tested up to is stored inside the extra
 * array, missing fields become null, whitespace is normalized, and mapping
 * is deterministic.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use real objects, no mocks, no filesystem, and no HTTP.
 */
final class WordPressThemeMetadataMapperTest extends TestCase
{
    /**
     * Create a real mapper instance.
     *
     * @return WordPressThemeMetadataMapper The mapper under test.
     */
    private function mapper(): WordPressThemeMetadataMapper
    {
        return new WordPressThemeMetadataMapper();
    }

    /**
     * Wrap the given raw fields in a RawWordPressThemeMetadata object.
     *
     * @param array<string, string> $fields The raw metadata fields.
     *
     * @return RawWordPressThemeMetadata The raw metadata transport object.
     */
    private function raw(array $fields): RawWordPressThemeMetadata
    {
        return new RawWordPressThemeMetadata($fields);
    }

    public function test_maps_theme_name(): void
    {
        $metadata = $this->mapper()->map($this->raw(['Theme Name' => 'Twenty Twenty-Five']));

        self::assertSame('Twenty Twenty-Five', $metadata->name());
    }

    public function test_maps_theme_uri(): void
    {
        $metadata = $this->mapper()->map($this->raw(['Theme URI' => 'https://wordpress.org/themes/twentytwentyfive/']));

        self::assertSame('https://wordpress.org/themes/twentytwentyfive/', $metadata->themeUrl());
    }

    public function test_maps_author(): void
    {
        $metadata = $this->mapper()->map($this->raw(['Author' => 'the WordPress team']));

        self::assertSame('the WordPress team', $metadata->author());
    }

    public function test_maps_author_uri(): void
    {
        $metadata = $this->mapper()->map($this->raw(['Author URI' => 'https://wordpress.org/']));

        self::assertSame('https://wordpress.org/', $metadata->authorUrl());
    }

    public function test_maps_description(): void
    {
        $metadata = $this->mapper()->map($this->raw(['Description' => 'A responsive block theme.']));

        self::assertSame('A responsive block theme.', $metadata->description());
    }

    public function test_maps_version(): void
    {
        $metadata = $this->mapper()->map($this->raw(['Version' => '1.0.3']));

        self::assertSame('1.0.3', $metadata->version());
    }

    public function test_maps_license(): void
    {
        $metadata = $this->mapper()->map($this->raw(['License' => 'GNU General Public License v2 or later']));

        self::assertSame('GNU General Public License v2 or later', $metadata->license());
    }

    public function test_maps_license_uri(): void
    {
        $metadata = $this->mapper()->map($this->raw(['License URI' => 'https://www.gnu.org/licenses/gpl-2.0.html']));

        self::assertSame('https://www.gnu.org/licenses/gpl-2.0.html', $metadata->licenseUrl());
    }

    public function test_maps_text_domain(): void
    {
        $metadata = $this->mapper()->map($this->raw(['Text Domain' => 'twentytwentyfive']));

        self::assertSame('twentytwentyfive', $metadata->textDomain());
    }

    public function test_maps_parent_theme(): void
    {
        $metadata = $this->mapper()->map($this->raw(['Template' => 'twentytwentyfive']));

        self::assertSame('twentytwentyfive', $metadata->parentTheme());
    }

    public function test_maps_requires_php(): void
    {
        $metadata = $this->mapper()->map($this->raw(['Requires PHP' => '7.2']));

        self::assertSame('7.2', $metadata->requiresPhp());
    }

    public function test_maps_requires_wordpress(): void
    {
        $metadata = $this->mapper()->map($this->raw(['Requires at least' => '6.4']));

        self::assertSame('6.4', $metadata->requiresCms());
    }

    public function test_maps_tags_without_splitting(): void
    {
        $metadata = $this->mapper()->map($this->raw(['Tags' => 'blog, one-column, custom-logo']));

        self::assertSame(['blog, one-column, custom-logo'], $metadata->tags());
    }

    public function test_maps_tested_up_to_into_extra(): void
    {
        $metadata = $this->mapper()->map($this->raw(['Tested up to' => '6.7']));

        self::assertSame(['tested_up_to' => '6.7'], $metadata->extra());
    }

    public function test_missing_fields_become_null(): void
    {
        $metadata = $this->mapper()->map($this->raw([]));

        self::assertSame('', $metadata->name());
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
        self::assertSame([], $metadata->extra());
    }

    public function test_trims_surrounding_whitespace(): void
    {
        $metadata = $this->mapper()->map($this->raw([
            'Theme Name' => '  Twenty Twenty-Five  ',
            'Version' => '  1.0  ',
        ]));

        self::assertSame('Twenty Twenty-Five', $metadata->name());
        self::assertSame('1.0', $metadata->version());
    }

    public function test_preserves_internal_whitespace(): void
    {
        $metadata = $this->mapper()->map($this->raw(['Description' => 'A  theme  with   spaces  ']));

        self::assertSame('A  theme  with   spaces', $metadata->description());
    }

    public function test_returns_theme_metadata_instance(): void
    {
        $metadata = $this->mapper()->map($this->raw(['Theme Name' => 'Twenty Twenty-Five']));

        self::assertInstanceOf(ThemeMetadata::class, $metadata);
    }

    public function test_mapping_is_deterministic(): void
    {
        $fields = [
            'Theme Name' => 'Twenty Twenty-Five',
            'Theme URI' => 'https://wordpress.org/themes/twentytwentyfive/',
            'Version' => '1.0',
            'Tags' => 'blog, one-column',
            'Tested up to' => '6.7',
        ];

        $mapper = $this->mapper();
        $first = $mapper->map($this->raw($fields));
        $second = $mapper->map($this->raw($fields));

        self::assertSame($first->name(), $second->name());
        self::assertSame($first->themeUrl(), $second->themeUrl());
        self::assertSame($first->version(), $second->version());
        self::assertSame($first->tags(), $second->tags());
        self::assertSame($first->extra(), $second->extra());
    }
}
