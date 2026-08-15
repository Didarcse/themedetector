<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection;

use App\Modules\Detection\DetectionContext;
use App\Modules\TechnologyDetection\Contracts\TechnologyDetectorInterface;
use App\Modules\TechnologyDetection\Rules\TechnologyRuleInterface;

/**
 * Shared foundation for every technology category detector.
 *
 * AbstractCategoryDetector implements the common technology detection
 * flow shared by every category detector: it evaluates every registered
 * technology rule against the context HTML and URL, maps matched rule
 * evidence to normalized TechnologyMetadata, filters out technology slugs
 * owned by the CMS Detection Engine, and caps the number of reported
 * technologies.
 *
 * Responsibilities:
 *
 * - Determine whether the detector supports the given context.
 * - Evaluate every registered technology rule.
 * - Map matched evidence to normalized metadata.
 * - Filter CMS-owned technology slugs.
 * - Cap the number of reported technologies.
 *
 * Design philosophy:
 *
 * - Template Method: the shared flow lives here; concrete category
 *   detectors provide their rule set and nothing else.
 * - Single Responsibility Principle: rule evaluation, mapping, and
 *   filtering are coordinated here; each rule still owns its own signal.
 * - Open/Closed Principle: new technologies are added by registering new
 *   rules, never by modifying this class.
 * - Stateless, deterministic, and side-effect free: the same context
 *   always produces the same result list.
 *
 * Future Compatibility:
 *
 * - Future technology categories extend this class and provide their own
 *   rule sets.
 */
abstract readonly class AbstractCategoryDetector implements TechnologyDetectorInterface
{
    /**
     * The soft upper bound on the number of technologies a single
     * category detector reports for one context.
     */
    public const MAX_TECHNOLOGIES = 40;

    /**
     * Create a category detector over the supplied rule set.
     *
     * @param list<TechnologyRuleInterface> $rules           The technology
     *                                                       rules, in
     *                                                       evaluation order.
     * @param TechnologyMetadataMapper      $mapper          Maps rule
     *                                                       evidence to
     *                                                       normalized
     *                                                       metadata.
     * @param int                           $maxTechnologies The maximum
     *                                                       number of
     *                                                       technologies to
     *                                                       report.
     */
    public function __construct(
        protected array $rules,
        protected TechnologyMetadataMapper $mapper,
        protected int $maxTechnologies = self::MAX_TECHNOLOGIES,
    ) {
    }

    /**
     * Determine whether the detector supports the given detection context.
     *
     * A category detector always supports the supplied context: it
     * reports an empty result list when no technology rule matches rather
     * than declaring the context unsupported.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return bool True.
     */
    public function supports(DetectionContext $context): bool
    {
        return true;
    }

    /**
     * Detect technologies from the given detection context.
     *
     * Every registered rule is evaluated in registration order against the
     * context HTML and URL. Matched rules are mapped to normalized
     * TechnologyMetadata and reported as detected results. Results whose
     * technology slug is owned by the CMS Detection Engine are discarded,
     * and the result list is capped at the configured maximum. The given
     * DetectionContext is never modified.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return list<TechnologyDetectionResult> The detected technologies,
     *                                         in rule evaluation order.
     */
    public function detect(DetectionContext $context): array
    {
        $results = [];

        foreach ($this->rules as $rule) {
            $evaluation = $rule->evaluate($context->html(), $context->finalUrl());

            if ($evaluation['matched'] !== true) {
                continue;
            }

            $metadata = $this->mapper->map($rule, $evaluation['metadata']);

            if (in_array($metadata->slug(), TechnologyRuleInterface::EXCLUDED_CMS_SLUGS, true)) {
                continue;
            }

            $results[] = new TechnologyDetectionResult(
                detected: true,
                metadata: $metadata,
                confidence: $evaluation['confidence'],
            );

            if (count($results) >= $this->maxTechnologies) {
                break;
            }
        }

        return $results;
    }
}
