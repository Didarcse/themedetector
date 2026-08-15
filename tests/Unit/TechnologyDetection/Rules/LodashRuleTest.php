<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\LodashRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the LodashRule.
 *
 * Verifies the complete evaluation contract: Lodash script assets are
 * recognized with the version extracted from the asset path, and
 * unrelated HTML never matches. Lodash exposes no distinct inline global,
 * so inline usage is never used as evidence.
 */
final class LodashRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that a Lodash script asset is matched with its version,
     * identity, and evidence metadata.
     */
    public function test_matches_asset_with_version_and_identity(): void
    {
        $html = '<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>';

        $result = (new LodashRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
        self::assertSame('script-src', $result['metadata']['signal']);
        self::assertSame('cdn.jsdelivr.net', $result['metadata']['hostname']);
        self::assertSame('4.17.21', $result['metadata']['version']);

        $technology = (new LodashRule())->technology();
        self::assertSame('Lodash', $technology->name());
        self::assertSame('lodash', $technology->slug());
        self::assertSame('JavaScript Library', $technology->category());
    }

    /**
     * Verify that a core Lodash asset is also matched.
     */
    public function test_matches_core_asset(): void
    {
        $html = '<script src="https://cdn.example.com/js/lodash.core.min.js"></script>';

        $result = (new LodashRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
    }

    /**
     * Verify that inline underscore usage alone never matches, because
     * window._ is shared with other libraries.
     */
    public function test_inline_usage_alone_never_matches(): void
    {
        $html = '<script>_.map([1, 2, 3], function (n) { return n + 1; });</script>';

        $result = (new LodashRule())->evaluate($html, self::URL);

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

        $result = (new LodashRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }
}
