<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Analytics;

use App\Modules\TechnologyDetection\AbstractCategoryDetector;
use App\Modules\TechnologyDetection\Rules\ClarityRule;
use App\Modules\TechnologyDetection\Rules\GoogleAnalyticsRule;
use App\Modules\TechnologyDetection\Rules\GoogleTagManagerRule;
use App\Modules\TechnologyDetection\Rules\HotjarRule;
use App\Modules\TechnologyDetection\Rules\MatomoRule;
use App\Modules\TechnologyDetection\Rules\MetaPixelRule;
use App\Modules\TechnologyDetection\Rules\PlausibleRule;
use App\Modules\TechnologyDetection\TechnologyMetadataMapper;

/**
 * Detects analytics platforms in HTML.
 *
 * AnalyticsDetector is the Analytics category detector of the Technology
 * Detection Engine. It evaluates the fixed rule set of analytics rules
 * and reports every platform it identifies, in rule registration order.
 *
 * Responsibilities:
 *
 * - Evaluate every registered analytics rule.
 * - Report the detected platforms as normalized technology results.
 *
 * Design philosophy:
 *
 * - Facade: it exposes the analytics rule set through the shared category
 *   detection flow.
 * - Single Responsibility Principle: it provides the rule set; the shared
 *   flow owns rule evaluation and mapping.
 * - Stateless, deterministic, and side-effect free.
 *
 * Future Compatibility:
 *
 * - New analytics rules are added here without modifying the shared
 *   detection flow.
 */
final readonly class AnalyticsDetector extends AbstractCategoryDetector
{
    /**
     * Create the analytics detector.
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
                new GoogleAnalyticsRule(),
                new GoogleTagManagerRule(),
                new MetaPixelRule(),
                new PlausibleRule(),
                new MatomoRule(),
                new HotjarRule(),
                new ClarityRule(),
            ],
            mapper: $mapper,
            maxTechnologies: $maxTechnologies,
        );
    }
}
