<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\JavaScriptLibrary;

use App\Modules\TechnologyDetection\AbstractCategoryDetector;
use App\Modules\TechnologyDetection\Rules\AlpineJsRule;
use App\Modules\TechnologyDetection\Rules\AngularRule;
use App\Modules\TechnologyDetection\Rules\BootstrapRule;
use App\Modules\TechnologyDetection\Rules\JQueryRule;
use App\Modules\TechnologyDetection\Rules\JQueryUiRule;
use App\Modules\TechnologyDetection\Rules\LodashRule;
use App\Modules\TechnologyDetection\Rules\ReactRule;
use App\Modules\TechnologyDetection\Rules\VueRule;
use App\Modules\TechnologyDetection\TechnologyMetadataMapper;

/**
 * Detects JavaScript libraries in HTML.
 *
 * JavaScriptLibraryDetector is the JavaScript Library category detector
 * of the Technology Detection Engine. It evaluates the fixed rule set of
 * JavaScript library rules and reports every library it identifies, in
 * rule registration order.
 *
 * Responsibilities:
 *
 * - Evaluate every registered JavaScript library rule.
 * - Report the detected libraries as normalized technology results.
 *
 * Design philosophy:
 *
 * - Facade: it exposes the JavaScript library rule set through the shared
 *   category detection flow.
 * - Single Responsibility Principle: it provides the rule set; the shared
 *   flow owns rule evaluation and mapping.
 * - Stateless, deterministic, and side-effect free.
 *
 * Future Compatibility:
 *
 * - New JavaScript library rules are added here without modifying the
 *   shared detection flow.
 */
final readonly class JavaScriptLibraryDetector extends AbstractCategoryDetector
{
    /**
     * Create the JavaScript library detector.
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
                new JQueryRule(),
                new JQueryUiRule(),
                new ReactRule(),
                new VueRule(),
                new AngularRule(),
                new BootstrapRule(),
                new AlpineJsRule(),
                new LodashRule(),
            ],
            mapper: $mapper,
            maxTechnologies: $maxTechnologies,
        );
    }
}
