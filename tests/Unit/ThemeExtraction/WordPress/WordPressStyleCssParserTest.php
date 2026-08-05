<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\WordPress;

use App\Modules\ThemeExtraction\WordPress\RawWordPressThemeMetadata;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssParser;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the WordPressStyleCssParser.
 *
 * Verifies the complete public contract of the parser: every recognized
 * field is extracted from the metadata header, unknown fields and CSS
 * rules are ignored, parsing stops at the end of the header comment,
 * original values are preserved, and both Windows and Linux line endings
 * are handled.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use a real parser instance, no mocks, no fixtures, no filesystem,
 * and no HTTP.
 */
final class WordPressStyleCssParserTest extends TestCase
{
    /**
     * Parse the given style.css contents with a real parser instance.
     *
     * @param string $styleCss The style.css contents to parse.
     *
     * @return RawWordPressThemeMetadata The parsed raw metadata.
     */
    private function parse(string $styleCss): RawWordPressThemeMetadata
    {
        return (new WordPressStyleCssParser())->parse($styleCss);
    }

    /**
     * Build a style.css metadata header from the given fields.
     *
     * @param array<string, string> $fields The header fields.
     *
     * @return string A style.css string carrying the given header fields.
     */
    private function styleCss(array $fields): string
    {
        $lines = [];

        foreach ($fields as $key => $value) {
            $lines[] = $key . ': ' . $value;
        }

        return "/*\n" . implode("\n", $lines) . "\n*/";
    }

    public function test_parses_theme_name(): void
    {
        $metadata = $this->parse($this->styleCss(['Theme Name' => 'Twenty Twenty-Five']));

        self::assertSame('Twenty Twenty-Five', $metadata->fields()['Theme Name']);
    }

    public function test_parses_theme_uri(): void
    {
        $metadata = $this->parse($this->styleCss(['Theme URI' => 'https://wordpress.org/themes/twentytwentyfive/']));

        self::assertSame('https://wordpress.org/themes/twentytwentyfive/', $metadata->fields()['Theme URI']);
    }

    public function test_parses_author(): void
    {
        $metadata = $this->parse($this->styleCss(['Author' => 'the WordPress team']));

        self::assertSame('the WordPress team', $metadata->fields()['Author']);
    }

    public function test_parses_author_uri(): void
    {
        $metadata = $this->parse($this->styleCss(['Author URI' => 'https://wordpress.org/']));

        self::assertSame('https://wordpress.org/', $metadata->fields()['Author URI']);
    }

    public function test_parses_description(): void
    {
        $metadata = $this->parse($this->styleCss(['Description' => 'A responsive block theme.']));

        self::assertSame('A responsive block theme.', $metadata->fields()['Description']);
    }

    public function test_parses_version(): void
    {
        $metadata = $this->parse($this->styleCss(['Version' => '1.0.3']));

        self::assertSame('1.0.3', $metadata->fields()['Version']);
    }

    public function test_parses_license(): void
    {
        $metadata = $this->parse($this->styleCss(['License' => 'GNU General Public License v2 or later']));

        self::assertSame('GNU General Public License v2 or later', $metadata->fields()['License']);
    }

    public function test_parses_license_uri(): void
    {
        $metadata = $this->parse($this->styleCss(['License URI' => 'https://www.gnu.org/licenses/gpl-2.0.html']));

        self::assertSame('https://www.gnu.org/licenses/gpl-2.0.html', $metadata->fields()['License URI']);
    }

    public function test_parses_tags(): void
    {
        $metadata = $this->parse($this->styleCss(['Tags' => 'blog, one-column, custom-logo']));

        self::assertSame('blog, one-column, custom-logo', $metadata->fields()['Tags']);
    }

    public function test_parses_text_domain(): void
    {
        $metadata = $this->parse($this->styleCss(['Text Domain' => 'twentytwentyfive']));

        self::assertSame('twentytwentyfive', $metadata->fields()['Text Domain']);
    }

    public function test_parses_requires_php(): void
    {
        $metadata = $this->parse($this->styleCss(['Requires PHP' => '7.2']));

        self::assertSame('7.2', $metadata->fields()['Requires PHP']);
    }

    public function test_parses_requires_at_least(): void
    {
        $metadata = $this->parse($this->styleCss(['Requires at least' => '6.4']));

        self::assertSame('6.4', $metadata->fields()['Requires at least']);
    }

    public function test_parses_tested_up_to(): void
    {
        $metadata = $this->parse($this->styleCss(['Tested up to' => '6.7']));

        self::assertSame('6.7', $metadata->fields()['Tested up to']);
    }

    public function test_parses_template(): void
    {
        $metadata = $this->parse($this->styleCss(['Template' => 'twentytwentyfive']));

        self::assertSame('twentytwentyfive', $metadata->fields()['Template']);
    }

    public function test_returns_empty_metadata_for_empty_file(): void
    {
        $metadata = $this->parse('');

        self::assertSame([], $metadata->fields());
    }

    public function test_ignores_unknown_fields(): void
    {
        $metadata = $this->parse(
            "/*\n"
            . "Not A Field: ignored\n"
            . "Some line without a colon\n"
            . "Version: 1.0\n"
            . "*/",
        );

        self::assertSame('1.0', $metadata->fields()['Version']);
        self::assertArrayNotHasKey('Not A Field', $metadata->fields());
    }

    public function test_ignores_css_rules(): void
    {
        $metadata = $this->parse(
            "body {\n"
            . "    color: red;\n"
            . "}\n"
            . "\n"
            . "/*\n"
            . "Theme Name: Twenty Twenty-Five\n"
            . "Theme URI: https://example.com/\n"
            . "*/\n"
            . "\n"
            . ".footer {\n"
            . "    background: blue;\n"
            . "}\n",
        );

        self::assertSame('Twenty Twenty-Five', $metadata->fields()['Theme Name']);
        self::assertSame('https://example.com/', $metadata->fields()['Theme URI']);
        self::assertCount(2, $metadata->fields());
    }

    public function test_stops_after_header_comment(): void
    {
        $metadata = $this->parse(
            "/*\n"
            . "Theme Name: Real Theme\n"
            . "*/\n"
            . "/*\n"
            . "Theme Name: Fake Theme\n"
            . "Version: 9.9\n"
            . "*/",
        );

        self::assertSame('Real Theme', $metadata->fields()['Theme Name']);
        self::assertArrayNotHasKey('Version', $metadata->fields());
    }

    public function test_preserves_original_values(): void
    {
        $metadata = $this->parse(
            "/*\n"
            . "Theme NAME:   Twenty   Twenty-Five  \n"
            . "Description:  A  theme  with   spaces  \n"
            . "*/",
        );

        self::assertSame('Twenty   Twenty-Five', $metadata->fields()['Theme Name']);
        self::assertSame('A  theme  with   spaces', $metadata->fields()['Description']);
    }

    public function test_parses_windows_line_endings(): void
    {
        $metadata = $this->parse(
            "/*\r\n"
            . "Theme Name: Twenty Twenty-Five\r\n"
            . "Version: 1.0\r\n"
            . "*/",
        );

        self::assertSame('Twenty Twenty-Five', $metadata->fields()['Theme Name']);
        self::assertSame('1.0', $metadata->fields()['Version']);
    }

    public function test_parses_linux_line_endings(): void
    {
        $metadata = $this->parse(
            "/*\n"
            . "Theme Name: Twenty Twenty-Five\n"
            . "Version: 1.0\n"
            . "*/",
        );

        self::assertSame('Twenty Twenty-Five', $metadata->fields()['Theme Name']);
        self::assertSame('1.0', $metadata->fields()['Version']);
    }
}
