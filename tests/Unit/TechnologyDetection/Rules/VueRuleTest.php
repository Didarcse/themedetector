<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\VueRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the VueRule.
 *
 * Verifies the complete evaluation contract: Vue script assets are
 * recognized with the version extracted from the asset path, inline
 * usage corroborates an asset match to the highest confidence tier,
 * inline-only usage scores the inline tier, and unrelated HTML never
 * matches.
 */
final class VueRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that a Vue global production asset is matched with its
     * version, identity, and evidence metadata.
     */
    public function test_matches_asset_with_version_and_identity(): void
    {
        $html = '<script src="https://cdn.jsdelivr.net/npm/vue@3.4.0/dist/vue.global.prod.js"></script>';

        $result = (new VueRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
        self::assertSame('script-src', $result['metadata']['signal']);
        self::assertSame('cdn.jsdelivr.net', $result['metadata']['hostname']);
        self::assertSame('3.4.0', $result['metadata']['version']);

        $technology = (new VueRule())->technology();
        self::assertSame('Vue', $technology->name());
        self::assertSame('vue', $technology->slug());
        self::assertSame('JavaScript Library', $technology->category());
    }

    /**
     * Verify that a Vue 2 minified asset is also matched.
     */
    public function test_matches_vue_two_asset(): void
    {
        $html = '<script src="https://cdn.example.com/js/vue.min.js"></script>';

        $result = (new VueRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
    }

    /**
     * Verify that an asset match corroborated by inline usage scores the
     * highest confidence tier.
     */
    public function test_asset_and_inline_usage_raise_confidence(): void
    {
        $html = '<script src="https://cdn.jsdelivr.net/npm/vue@3.4.0/dist/vue.global.prod.js"></script>'
            . '<script>Vue.createApp({ data() { return {}; } }).mount("#app");</script>';

        $result = (new VueRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(90, $result['confidence']);
    }

    /**
     * Verify that inline-only usage scores the inline confidence tier.
     */
    public function test_inline_only_scores_inline_confidence(): void
    {
        $html = '<script>var app = new Vue({ el: "#app", data: {} });</script>';

        $result = (new VueRule())->evaluate($html, self::URL);

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

        $result = (new VueRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }
}
