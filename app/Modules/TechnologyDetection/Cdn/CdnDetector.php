<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Cdn;

use App\Modules\TechnologyDetection\AbstractCategoryDetector;
use App\Modules\TechnologyDetection\Rules\CloudFrontRule;
use App\Modules\TechnologyDetection\Rules\CloudflareCdnRule;
use App\Modules\TechnologyDetection\Rules\JsDelivrRule;
use App\Modules\TechnologyDetection\Rules\UnpkgRule;
use App\Modules\TechnologyDetection\TechnologyMetadataMapper;

/**
 * Detects content delivery networks in HTML.
 *
 * CdnDetector is the CDN category detector of the Technology Detection
 * Engine. It evaluates the fixed rule set of CDN rules and reports every
 * CDN it identifies, in rule registration order.
 *
 * Responsibilities:
 *
 * - Evaluate every registered CDN rule.
 * - Report the detected CDNs as normalized technology results.
 *
 * Design philosophy:
 *
 * - Facade: it exposes the CDN rule set through the shared category
 *   detection flow.
 * - Single Responsibility Principle: it provides the rule set; the shared
 *   flow owns rule evaluation and mapping.
 * - Stateless, deterministic, and side-effect free.
 *
 * Future Compatibility:
 *
 * - New CDN rules are added here without modifying the shared detection
 *   flow.
 */
final readonly class CdnDetector extends AbstractCategoryDetector
{
    /**
     * Create the CDN detector.
     *
     * @param TechnologyMetadataMapper $mapper          Maps rule evidence
     *                                                  to normalized
     *                                                  metadata.
     * @param int                      $maxTechnologies The maximum number
     *                                                  of technologies to
     *                                                  report.
     */
    public function __construct(
        TechnologyMetadataMapper $mapper,
        int $maxTechnologies = self::MAX_TECHNOLOGIES,
    ) {
        parent::__construct(
            rules: [
                new CloudflareCdnRule(),
                new JsDelivrRule(),
                new UnpkgRule(),
                new CloudFrontRule(),
            ],
            mapper: $mapper,
            maxTechnologies: $maxTechnologies,
        );
    }
}
