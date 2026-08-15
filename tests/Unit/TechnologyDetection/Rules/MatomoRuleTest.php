<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\MatomoRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the MatomoRule.
 *
 * Verifies the complete evaluation contract: the matomo.js tracker asset
 * is recognized, inline _paq usage corroborates an asset match to the
 * highest confidence tier, inline-only usage scores the inline tier, and
 * unrelated HTML never matches.
 */
final class MatomoRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that the matomo.js tracker asset is matched with its
     * identity and evidence metadata.
     */
    public function test_matches_matomo_tracker_asset_with_identity(): void
    {
        $html = '<script src="https://analytics.example.com/matomo/matomo.js"></script>';

        $result = (new MatomoRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
        self::assertSame('script-src', $result['metadata']['signal']);
        self::assertSame('analytics.example.com', $result['metadata']['hostname']);

        $technology = (new MatomoRule())->technology();
        self::assertSame('Matomo', $technology->name());
        self::assertSame('matomo', $technology->slug());
        self::assertSame('Analytics', $technology->category());
    }

    /**
     * Verify that an asset match corroborated by inline usage scores the
     * highest confidence tier.
     */
    public function test_asset_and_inline_usage_raise_confidence(): void
    {
        $html = '<script src="https://analytics.example.com/matomo/matomo.js"></script>'
            . '<script>var _paq = window._paq = window._paq || []; _paq.push([\'trackPageView\']);</script>';

        $result = (new MatomoRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(90, $result['confidence']);
    }

    /**
     * Verify that inline-only usage scores the inline confidence tier.
     */
    public function test_inline_only_scores_inline_confidence(): void
    {
        $html = '<script>var _paq = _paq || []; _paq.push([\'setSiteId\', \'1\']);'
            . ' _paq.push([\'trackPageView\']);</script>';

        $result = (new MatomoRule())->evaluate($html, self::URL);

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

        $result = (new MatomoRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }
}
