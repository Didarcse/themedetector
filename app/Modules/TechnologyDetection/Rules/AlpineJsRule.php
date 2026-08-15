<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\TechnologyMetadata;

/**
 * Detects the Alpine.js JavaScript framework in HTML.
 *
 * AlpineJsRule recognizes Alpine.js through external script assets whose
 * basename is an Alpine build (alpine.min.js, alpinejs.min.js) or whose
 * path carries a versioned Alpine package (alpinejs@3.13.5), and through
 * inline Alpine usage (x-data attributes, Alpine.start). When an asset
 * and inline usage both appear, the rule reports its highest confidence.
 *
 * Responsibilities:
 *
 * - Match Alpine.js script assets by basename or versioned package path.
 * - Match inline Alpine.js usage.
 * - Extract the Alpine.js version when it is embedded in the asset path.
 * - Report the corroborated, asset, or inline confidence tier.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: evaluating the HTML for Alpine.js is
 *   the only concern. It performs no HTTP requests and no metadata
 *   mapping.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about TechnologyMetadata mapping or the
 * detection workflow that surrounds it.
 */
final readonly class AlpineJsRule extends AbstractTechnologyRule
{
    private const ASSET_PATTERN = '/^alpine(?:js)?(?:\.min)?\.js$/i';

    private const VERSIONED_ASSET_PATTERN = '/(?:^|\/)alpinejs?@(\d+(?:\.\d+){1,2})/i';

    private const INLINE_PATTERN = '/\bx-data\s*=|(?:window\s*\.\s*)?Alpine\s*\.\s*start\s*\(/i';

    private const ASSET_CONFIDENCE = 80;

    private const CORROBORATED_CONFIDENCE = 90;

    private const INLINE_CONFIDENCE = 50;

    /**
     * Evaluate the HTML for Alpine.js evidence.
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
        $version = null;

        foreach ($this->scriptSrcs($html) as $src) {
            $versionMatch = [];

            $isAsset = preg_match(self::ASSET_PATTERN, $this->basenameOf($src)) === 1
                || preg_match(self::VERSIONED_ASSET_PATTERN, $src, $versionMatch) === 1;

            if (!$isAsset) {
                continue;
            }

            $assetPath ??= $src;
            $hostname ??= $this->hostOf($src);

            if ($version === null && isset($versionMatch[1])) {
                $version = $versionMatch[1];
            }
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
                version: $version,
            ),
        ];
    }

    /**
     * Return the normalized static identity of Alpine.js.
     *
     * @return TechnologyMetadata The Alpine.js technology identity.
     */
    public function technology(): TechnologyMetadata
    {
        return new TechnologyMetadata(
            name: 'Alpine.js',
            slug: 'alpine-js',
            category: 'JavaScript Library',
        );
    }
}
