<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\GoogleTagManagerRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the GoogleTagManagerRule.
 *
 * Verifies the complete evaluation contract: the gtm.js loader asset is
 * recognized, the inline gtm.start marker corroborates an asset match to
 * the highest confidence tier, inline-only usage scores the inline tier,
 * and unrelated HTML never matches.
 */
final class GoogleTagManagerRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that the gtm.js loader asset is matched with its identity and
     * evidence metadata.
     */
    public function test_matches_gtm_loader_asset_with_identity(): void
    {
        $html = '<script src="https://www.googletagmanager.com/gtm.js?id=GTM-ABC123"></script>';

        $result = (new GoogleTagManagerRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
        self::assertSame('script-src', $result['metadata']['signal']);
        self::assertSame('www.googletagmanager.com', $result['metadata']['hostname']);

        $technology = (new GoogleTagManagerRule())->technology();
        self::assertSame('Google Tag Manager', $technology->name());
        self::assertSame('google-tag-manager', $technology->slug());
        self::assertSame('Analytics', $technology->category());
    }

    /**
     * Verify that an asset match corroborated by inline usage scores the
     * highest confidence tier.
     */
    public function test_asset_and_inline_usage_raise_confidence(): void
    {
        $html = '<script src="https://www.googletagmanager.com/gtm.js?id=GTM-ABC123"></script>'
            . '<script>window.dataLayer = window.dataLayer || []; dataLayer.push({\'gtm.start\': new Date().getTime(),'
            . ' event: \'gtm.js\'});</script>';

        $result = (new GoogleTagManagerRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(90, $result['confidence']);
    }

    /**
     * Verify that inline-only usage scores the inline confidence tier.
     */
    public function test_inline_only_scores_inline_confidence(): void
    {
        $html = '<script>window.dataLayer = window.dataLayer || []; dataLayer.push({\'gtm.start\':'
            . ' new Date().getTime(), event: \'gtm.js\'});</script>';

        $result = (new GoogleTagManagerRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(50, $result['confidence']);
        self::assertSame('inline-global', $result['metadata']['signal']);
    }

    /**
     * Verify that a gtag loader alone never matches the GTM rule.
     */
    public function test_gtag_loader_does_not_match(): void
    {
        $html = '<script async src="https://www.googletagmanager.com/gtag/js?id=G-ABCDE12345"></script>';

        $result = (new GoogleTagManagerRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }

    /**
     * Verify that unrelated HTML never matches.
     */
    public function test_no_match_returns_failed_result(): void
    {
        $html = '<script src="https://cdn.example.com/js/app.js"></script>';

        $result = (new GoogleTagManagerRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }
}
