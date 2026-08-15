<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\GoogleAnalyticsRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the GoogleAnalyticsRule.
 *
 * Verifies the complete evaluation contract: the gtag loader asset is
 * recognized, inline usage corroborates an asset match to the highest
 * confidence tier, inline-only usage scores the inline tier, and
 * unrelated HTML never matches.
 */
final class GoogleAnalyticsRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that the gtag loader asset is matched with its identity and
     * evidence metadata.
     */
    public function test_matches_gtag_loader_asset_with_identity(): void
    {
        $html = '<script async src="https://www.googletagmanager.com/gtag/js?id=G-ABCDE12345"></script>';

        $result = (new GoogleAnalyticsRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
        self::assertSame('script-src', $result['metadata']['signal']);
        self::assertSame('www.googletagmanager.com', $result['metadata']['hostname']);

        $technology = (new GoogleAnalyticsRule())->technology();
        self::assertSame('Google Analytics', $technology->name());
        self::assertSame('google-analytics', $technology->slug());
        self::assertSame('Analytics', $technology->category());
    }

    /**
     * Verify that an asset match corroborated by inline usage scores the
     * highest confidence tier.
     */
    public function test_asset_and_inline_usage_raise_confidence(): void
    {
        $html = '<script async src="https://www.googletagmanager.com/gtag/js?id=G-ABCDE12345"></script>'
            . '<script>window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments); }'
            . 'gtag(\'js\', new Date()); gtag(\'config\', \'G-ABCDE12345\');</script>';

        $result = (new GoogleAnalyticsRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(90, $result['confidence']);
    }

    /**
     * Verify that inline-only usage scores the inline confidence tier.
     */
    public function test_inline_only_scores_inline_confidence(): void
    {
        $html = '<script>window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments); }'
            . 'gtag(\'js\', new Date()); gtag(\'config\', \'G-ABCDE12345\');</script>';

        $result = (new GoogleAnalyticsRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(50, $result['confidence']);
        self::assertSame('inline-global', $result['metadata']['signal']);
    }

    /**
     * Verify that a GTM loader alone never matches the Analytics rule.
     */
    public function test_gtm_loader_does_not_match(): void
    {
        $html = '<script src="https://www.googletagmanager.com/gtm.js?id=GTM-ABC123"></script>';

        $result = (new GoogleAnalyticsRule())->evaluate($html, self::URL);

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

        $result = (new GoogleAnalyticsRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }
}
