<?php

declare(strict_types=1);

namespace App\Modules\Detection\WordPress\Rules;

/**
 * Contract for every WordPress detection rule.
 *
 * Each rule inspects the provided HTML source and URL,
 * then returns structured evidence that can be consumed
 * by WordPressDetector and ConfidenceCalculator.
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
