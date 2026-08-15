<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\TechnologyMetadata;

/**
 * Detects the jQuery UI JavaScript library in HTML.
 *
 * JQueryUiRule recognizes jQuery UI through external script and
 * stylesheet assets whose basename is a jQuery UI build
 * (jquery-ui.min.js, jquery-ui-1.13.2.min.css) and through inline
 * jQuery UI usage ($.ui, jQuery.ui). When an asset and inline usage both
 * appear, the rule reports its highest confidence.
 *
 * Responsibilities:
 *
 * - Match jQuery UI script and stylesheet assets by basename.
 * - Match inline jQuery UI usage.
 * - Extract the jQuery UI version when it is embedded in the asset path.
 * - Report the corroborated, asset, or inline confidence tier.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: evaluating the HTML for jQuery UI is
 *   the only concern. It performs no HTTP requests and no metadata
 *   mapping.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about TechnologyMetadata mapping or the
 * detection workflow that surrounds it.
 */
final readonly class JQueryUiRule extends AbstractTechnologyRule
{
    private const ASSET_PATTERN = '/^jquery-ui(?:-\d+(?:\.\d+){1,2})?(?:\.min)?\.(?:js|css)$/i';

    private const VERSION_PATTERN = '/(?:jquery-ui[-@\/]|jqueryui\/)(\d+(?:\.\d+){1,2})/i';

    private const INLINE_PATTERN = '/(?:window\s*\.\s*)?(?:\$|jQuery)\s*\.\s*ui\b/i';

    private const ASSET_CONFIDENCE = 80;

    private const CORROBORATED_CONFIDENCE = 90;

    private const INLINE_CONFIDENCE = 50;

    /**
     * Evaluate the HTML for jQuery UI evidence.
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

        foreach (array_merge($this->scriptSrcs($html), $this->stylesheetHrefs($html)) as $assetUrl) {
            if (preg_match(self::ASSET_PATTERN, $this->basenameOf($assetUrl)) !== 1) {
                continue;
            }

            $assetPath ??= $assetUrl;
            $hostname ??= $this->hostOf($assetUrl);

            if ($version === null && preg_match(self::VERSION_PATTERN, $assetUrl, $matches) === 1) {
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
     * Return the normalized static identity of jQuery UI.
     *
     * @return TechnologyMetadata The jQuery UI technology identity.
     */
    public function technology(): TechnologyMetadata
    {
        return new TechnologyMetadata(
            name: 'jQuery UI',
            slug: 'jquery-ui',
            category: 'JavaScript Library',
        );
    }
}
