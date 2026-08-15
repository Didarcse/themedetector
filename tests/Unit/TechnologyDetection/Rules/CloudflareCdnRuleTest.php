<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\CloudflareCdnRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the CloudflareCdnRule.
 *
 * Verifies the complete evaluation contract: asset URLs carrying the
 * reserved /cdn-cgi/ path are recognized at the reserved-path confidence
 * tier, and HTML without such a path never matches.
 */
final class CloudflareCdnRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that a /cdn-cgi/ asset URL is matched with its identity and
     * evidence metadata.
     */
    public function test_matches_cdn_cgi_asset_with_identity(): void
    {
        $html = '<script src="https://example.com/cdn-cgi/scripts/5c5dd728/'
            . 'cloudflare-static/rocket-loader.min.js"></script>';

        $result = (new CloudflareCdnRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(70, $result['confidence']);
        self::assertSame('cdn-cgi-path', $result['metadata']['signal']);
        self::assertSame(
            'https://example.com/cdn-cgi/scripts/5c5dd728/cloudflare-static/rocket-loader.min.js',
            $result['metadata']['assetPath'],
        );
        self::assertSame('example.com', $result['metadata']['hostname']);

        $technology = (new CloudflareCdnRule())->technology();
        self::assertSame('Cloudflare', $technology->name());
        self::assertSame('cloudflare', $technology->slug());
        self::assertSame('CDN', $technology->category());
    }

    /**
     * Verify that a /cdn-cgi/ URL in a link href is also matched.
     */
    public function test_matches_cdn_cgi_link_href(): void
    {
        $html = '<link rel="stylesheet" href="https://example.com/cdn-cgi/styles/main.css">';

        $result = (new CloudflareCdnRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(70, $result['confidence']);
    }

    /**
     * Verify that a protocol-relative /cdn-cgi/ URL is matched.
     */
    public function test_matches_protocol_relative_cdn_cgi_url(): void
    {
        $html = '<script src="//example.com/cdn-cgi/scripts/rocket-loader.min.js"></script>';

        $result = (new CloudflareCdnRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame('example.com', $result['metadata']['hostname']);
    }

    /**
     * Verify that HTML without a /cdn-cgi/ path never matches.
     */
    public function test_no_match_returns_failed_result(): void
    {
        $html = '<script src="https://cdn.example.com/js/app.js"></script>';

        $result = (new CloudflareCdnRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }
}
