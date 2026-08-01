<?php

declare(strict_types=1);

namespace App\Modules\Detection\Squarespace\Rules;

/**
 * Contract for every Squarespace detection rule.
 *
 * A rule is a single, focused detection signal used to determine whether
 * a given website is built with Squarespace. Each implementation
 * inspects the supplied HTML source and URL independently of other rules,
 * keeping detection modular, testable, and composable.
 *
 * Responsibilities:
 *
 * - Evaluate one detection signal and report its outcome as a structured
 *   result array.
 * - Contribute its weight to the overall confidence score and attach any
 *   rule-specific evidence to the result metadata.
 *
 * Design philosophy:
 *
 * - A rule must be stateless and deterministic: given the same input, it
 *   must always return the same output.
 * - A rule must perform no side effects. It must never emit output, mutate
 *   global state, persist data, or interact with external services.
 * - Each rule evaluates one detection signal independently; results are
 *   consumed by the SquarespaceDetector and its ConfidenceCalculator.
 * - The interface itself remains completely free of Squarespace-specific
 *   implementation details. Concrete rules are free to parse markup,
 *   interrogate asset URLs, or rely on any other strategy without
 *   violating the contract.
 */
interface RuleInterface
{
    /**
     * Evaluate the supplied HTML and URL for a single Squarespace
     * detection signal.
     *
     * Every invocation must return a fully-formed result array, regardless
     * of whether a signal was found. The `matched` flag indicates presence
     * of the signal, `weight` contributes to the overall confidence score,
     * and `metadata` carries optional, rule-specific evidence for further
     * analysis or reporting.
     *
     * @param string $html The complete HTML source of the target website.
     * @param string $url  The original website URL.
     *
     * @return array{
     *     matched: bool,
     *     weight: int,
     *     metadata: array<string, mixed>
     * } The structured result of the evaluation.
     */
    public function evaluate(string $html, string $url): array;
}
