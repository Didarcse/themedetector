<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\TechnologyMetadata;

/**
 * Detects the Cloudflare CDN in HTML.
 *
 * CloudflareCdnRule recognizes Cloudflare through asset URLs that carry
 * the reserved /cdn-cgi/ path, which Cloudflare serves on the site's own
 * domain for scripts, stylesheets, and other proxied resources.
 *
 * Responsibilities:
 *
 * - Match asset URLs that contain the /cdn-cgi/ reserved path.
 * - Report the reserved-path confidence tier.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: evaluating the HTML for Cloudflare
 *   evidence is the only concern. It performs no HTTP requests and no
 *   metadata mapping.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about TechnologyMetadata mapping or the
 * detection workflow that surrounds it.
 */
final readonly class CloudflareCdnRule extends AbstractTechnologyRule
{
    private const CDN_CGI_PATTERN = '/(?:src|href)\s*=\s*["\']([^"\']*\/cdn-cgi\/[^"\']*)["\']/i';

    private const RESERVED_PATH_CONFIDENCE = 70;

    /**
     * Evaluate the HTML for Cloudflare evidence.
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
        if (preg_match(self::CDN_CGI_PATTERN, $html, $matches) !== 1) {
            return $this->noMatch();
        }

        $assetPath = $matches[1];

        return [
            'matched' => true,
            'confidence' => self::RESERVED_PATH_CONFIDENCE,
            'metadata' => $this->evidence(
                signal: 'cdn-cgi-path',
                assetPath: $assetPath,
                hostname: $this->hostOf($assetPath),
                version: null,
            ),
        ];
    }

    /**
     * Return the normalized static identity of Cloudflare.
     *
     * @return TechnologyMetadata The Cloudflare technology identity.
     */
    public function technology(): TechnologyMetadata
    {
        return new TechnologyMetadata(
            name: 'Cloudflare',
            slug: 'cloudflare',
            category: 'CDN',
        );
    }
}
