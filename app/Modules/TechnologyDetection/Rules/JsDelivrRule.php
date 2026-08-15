<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Rules;

use App\Modules\TechnologyDetection\TechnologyMetadata;

/**
 * Detects the jsDelivr CDN in HTML.
 *
 * JsDelivrRule recognizes jsDelivr through script and stylesheet assets
 * served from the exclusive cdn.jsdelivr.net hostname.
 *
 * Responsibilities:
 *
 * - Match script and stylesheet assets hosted on cdn.jsdelivr.net.
 * - Report the exclusive-hostname confidence tier.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: evaluating the HTML for jsDelivr
 *   evidence is the only concern. It performs no HTTP requests and no
 *   metadata mapping.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about TechnologyMetadata mapping or the
 * detection workflow that surrounds it.
 */
final readonly class JsDelivrRule extends AbstractTechnologyRule
{
    private const HOSTNAME = 'cdn.jsdelivr.net';

    private const HOSTNAME_CONFIDENCE = 50;

    /**
     * Evaluate the HTML for jsDelivr evidence.
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
            if ($this->hostOf($assetUrl) !== self::HOSTNAME) {
                continue;
            }

            $assetPath ??= $assetUrl;
            $hostname ??= self::HOSTNAME;
        }

        if ($assetPath === null) {
            return $this->noMatch();
        }

        return [
            'matched' => true,
            'confidence' => self::HOSTNAME_CONFIDENCE,
            'metadata' => $this->evidence(
                signal: 'exclusive-hostname',
                assetPath: $assetPath,
                hostname: $hostname,
                version: null,
            ),
        ];
    }

    /**
     * Return the normalized static identity of jsDelivr.
     *
     * @return TechnologyMetadata The jsDelivr technology identity.
     */
    public function technology(): TechnologyMetadata
    {
        return new TechnologyMetadata(
            name: 'jsDelivr',
            slug: 'jsdelivr',
            category: 'CDN',
        );
    }
}
