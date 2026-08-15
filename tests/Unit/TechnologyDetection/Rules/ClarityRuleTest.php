<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\ClarityRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the ClarityRule.
 *
 * Verifies the complete evaluation contract: a /tag/ asset on the
 * exclusive clarity.ms hostname is the strong asset tier, inline clarity()
 * usage corroborates an asset match to the highest confidence tier, and
 * hostname-only or inline-only evidence scores the lower tier.
 */
final class ClarityRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that a /tag/ asset on clarity.ms is matched with its
     * identity and evidence metadata.
     */
    public function test_matches_tag_asset_with_identity(): void
    {
        $html = '<script src="https://www.clarity.ms/tag/abc123"></script>';

        $result = (new ClarityRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
        self::assertSame('script-src', $result['metadata']['signal']);
        self::assertSame('www.clarity.ms', $result['metadata']['hostname']);

        $technology = (new ClarityRule())->technology();
        self::assertSame('Microsoft Clarity', $technology->name());
        self::assertSame('clarity', $technology->slug());
        self::assertSame('Analytics', $technology->category());
    }

    /**
     * Verify that an asset match corroborated by inline usage scores the
     * highest confidence tier.
     */
    public function test_asset_and_inline_usage_raise_confidence(): void
    {
        $html = '<script src="https://www.clarity.ms/tag/abc123"></script>'
            . '<script>clarity(\'set\', \'some-key\', \'some-value\');</script>';

        $result = (new ClarityRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(90, $result['confidence']);
    }

    /**
     * Verify that a non-/tag/ asset on clarity.ms scores the
     * exclusive-hostname tier.
     */
    public function test_hostname_only_scores_hostname_confidence(): void
    {
        $html = '<script src="https://clarity.ms/other.js"></script>';

        $result = (new ClarityRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(50, $result['confidence']);
        self::assertSame('exclusive-hostname', $result['metadata']['signal']);
    }

    /**
     * Verify that inline-only usage scores the inline confidence tier.
     */
    public function test_inline_only_scores_inline_confidence(): void
    {
        $html = '<script>window.clarity(\'consent\', true);</script>';

        $result = (new ClarityRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(50, $result['confidence']);
        self::assertSame('inline-global', $result['metadata']['signal']);
    }

    /**
     * Verify that unrelated HTML never matches.
     */
    public function test_no_match_returns_failed_result(): void
    {
        $html = '<script src="https://cdn.example.com/js/app.js"></script>';

        $result = (new ClarityRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }
}
