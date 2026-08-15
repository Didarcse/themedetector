<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\JQueryRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the JQueryRule.
 *
 * Verifies the complete evaluation contract: jQuery script assets are
 * recognized with the version extracted from the asset path, inline
 * usage corroborates an asset match to the highest confidence tier,
 * inline-only usage scores the inline tier, and unrelated HTML never
 * matches. The rule is stateless and deterministic.
 */
final class JQueryRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that a jQuery script asset is matched with its version,
     * identity, and evidence metadata.
     */
    public function test_matches_asset_with_version_and_identity(): void
    {
        $html = '<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>';

        $result = (new JQueryRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
        self::assertSame('script-src', $result['metadata']['signal']);
        self::assertSame('https://code.jquery.com/jquery-3.7.1.min.js', $result['metadata']['assetPath']);
        self::assertSame('code.jquery.com', $result['metadata']['hostname']);
        self::assertSame('3.7.1', $result['metadata']['version']);

        $technology = (new JQueryRule())->technology();
        self::assertSame('jQuery', $technology->name());
        self::assertSame('jquery', $technology->slug());
        self::assertSame('JavaScript Library', $technology->category());
    }

    /**
     * Verify that a minified jQuery asset without a version still matches.
     */
    public function test_matches_minified_asset_without_version(): void
    {
        $html = '<script src="https://cdn.example.com/js/jquery.min.js"></script>';

        $result = (new JQueryRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
        self::assertArrayNotHasKey('version', $result['metadata']);
    }

    /**
     * Verify that an asset match corroborated by inline usage scores the
     * highest confidence tier.
     */
    public function test_asset_and_inline_usage_raise_confidence(): void
    {
        $html = '<script src="https://code.jquery.com/jquery.min.js"></script>'
            . '<script>jQuery(document).ready(function () { $("body").hide(); });</script>';

        $result = (new JQueryRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(90, $result['confidence']);
    }

    /**
     * Verify that inline-only usage scores the inline confidence tier.
     */
    public function test_inline_only_scores_inline_confidence(): void
    {
        $html = '<script>jQuery(function () { $("body").hide(); });</script>';

        $result = (new JQueryRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(50, $result['confidence']);
        self::assertSame('inline-global', $result['metadata']['signal']);
        self::assertArrayNotHasKey('assetPath', $result['metadata']);
    }

    /**
     * Verify that unrelated HTML never matches.
     */
    public function test_no_match_returns_failed_result(): void
    {
        $html = '<script src="https://cdn.example.com/js/app.js"></script>';

        $result = (new JQueryRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }

    /**
     * Verify that the rule is deterministic.
     */
    public function test_rule_is_deterministic(): void
    {
        $html = '<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>';

        $rule = new JQueryRule();

        self::assertSame($rule->evaluate($html, self::URL), $rule->evaluate($html, self::URL));
    }
}
