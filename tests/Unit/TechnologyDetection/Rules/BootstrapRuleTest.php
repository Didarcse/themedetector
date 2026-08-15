<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\BootstrapRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the BootstrapRule.
 *
 * Verifies the complete evaluation contract: Bootstrap script and
 * stylesheet assets are recognized with the version extracted from the
 * asset path, inline usage corroborates an asset match to the highest
 * confidence tier, inline-only usage scores the inline tier, and
 * unrelated HTML never matches.
 */
final class BootstrapRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that a Bootstrap stylesheet asset is matched with its
     * version, identity, and evidence metadata.
     */
    public function test_matches_stylesheet_asset_with_version_and_identity(): void
    {
        $html = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/'
            . 'bootstrap.min.css">';

        $result = (new BootstrapRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
        self::assertSame('script-src', $result['metadata']['signal']);
        self::assertSame('cdn.jsdelivr.net', $result['metadata']['hostname']);
        self::assertSame('5.3.0', $result['metadata']['version']);

        $technology = (new BootstrapRule())->technology();
        self::assertSame('Bootstrap', $technology->name());
        self::assertSame('bootstrap', $technology->slug());
        self::assertSame('JavaScript Library', $technology->category());
    }

    /**
     * Verify that a Bootstrap bundle script asset is also matched.
     */
    public function test_matches_bundle_script_asset(): void
    {
        $html = '<script src="https://cdn.example.com/js/bootstrap.bundle.min.js"></script>';

        $result = (new BootstrapRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
    }

    /**
     * Verify that an asset match corroborated by inline usage scores the
     * highest confidence tier.
     */
    public function test_asset_and_inline_usage_raise_confidence(): void
    {
        $html = '<link rel="stylesheet" href="https://cdn.example.com/css/bootstrap.min.css">'
            . '<script>var modal = new bootstrap.Modal(document.getElementById("m"));</script>';

        $result = (new BootstrapRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(90, $result['confidence']);
    }

    /**
     * Verify that inline-only usage scores the inline confidence tier.
     */
    public function test_inline_only_scores_inline_confidence(): void
    {
        $html = '<script>var toast = new bootstrap.Toast(document.getElementById("t"));</script>';

        $result = (new BootstrapRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(50, $result['confidence']);
        self::assertSame('inline-global', $result['metadata']['signal']);
    }

    /**
     * Verify that unrelated HTML never matches.
     */
    public function test_no_match_returns_failed_result(): void
    {
        $html = '<link rel="stylesheet" href="https://cdn.example.com/css/app.css">';

        $result = (new BootstrapRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }
}
