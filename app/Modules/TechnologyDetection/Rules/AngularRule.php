<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\TechnologyMetadata;

/**
 * Detects the Angular (AngularJS) JavaScript framework in HTML.
 *
 * AngularRule recognizes Angular through external script assets whose
 * basename is a classic Angular build (angular.min.js,
 * angular-1.8.2.min.js) and through inline Angular usage
 * (angular.module, angular.bootstrap). When an asset and inline usage
 * both appear, the rule reports its highest confidence.
 *
 * Responsibilities:
 *
 * - Match Angular script assets by basename.
 * - Match inline Angular usage.
 * - Extract the Angular version when it is embedded in the asset path.
 * - Report the corroborated, asset, or inline confidence tier.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: evaluating the HTML for Angular is
 *   the only concern. It performs no HTTP requests and no metadata
 *   mapping.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about TechnologyMetadata mapping or the
 * detection workflow that surrounds it.
 */
final readonly class AngularRule extends AbstractTechnologyRule
{
    private const ASSET_PATTERN = '/^angular(?:-\d+(?:\.\d+){1,2})?(?:\.min)?\.js$/i';

    private const VERSION_PATTERN = '/(?:angular(?:\.js)?[-@\/])(\d+(?:\.\d+){1,2})/i';

    private const INLINE_PATTERN = '/(?:window\s*\.\s*)?angular\s*\.\s*(?:module|bootstrap)\s*\(/i';

    private const ASSET_CONFIDENCE = 80;

    private const CORROBORATED_CONFIDENCE = 90;

    private const INLINE_CONFIDENCE = 50;

    /**
     * Evaluate the HTML for Angular evidence.
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
            if (preg_match(self::ASSET_PATTERN, $this->basenameOf($src)) !== 1) {
                continue;
            }

            $assetPath ??= $src;
            $hostname ??= $this->hostOf($src);

            if ($version === null && preg_match(self::VERSION_PATTERN, $src, $matches) === 1) {
                $version = $matches[1];
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
     * Return the normalized static identity of Angular.
     *
     * @return TechnologyMetadata The Angular technology identity.
     */
    public function technology(): TechnologyMetadata
    {
        return new TechnologyMetadata(
            name: 'Angular',
            slug: 'angular',
            category: 'JavaScript Library',
        );
    }
}
