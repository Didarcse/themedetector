<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\TechnologyMetadata;

/**
 * Detects Hotjar in HTML.
 *
 * HotjarRule recognizes Hotjar through script assets served from the
 * exclusive static.hotjar.com hostname (with the /hotjar- asset path
 * treated as the strong asset tier) and through inline _hjSettings
 * usage. When a strong asset and inline usage both appear, the rule
 * reports its highest confidence.
 *
 * Responsibilities:
 *
 * - Match Hotjar script assets by hostname and /hotjar- asset path.
 * - Match inline _hjSettings usage.
 * - Report the corroborated, asset, hostname, or inline confidence tier.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: evaluating the HTML for Hotjar is
 *   the only concern. It performs no HTTP requests and no metadata
 *   mapping.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about TechnologyMetadata mapping or the
 * detection workflow that surrounds it.
 */
final readonly class HotjarRule extends AbstractTechnologyRule
{
    private const HOSTNAME = 'static.hotjar.com';

    private const STRONG_ASSET_PATTERN = '/hotjar-/i';

    private const INLINE_PATTERN = '/(?:window\s*\.\s*)?_hjSettings\b/i';

    private const ASSET_CONFIDENCE = 80;

    private const CORROBORATED_CONFIDENCE = 90;

    private const HOSTNAME_OR_INLINE_CONFIDENCE = 50;

    /**
     * Evaluate the HTML for Hotjar evidence.
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
        $assetIsStrong = false;

        foreach ($this->scriptSrcs($html) as $src) {
            if ($this->hostOf($src) !== self::HOSTNAME) {
                continue;
            }

            $assetPath ??= $src;
            $hostname ??= self::HOSTNAME;

            if (!$assetIsStrong && preg_match(self::STRONG_ASSET_PATTERN, $src) === 1) {
                $assetIsStrong = true;
            }
        }

        if ($assetPath === null && !$hasInline) {
            return $this->noMatch();
        }

        if ($assetIsStrong && $hasInline) {
            $confidence = self::CORROBORATED_CONFIDENCE;
        } elseif ($assetIsStrong) {
            $confidence = self::ASSET_CONFIDENCE;
        } else {
            $confidence = self::HOSTNAME_OR_INLINE_CONFIDENCE;
        }

        return [
            'matched' => true,
            'confidence' => $confidence,
            'metadata' => $this->evidence(
                signal: $assetIsStrong
                    ? 'script-src'
                    : ($hasInline ? 'inline-global' : 'exclusive-hostname'),
                assetPath: $assetPath,
                hostname: $hostname,
                version: null,
            ),
        ];
    }

    /**
     * Return the normalized static identity of Hotjar.
     *
     * @return TechnologyMetadata The Hotjar technology identity.
     */
    public function technology(): TechnologyMetadata
    {
        return new TechnologyMetadata(
            name: 'Hotjar',
            slug: 'hotjar',
            category: 'Analytics',
        );
    }
}
