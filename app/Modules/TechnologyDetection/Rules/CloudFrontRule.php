<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\TechnologyMetadata;

/**
 * Detects the Amazon CloudFront CDN in HTML.
 *
 * CloudFrontRule recognizes CloudFront through script and stylesheet
 * assets served from a *.cloudfront.net hostname. Because CloudFront
 * distribution subdomains are randomly generated and shared across many
 * tenants, this evidence carries the lowest CDN confidence tier.
 *
 * Responsibilities:
 *
 * - Match script and stylesheet assets hosted on *.cloudfront.net.
 * - Report the multi-tenant-hostname confidence tier.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: evaluating the HTML for CloudFront
 *   evidence is the only concern. It performs no HTTP requests and no
 *   metadata mapping.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about TechnologyMetadata mapping or the
 * detection workflow that surrounds it.
 */
final readonly class CloudFrontRule extends AbstractTechnologyRule
{
    private const HOSTNAME_PATTERN = '/\.cloudfront\.net$/';

    private const MULTI_TENANT_HOSTNAME_CONFIDENCE = 45;

    /**
     * Evaluate the HTML for CloudFront evidence.
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

        foreach (array_merge($this->scriptSrcs($html), $this->stylesheetHrefs($html)) as $assetUrl) {
            $host = $this->hostOf($assetUrl);

            if ($host === null || preg_match(self::HOSTNAME_PATTERN, $host) !== 1) {
                continue;
            }

            $assetPath ??= $assetUrl;
            $hostname ??= $host;
        }

        if ($assetPath === null) {
            return $this->noMatch();
        }

        return [
            'matched' => true,
            'confidence' => self::MULTI_TENANT_HOSTNAME_CONFIDENCE,
            'metadata' => $this->evidence(
                signal: 'multi-tenant-hostname',
                assetPath: $assetPath,
                hostname: $hostname,
                version: null,
            ),
        ];
    }

    /**
     * Return the normalized static identity of CloudFront.
     *
     * @return TechnologyMetadata The CloudFront technology identity.
     */
    public function technology(): TechnologyMetadata
    {
        return new TechnologyMetadata(
            name: 'CloudFront',
            slug: 'cloudfront',
            category: 'CDN',
        );
    }
}
