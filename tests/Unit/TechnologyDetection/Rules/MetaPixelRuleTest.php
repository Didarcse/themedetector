<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\MetaPixelRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the MetaPixelRule.
 *
 * Verifies the complete evaluation contract: the fbevents.js loader asset
 * is recognized, inline fbq() usage corroborates an asset match to the
 * highest confidence tier, inline-only usage scores the inline tier, and
 * unrelated HTML never matches.
 */
final class MetaPixelRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that the fbevents.js loader asset is matched with its
     * identity and evidence metadata.
     */
    public function test_matches_fbevents_loader_asset_with_identity(): void
    {
        $html = '<script src="https://connect.facebook.net/en_US/fbevents.js"></script>';

        $result = (new MetaPixelRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
        self::assertSame('script-src', $result['metadata']['signal']);
        self::assertSame('connect.facebook.net', $result['metadata']['hostname']);

        $technology = (new MetaPixelRule())->technology();
        self::assertSame('Meta Pixel', $technology->name());
        self::assertSame('meta-pixel', $technology->slug());
        self::assertSame('Analytics', $technology->category());
    }

    /**
     * Verify that an asset match corroborated by inline usage scores the
     * highest confidence tier.
     */
    public function test_asset_and_inline_usage_raise_confidence(): void
    {
        $html = '<script src="https://connect.facebook.net/en_US/fbevents.js"></script>'
            . '<script>fbq(\'init\', \'123456789012345\'); fbq(\'track\', \'PageView\');</script>';

        $result = (new MetaPixelRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(90, $result['confidence']);
    }

    /**
     * Verify that inline-only usage scores the inline confidence tier.
     */
    public function test_inline_only_scores_inline_confidence(): void
    {
        $html = '<script>fbq(\'init\', \'123456789012345\'); fbq(\'track\', \'PageView\');</script>';

        $result = (new MetaPixelRule())->evaluate($html, self::URL);

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

        $result = (new MetaPixelRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }
}
