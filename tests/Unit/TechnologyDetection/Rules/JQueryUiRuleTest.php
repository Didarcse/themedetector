<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\Rules\JQueryUiRule;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the JQueryUiRule.
 *
 * Verifies the complete evaluation contract: jQuery UI script and
 * stylesheet assets are recognized with the version extracted from the
 * asset path, inline usage corroborates an asset match to the highest
 * confidence tier, inline-only usage scores the inline tier, and
 * unrelated HTML never matches.
 */
final class JQueryUiRuleTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that a jQuery UI script asset is matched with its version,
     * identity, and evidence metadata.
     */
    public function test_matches_script_asset_with_version_and_identity(): void
    {
        $html = '<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>';

        $result = (new JQueryUiRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
        self::assertSame('script-src', $result['metadata']['signal']);
        self::assertSame('cdnjs.cloudflare.com', $result['metadata']['hostname']);
        self::assertSame('1.13.2', $result['metadata']['version']);

        $technology = (new JQueryUiRule())->technology();
        self::assertSame('jQuery UI', $technology->name());
        self::assertSame('jquery-ui', $technology->slug());
        self::assertSame('JavaScript Library', $technology->category());
    }

    /**
     * Verify that a jQuery UI stylesheet asset is also matched.
     */
    public function test_matches_stylesheet_asset(): void
    {
        $html = '<link rel="stylesheet" href="https://cdn.example.com/css/jquery-ui.min.css">';

        $result = (new JQueryUiRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(80, $result['confidence']);
    }

    /**
     * Verify that an asset match corroborated by inline usage scores the
     * highest confidence tier.
     */
    public function test_asset_and_inline_usage_raise_confidence(): void
    {
        $html = '<script src="https://cdn.example.com/jquery-ui.min.js"></script>'
            . '<script>$(function () { $.ui.datepicker(); });</script>';

        $result = (new JQueryUiRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(90, $result['confidence']);
    }

    /**
     * Verify that inline-only usage scores the inline confidence tier.
     */
    public function test_inline_only_scores_inline_confidence(): void
    {
        $html = '<script>$.ui.dialog({ modal: true });</script>';

        $result = (new JQueryUiRule())->evaluate($html, self::URL);

        self::assertTrue($result['matched']);
        self::assertSame(50, $result['confidence']);
        self::assertSame('inline-global', $result['metadata']['signal']);
    }

    /**
     * Verify that a plain jQuery asset never matches the jQuery UI rule.
     */
    public function test_plain_jquery_asset_does_not_match(): void
    {
        $html = '<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>';

        $result = (new JQueryUiRule())->evaluate($html, self::URL);

        self::assertFalse($result['matched']);
        self::assertSame(0, $result['confidence']);
    }
}
