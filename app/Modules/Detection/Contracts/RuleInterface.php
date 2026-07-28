<?php

declare(strict_types=1);

namespace App\Modules\Detection\Contracts;

/**
 * Shared contract for all CMS detection rules.
 *
 * Every rule (WordPress, Shopify, Webflow, Wix, Joomla, Drupal, etc.)
 * inspects the provided HTML source and URL, then returns structured
 * evidence that can be consumed by the corresponding Detector and
 * ConfidenceCalculator.
 */
interface RuleInterface
{
    /**
     * Evaluate the HTML and/or URL for a specific detection signal.
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
    public function evaluate(string $html, string $url): array;
}
