<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\PlausibleRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the PlausibleRule.
 *
 * Verifies the complete evaluation contract: a /js/ asset on the
 * exclusive plausible.io hostname is the strong asset tier, inline
 * usage corroborates an asset match to the highest confidence tier,
 * and hostname-only or inline-only evidence scores the lower tier.
 */
final class PlausibleRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that the /js/ asset on plausible.io is matched with its
     * identity and evidence metadata.
     */
    public function test_matches_js_asset_with_identity(): void
    {
        $html = '<script defer data-domain="example.com" src="https://plausible.io/js/script.js"></script>';

        $result = (new PlausibleRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
        self::assertSame('script-src', $result['metadata']['signal']);
        self::assertSame('plausible.io', $result['metadata']['hostname']);

        $technology = (new PlausibleRule())->technology();
        self::assertSame('Plausible', $technology->name());
        self::assertSame('plausible', $technology->slug());
        self::assertSame('Analytics', $technology->category());
    }

    /**
     * Verify that an asset match corroborated by inline usage scores the
     * highest confidence tier.
     */
    public function test_asset_and_inline_usage_raise_confidence(): void
    {
        $html = '<script defer data-domain="example.com" src="https://plausible.io/js/script.js"></script>'
            . '<script>plausible(\'pageview\', { url: \'/custom\' });</script>';

        $result = (new PlausibleRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(90, $result['confidence']);
    }

    /**
     * Verify that a non-/js/ asset on plausible.io scores the
     * exclusive-hostname tier.
     */
    public function test_hostname_only_scores_hostname_confidence(): void
    {
        $html = '<script src="https://plausible.io/custom.js"></script>';

        $result = (new PlausibleRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(50, $result['confidence']);
        self::assertSame('exclusive-hostname', $result['metadata']['signal']);
    }

    /**
     * Verify that inline-only usage scores the inline confidence tier.
     */
    public function test_inline_only_scores_inline_confidence(): void
    {
        $html = '<script>plausible(\'pageview\');</script>';

        $result = (new PlausibleRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(50, $result['confidence']);
        self::assertSame('inline-global', $result['metadata']['signal']);
    }

    /**
     * Verify that a double-quoted inline call still matches.
     */
    public function test_inline_double_quoted_signal_matches(): void
    {
        $html = '<script>plausible("pageview");</script>';

        $result = (new PlausibleRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(50, $result['confidence']);
        self::assertSame('inline-global', $result['metadata']['signal']);
    }

    /**
     * Verify that ordinary English prose never triggers a match.
     */
    public function test_english_prose_does_not_match(): void
    {
        $html = '<html><body><p>This approach seems plausible (in theory) but risky.</p></body></html>';

        $result = (new PlausibleRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }

    /**
     * Verify that comments and JSON blobs mentioning the identifier do
     * not trigger a match.
     */
    public function test_comments_and_json_mentions_do_not_match(): void
    {
        $html = '<html><head><script type="application/ld+json">{"note":"this looks plausible (maybe)"}</script></head>'
            . '<body><!-- plausible (foo) --><p>hi</p></body></html>';

        $result = (new PlausibleRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }

    /**
     * Verify that unrelated HTML never matches.
     */
    public function test_no_match_returns_failed_result(): void
    {
        $html = '<script src="https://cdn.example.com/js/script.js"></script>';

        $result = (new PlausibleRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
        self::assertSame([], $result['metadata']);
    }
}
