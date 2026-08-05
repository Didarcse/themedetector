<?php

declare(strict_types=1);

namespace Tests\Unit\PluginDetection\WordPress;

use App\Modules\PluginDetection\WordPress\PluginSlugExtractor;
use App\Modules\PluginDetection\WordPress\RawPluginMetadata;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the PluginSlugExtractor.
 *
 * Verifies the complete public contract of the extractor: a matching rule
 * result is transformed into a RawPluginMetadata transport object, null is
 * returned when no plugin slug can be extracted, non-string entries are
 * ignored, the primary slug and confidence score are preserved exactly,
 * the rule metadata is preserved unchanged inside extra(), the supplied
 * rule result is never modified, and the transformation is deterministic.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use a real PluginSlugExtractor and a real RawPluginMetadata, no
 * mocks, no fixtures, no filesystem, and no HTTP.
 */
final class PluginSlugExtractorTest extends TestCase
{
    /**
     * Extract raw plugin metadata from a rule result with a real
     * extractor instance.
     *
     * @param array{
     *     matched: bool,
     *     confidence: int,
     *     metadata: array<string, mixed>
     * } $ruleResult The plugin detection rule evaluation result.
     *
     * @return RawPluginMetadata|null The extracted raw plugin metadata, or
     *                                null when no plugin slug was detected.
     */
    private function extract(array $ruleResult): ?RawPluginMetadata
    {
        return (new PluginSlugExtractor())->extract($ruleResult);
    }

    /**
     * Build a plugin detection rule evaluation result.
     *
     * @param bool                 $matched    Whether the rule matched.
     * @param int                  $confidence The rule confidence score.
     * @param array<string, mixed> $metadata   The rule metadata array.
     *
     * @return array{
     *     matched: bool,
     *     confidence: int,
     *     metadata: array<string, mixed>
     * }
     */
    private function ruleResult(bool $matched, int $confidence, array $metadata): array
    {
        return [
            'matched' => $matched,
            'confidence' => $confidence,
            'metadata' => $metadata,
        ];
    }

    /**
     * Verify that a matching rule result is transformed into a
     * RawPluginMetadata transport object.
     */
    public function test_returns_raw_plugin_metadata_when_rule_matches(): void
    {
        $metadata = $this->extract($this->ruleResult(
            matched: true,
            confidence: 30,
            metadata: ['plugins' => ['contact-form-7']],
        ));

        self::assertInstanceOf(RawPluginMetadata::class, $metadata);
    }

    /**
     * Verify that null is returned when the rule did not match.
     */
    public function test_returns_null_when_rule_does_not_match(): void
    {
        $metadata = $this->extract($this->ruleResult(
            matched: false,
            confidence: 0,
            metadata: [],
        ));

        self::assertNull($metadata);
    }

    /**
     * Verify that null is returned when the metadata contains no plugins
     * key.
     */
    public function test_returns_null_when_metadata_has_no_plugins_key(): void
    {
        $metadata = $this->extract($this->ruleResult(
            matched: true,
            confidence: 30,
            metadata: ['source' => 'plugin-path'],
        ));

        self::assertNull($metadata);
    }

    /**
     * Verify that null is returned when the plugins value is not an array.
     */
    public function test_returns_null_when_plugins_is_not_an_array(): void
    {
        $metadata = $this->extract($this->ruleResult(
            matched: true,
            confidence: 30,
            metadata: ['plugins' => 'contact-form-7'],
        ));

        self::assertNull($metadata);
    }

    /**
     * Verify that null is returned when the plugins array is empty.
     */
    public function test_returns_null_when_plugins_array_is_empty(): void
    {
        $metadata = $this->extract($this->ruleResult(
            matched: true,
            confidence: 30,
            metadata: ['plugins' => []],
        ));

        self::assertNull($metadata);
    }

    /**
     * Verify that non-string plugin entries are ignored.
     *
     * Only string entries contribute to the extracted primary slug, while
     * the original metadata is still preserved unchanged inside extra().
     */
    public function test_ignores_non_string_plugin_entries(): void
    {
        $metadata = ['plugins' => ['woocommerce', 42, null, ['nested'], 'akismet']];

        $raw = $this->extract($this->ruleResult(
            matched: true,
            confidence: 30,
            metadata: $metadata,
        ));

        self::assertNotNull($raw);
        self::assertSame('woocommerce', $raw->slug());
        self::assertSame($metadata, $raw->extra());
    }

    /**
     * Verify that the first detected plugin slug is used exactly as
     * supplied.
     */
    public function test_uses_first_detected_slug_exactly_as_supplied(): void
    {
        $raw = $this->extract($this->ruleResult(
            matched: true,
            confidence: 30,
            metadata: ['plugins' => ['contact-form-7', 'woocommerce']],
        ));

        self::assertNotNull($raw);
        self::assertSame('contact-form-7', $raw->slug());
    }

    /**
     * Verify that the confidence score is preserved unchanged.
     */
    public function test_preserves_confidence_score(): void
    {
        $raw = $this->extract($this->ruleResult(
            matched: true,
            confidence: 30,
            metadata: ['plugins' => ['contact-form-7']],
        ));

        self::assertNotNull($raw);
        self::assertSame(30, $raw->confidence());
    }

    /**
     * Verify that the rule metadata is preserved unchanged inside extra().
     */
    public function test_preserves_metadata_unchanged_in_extra(): void
    {
        $metadata = [
            'plugins' => ['contact-form-7', 'woocommerce'],
            'source' => 'plugin-path',
        ];

        $raw = $this->extract($this->ruleResult(
            matched: true,
            confidence: 30,
            metadata: $metadata,
        ));

        self::assertNotNull($raw);
        self::assertSame($metadata, $raw->extra());
    }

    /**
     * Verify that the supplied rule result is never modified.
     */
    public function test_does_not_modify_supplied_rule_result(): void
    {
        $ruleResult = $this->ruleResult(
            matched: true,
            confidence: 30,
            metadata: ['plugins' => ['contact-form-7']],
        );

        $expected = $ruleResult;

        $this->extract($ruleResult);

        self::assertSame($expected, $ruleResult);
    }

    /**
     * Verify that the extraction is deterministic.
     *
     * Repeated extraction of the same rule result always produces the same
     * RawPluginMetadata values.
     */
    public function test_extraction_is_deterministic(): void
    {
        $ruleResult = $this->ruleResult(
            matched: true,
            confidence: 30,
            metadata: ['plugins' => ['contact-form-7', 'woocommerce']],
        );

        $first = $this->extract($ruleResult);
        $second = $this->extract($ruleResult);

        self::assertNotNull($first);
        self::assertNotNull($second);
        self::assertSame($first->slug(), $second->slug());
        self::assertSame($first->confidence(), $second->confidence());
        self::assertSame($first->extra(), $second->extra());
    }
}
