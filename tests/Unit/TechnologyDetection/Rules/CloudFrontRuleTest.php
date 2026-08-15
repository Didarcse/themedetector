<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\CloudFrontRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the CloudFrontRule.
 *
 * Verifies the complete evaluation contract: script and stylesheet assets
 * served from a *.cloudfront.net hostname are recognized at the
 * multi-tenant-hostname confidence tier, and other hosts never match.
 */
final class CloudFrontRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that a *.cloudfront.net script asset is matched with its
     * identity and evidence metadata.
     */
    public function test_matches_cloudfront_script_asset_with_identity(): void
    {
        $html = '<script src="https://d2r0n5x7h3d1a4.cloudfront.net/js/main.js"></script>';

        $result = (new CloudFrontRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(45, $result['confidence']);
        self::assertSame('multi-tenant-hostname', $result['metadata']['signal']);
        self::assertSame('d2r0n5x7h3d1a4.cloudfront.net', $result['metadata']['hostname']);

        $technology = (new CloudFrontRule())->technology();
        self::assertSame('CloudFront', $technology->name());
        self::assertSame('cloudfront', $technology->slug());
        self::assertSame('CDN', $technology->category());
    }

    /**
     * Verify that a *.cloudfront.net stylesheet asset is also matched.
     */
    public function test_matches_cloudfront_stylesheet_asset(): void
    {
        $html = '<link rel="stylesheet" href="https://d111111abcdef8.cloudfront.net/css/main.css">';

        $result = (new CloudFrontRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(45, $result['confidence']);
    }

    /**
     * Verify that other hosts never match.
     */
    public function test_non_cloudfront_host_does_not_match(): void
    {
        $html = '<script src="https://cdn.example.com/js/app.js"></script>';

        $result = (new CloudFrontRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }
}
