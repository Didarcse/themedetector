<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\TechnologyMetadata;

/**
 * Detects the Meta Pixel in HTML.
 *
 * MetaPixelRule recognizes the Meta (Facebook) Pixel through the
 * fbevents.js loader script (connect.facebook.net/en_US/fbevents.js) and
 * through inline fbq() tracking calls. When the loader and inline usage
 * both appear, the rule reports its highest confidence.
 *
 * Responsibilities:
 *
 * - Match the fbevents.js loader script asset.
 * - Match inline fbq() usage.
 * - Report the corroborated, asset, or inline confidence tier.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: evaluating the HTML for the Meta
 *   Pixel is the only concern. It performs no HTTP requests and no
 *   metadata mapping.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about TechnologyMetadata mapping or the
 * detection workflow that surrounds it.
 */
final readonly class MetaPixelRule extends AbstractTechnologyRule
{
    private const ASSET_PATTERN = '/connect\.facebook\.net\/[^"\']*fbevents\.js/i';

    private const INLINE_PATTERN = '/\bfbq\s*\(/i';

    private const ASSET_CONFIDENCE = 80;

    private const CORROBORATED_CONFIDENCE = 90;

    private const INLINE_CONFIDENCE = 50;

    /**
     * Evaluate the HTML for Meta Pixel evidence.
     *
     * @param string $html The complete HTML source of the target website.
     * @param string $url  The original website URL.
     *
     * @return array{
     *     matched: bool,
     *     confidence: int,
     *     metadata: array<string, mixed>
     * }
     */
    public function evaluate(string $html, string $url): array
    {
        $hasInline = preg_match(self::INLINE_PATTERN, $html) === 1;

        $assetPath = null;
        $hostname = null;

        foreach ($this->scriptSrcs($html) as $src) {
            if (preg_match(self::ASSET_PATTERN, $src) !== 1) {
                continue;
            }

            $assetPath ??= $src;
            $hostname ??= $this->hostOf($src);
        }

        if ($assetPath === null && !$hasInline) {
            return $this->noMatch();
        }

        if ($hasInline && $assetPath !== null) {
            $confidence = self::CORROBORATED_CONFIDENCE;
        } elseif ($assetPath !== null) {
            $confidence = self::ASSET_CONFIDENCE;
        } else {
            $confidence = self::INLINE_CONFIDENCE;
        }

        return [
            'matched' => true,
            'confidence' => $confidence,
            'metadata' => $this->evidence(
                signal: $assetPath !== null ? 'script-src' : 'inline-global',
                assetPath: $assetPath,
                hostname: $hostname,
                version: null,
            ),
        ];
    }

    /**
     * Return the normalized static identity of the Meta Pixel.
     *
     * @return TechnologyMetadata The Meta Pixel technology identity.
     */
    public function technology(): TechnologyMetadata
    {
        return new TechnologyMetadata(
            name: 'Meta Pixel',
            slug: 'meta-pixel',
            category: 'Analytics',
        );
    }
}
