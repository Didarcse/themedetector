<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Rules;

use App\Modules\Detection\Contracts\RuleInterface;
use App\Modules\TechnologyDetection\TechnologyMetadata;

/**
 * Contract for every Technology Detection rule.
 *
 * A TechnologyRuleInterface implementation inspects the provided HTML
 * source and URL for a single technology signal (a JavaScript library,
 * a CDN, an analytics platform, and so on) and returns structured
 * evidence that can be consumed by a category detector and mapped to a
 * normalized TechnologyMetadata value.
 *
 * Responsibilities:
 *
 * - Extend the shared RuleInterface evaluation contract unchanged.
 * - Expose the normalized static identity of the technology the rule
 *   detects through technology().
 *
 * Design philosophy:
 *
 * - Contract: consumers depend on this abstraction rather than on a
 *   concrete rule.
 * - Single Responsibility Principle: a rule evaluates one technology
 *   signal only. It performs no HTTP requests, no metadata mapping, and
 *   no workflow orchestration.
 * - Stateless, deterministic, and side-effect free: given the same HTML
 *   and URL, it always returns the same result.
 *
 * Future Compatibility:
 *
 * - Every future technology rule — additional JavaScript libraries,
 *   CDNs, analytics platforms, and future technology categories — must
 *   implement this contract.
 */
interface TechnologyRuleInterface extends RuleInterface
{
    /**
     * Technology slugs that are owned by the CMS Detection Engine.
     *
     * The CMS module is responsible for detecting platforms (WordPress,
     * Shopify, Joomla, Drupal, Ghost, TYPO3, Webflow, Wix, and
     * Squarespace). Category detectors filter results that carry one of
     * these slugs so that platform detections never leak into the
     * technology list through a future rule.
     *
     * @var list<string>
     */
    public const EXCLUDED_CMS_SLUGS = [
        'wordpress',
        'shopify',
        'joomla',
        'drupal',
        'ghost',
        'typo3',
        'webflow',
        'wix',
        'squarespace',
    ];

    /**
     * Return the normalized static identity of the technology this rule
     * detects.
     *
     * The returned metadata carries the stable name, slug, and category
     * of the technology. It never carries runtime evidence such as a
     * version or an asset path; those are returned by evaluate() and
     * promoted by the metadata mapper.
     *
     * @return TechnologyMetadata The static technology identity.
     */
    public function technology(): TechnologyMetadata;
}
