<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\TechnologyMetadata;

/**
 * Detects the Lodash JavaScript library in HTML.
 *
 * LodashRule recognizes Lodash through external script assets whose
 * basename is a Lodash build (lodash.min.js, lodash.js,
 * lodash.core.min.js). Lodash exposes no distinct inline global (its
 * only global, window._, is shared with jQuery and other libraries), so
 * inline usage is intentionally not used as evidence.
 *
 * Responsibilities:
 *
 * - Match Lodash script assets by basename.
 * - Extract the Lodash version when it is embedded in the asset path.
 * - Report the asset confidence tier.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: evaluating the HTML for Lodash is
 *   the only concern. It performs no HTTP requests and no metadata
 *   mapping.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about TechnologyMetadata mapping or the
 * detection workflow that surrounds it.
 */
final readonly class LodashRule extends AbstractTechnologyRule
{
    private const ASSET_PATTERN = '/^lodash(?:\.core)?(?:\.min)?\.js$/i';

    private const VERSION_PATTERN = '/(?:lodash[-@\/])(\d+(?:\.\d+){1,2})/i';

    private const ASSET_CONFIDENCE = 80;

    /**
     * Evaluate the HTML for Lodash evidence.
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

        if ($assetPath === null) {
            return $this->noMatch();
        }

        return [
            'matched' => true,
            'confidence' => self::ASSET_CONFIDENCE,
            'metadata' => $this->evidence(
                signal: 'script-src',
                assetPath: $assetPath,
                hostname: $hostname,
                version: $version,
            ),
        ];
    }

    /**
     * Return the normalized static identity of Lodash.
     *
     * @return TechnologyMetadata The Lodash technology identity.
     */
    public function technology(): TechnologyMetadata
    {
        return new TechnologyMetadata(
            name: 'Lodash',
            slug: 'lodash',
            category: 'JavaScript Library',
        );
    }
}
