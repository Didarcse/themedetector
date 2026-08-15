<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\AlpineJsRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the AlpineJsRule.
 *
 * Verifies the complete evaluation contract: Alpine.js script assets are
 * recognized both by basename and by versioned package path, inline
 * usage corroborates an asset match to the highest confidence tier,
 * inline-only usage scores the inline tier, and unrelated HTML never
 * matches.
 */
final class AlpineJsRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that a versioned Alpine.js package asset is matched with its
     * version, identity, and evidence metadata.
     */
    public function test_matches_versioned_package_asset_with_version_and_identity(): void
    {
        $html = '<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>';

        $result = (new AlpineJsRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
        self::assertSame('script-src', $result['metadata']['signal']);
        self::assertSame('cdn.jsdelivr.net', $result['metadata']['hostname']);
        self::assertSame('3.13.5', $result['metadata']['version']);

        $technology = (new AlpineJsRule())->technology();
        self::assertSame('Alpine.js', $technology->name());
        self::assertSame('alpine-js', $technology->slug());
        self::assertSame('JavaScript Library', $technology->category());
    }

    /**
     * Verify that an Alpine.js basename asset is also matched.
     */
    public function test_matches_basename_asset(): void
    {
        $html = '<script defer src="/js/alpine.min.js"></script>';

        $result = (new AlpineJsRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
        self::assertArrayNotHasKey('version', $result['metadata']);
    }

    /**
     * Verify that an asset match corroborated by inline usage scores the
     * highest confidence tier.
     */
    public function test_asset_and_inline_usage_raise_confidence(): void
    {
        $html = '<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>'
            . '<div x-data="{ open: false }"></div>';

        $result = (new AlpineJsRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(90, $result['confidence']);
    }

    /**
     * Verify that inline-only usage scores the inline confidence tier.
     */
    public function test_inline_only_scores_inline_confidence(): void
    {
        $html = '<div x-data="{ open: false }"><button @click="open = true"></button></div>';

        $result = (new AlpineJsRule())->evaluate($html, self::URL);

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

        $result = (new AlpineJsRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }
}
