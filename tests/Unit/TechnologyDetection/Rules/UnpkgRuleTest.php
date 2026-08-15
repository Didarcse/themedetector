<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\UnpkgRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the UnpkgRule.
 *
 * Verifies the complete evaluation contract: script and stylesheet assets
 * served from the exclusive unpkg.com hostname are recognized at the
 * exclusive-hostname confidence tier, and other CDNs never match.
 */
final class UnpkgRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that an unpkg.com script asset is matched with its identity
     * and evidence metadata.
     */
    public function test_matches_script_asset_with_identity(): void
    {
        $html = '<script src="https://unpkg.com/react@18.2.0/umd/react.production.min.js"></script>';

        $result = (new UnpkgRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(50, $result['confidence']);
        self::assertSame('exclusive-hostname', $result['metadata']['signal']);
        self::assertSame('unpkg.com', $result['metadata']['hostname']);

        $technology = (new UnpkgRule())->technology();
        self::assertSame('unpkg', $technology->name());
        self::assertSame('unpkg', $technology->slug());
        self::assertSame('CDN', $technology->category());
    }

    /**
     * Verify that an unpkg.com stylesheet asset is also matched.
     */
    public function test_matches_stylesheet_asset(): void
    {
        $html = '<link rel="stylesheet" href="https://unpkg.com/tailwindcss@3.4.0/tailwind.min.css">';

        $result = (new UnpkgRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(50, $result['confidence']);
    }

    /**
     * Verify that assets from other CDNs never match.
     */
    public function test_other_cdn_does_not_match(): void
    {
        $html = '<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>';

        $result = (new UnpkgRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }
}
