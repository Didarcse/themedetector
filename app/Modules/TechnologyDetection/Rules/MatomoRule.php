<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\TechnologyMetadata;

/**
 * Detects Matomo Analytics in HTML.
 *
 * MatomoRule recognizes Matomo through script assets that load the
 * tracker (matomo.js, or the legacy piwik.js) and through inline tracker
 * usage (_paq.push, window._paq). When a tracker asset and inline usage
 * both appear, the rule reports its highest confidence.
 *
 * Responsibilities:
 *
 * - Match Matomo tracker script assets.
 * - Match inline _paq tracker usage.
 * - Report the corroborated, asset, or inline confidence tier.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: evaluating the HTML for Matomo is
 *   the only concern. It performs no HTTP requests and no metadata
 *   mapping.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about TechnologyMetadata mapping or the
 * detection workflow that surrounds it.
 */
final readonly class MatomoRule extends AbstractTechnologyRule
{
    private const ASSET_PATTERN = '/\b(?:matomo|piwik)\.js/i';

    private const INLINE_PATTERN = '/\b_paq\s*\.\s*push\s*\(|window\s*\.\s*_paq\b/i';

    private const ASSET_CONFIDENCE = 80;

    private const CORROBORATED_CONFIDENCE = 90;

    private const INLINE_CONFIDENCE = 50;

    /**
     * Evaluate the HTML for Matomo evidence.
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
     * Return the normalized static identity of Matomo.
     *
     * @return TechnologyMetadata The Matomo technology identity.
     */
    public function technology(): TechnologyMetadata
    {
        return new TechnologyMetadata(
            name: 'Matomo',
            slug: 'matomo',
            category: 'Analytics',
        );
    }
}
