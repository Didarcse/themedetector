<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\AngularRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the AngularRule.
 *
 * Verifies the complete evaluation contract: classic Angular script
 * assets are recognized with the version extracted from the asset path,
 * inline usage corroborates an asset match to the highest confidence
 * tier, inline-only usage scores the inline tier, and unrelated HTML
 * never matches.
 */
final class AngularRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that an Angular script asset is matched with its version,
     * identity, and evidence metadata.
     */
    public function test_matches_asset_with_version_and_identity(): void
    {
        $html = '<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.2/angular.min.js"></script>';

        $result = (new AngularRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
        self::assertSame('script-src', $result['metadata']['signal']);
        self::assertSame('cdnjs.cloudflare.com', $result['metadata']['hostname']);
        self::assertSame('1.8.2', $result['metadata']['version']);

        $technology = (new AngularRule())->technology();
        self::assertSame('Angular', $technology->name());
        self::assertSame('angular', $technology->slug());
        self::assertSame('JavaScript Library', $technology->category());
    }

    /**
     * Verify that a versioned Angular filename is also matched.
     */
    public function test_matches_versioned_filename(): void
    {
        $html = '<script src="https://cdn.example.com/js/angular-1.8.2.min.js"></script>';

        $result = (new AngularRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame('1.8.2', $result['metadata']['version']);
    }

    /**
     * Verify that an asset match corroborated by inline usage scores the
     * highest confidence tier.
     */
    public function test_asset_and_inline_usage_raise_confidence(): void
    {
        $html = '<script src="https://cdn.example.com/angular.min.js"></script>'
            . '<script>angular.module("app", []);</script>';

        $result = (new AngularRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(90, $result['confidence']);
    }

    /**
     * Verify that inline-only usage scores the inline confidence tier.
     */
    public function test_inline_only_scores_inline_confidence(): void
    {
        $html = '<script>angular.bootstrap(document, ["app"]);</script>';

        $result = (new AngularRule())->evaluate($html, self::URL);

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

        $result = (new AngularRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }
}
