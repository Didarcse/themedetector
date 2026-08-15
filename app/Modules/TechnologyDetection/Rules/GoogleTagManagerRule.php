<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\TechnologyMetadata;

/**
 * Detects Google Tag Manager in HTML.
 *
 * GoogleTagManagerRule recognizes Google Tag Manager through the
 * googletagmanager.com/gtm.js loader script and through the distinctive
 * gtm.start marker that the GTM container snippet embeds inline. When
 * the loader and inline usage both appear, the rule reports its highest
 * confidence.
 *
 * Responsibilities:
 *
 * - Match the gtm.js loader script asset.
 * - Match the inline gtm.start container marker.
 * - Report the corroborated, asset, or inline confidence tier.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: evaluating the HTML for Google Tag
 *   Manager is the only concern. It performs no HTTP requests and no
 *   metadata mapping.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about TechnologyMetadata mapping or the
 * detection workflow that surrounds it.
 */
final readonly class GoogleTagManagerRule extends AbstractTechnologyRule
{
    private const ASSET_PATTERN = '/googletagmanager\.com\/gtm\.js/i';

    private const INLINE_PATTERN = '/\bgtm\.start\b/i';

    private const ASSET_CONFIDENCE = 80;

    private const CORROBORATED_CONFIDENCE = 90;

    private const INLINE_CONFIDENCE = 50;

    /**
     * Evaluate the HTML for Google Tag Manager evidence.
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
     * Return the normalized static identity of Google Tag Manager.
     *
     * @return TechnologyMetadata The Google Tag Manager technology
     *                            identity.
     */
    public function technology(): TechnologyMetadata
    {
        return new TechnologyMetadata(
            name: 'Google Tag Manager',
            slug: 'google-tag-manager',
            category: 'Analytics',
        );
    }
}
