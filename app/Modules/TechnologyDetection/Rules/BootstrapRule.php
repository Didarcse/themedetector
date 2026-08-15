<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\TechnologyMetadata;

/**
 * Detects the Bootstrap CSS/JavaScript framework in HTML.
 *
 * BootstrapRule recognizes Bootstrap through external script and
 * stylesheet assets whose basename is a Bootstrap build
 * (bootstrap.min.js, bootstrap.bundle.min.js, bootstrap.min.css) and
 * through inline Bootstrap usage (bootstrap.Modal, bootstrap.Toast).
 * When an asset and inline usage both appear, the rule reports its
 * highest confidence.
 *
 * Responsibilities:
 *
 * - Match Bootstrap script and stylesheet assets by basename.
 * - Match inline Bootstrap usage.
 * - Extract the Bootstrap version when it is embedded in the asset path.
 * - Report the corroborated, asset, or inline confidence tier.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: evaluating the HTML for Bootstrap is
 *   the only concern. It performs no HTTP requests and no metadata
 *   mapping.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about TechnologyMetadata mapping or the
 * detection workflow that surrounds it.
 */
final readonly class BootstrapRule extends AbstractTechnologyRule
{
    private const ASSET_PATTERN = '/^bootstrap(?:-\d+(?:\.\d+){1,2})?'
        . '(?:\.(?:bundle|grid|reboot|utilities|rtl))?(?:\.min)?\.(?:js|css)$/i';

    private const VERSION_PATTERN = '/(?:bootstrap[-@\/])(\d+(?:\.\d+){1,2})/i';

    private const INLINE_PATTERN = '/(?:window\s*\.\s*)?bootstrap\s*\.\s*'
        . '(?:Modal|Tab|Dropdown|Tooltip|Popover|Toast|Carousel|Collapse|Offcanvas|ScrollSpy|Alert)\b/i';

    private const ASSET_CONFIDENCE = 80;

    private const CORROBORATED_CONFIDENCE = 90;

    private const INLINE_CONFIDENCE = 50;

    /**
     * Evaluate the HTML for Bootstrap evidence.
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
     * Return the normalized static identity of Bootstrap.
     *
     * @return TechnologyMetadata The Bootstrap technology identity.
     */
    public function technology(): TechnologyMetadata
    {
        return new TechnologyMetadata(
            name: 'Bootstrap',
            slug: 'bootstrap',
            category: 'JavaScript Library',
        );
    }
}
