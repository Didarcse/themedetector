<?php

declare(strict_types=1);

namespace App\Modules\Detection\Drupal\Rules;

/**
 * Contract for every Drupal detection rule.
 *
 * A rule is a single, focused detection signal used to determine whether
 * a given website is built with Drupal. Each implementation inspects the
 * supplied HTML source and URL independently of other rules, keeping
 * detection modular, extensible, testable, deterministic, and easy to
 * maintain.
 *
 * Responsibilities:
 *
 * - Evaluate exactly one Drupal detection signal and report its outcome
 *   as a structured result array.
 * - Contribute its weight to the overall confidence score and attach any
 *   rule-specific evidence to the result metadata.
 * - Remain fully self-contained so rules can be added, removed, or
 *   reordered without impacting the rest of the detection pipeline.
 *
 * Design philosophy:
 *
 * - A rule must be stateless and deterministic: given the same input, it
 *   must always return the same output.
 * - A rule must perform no side effects. It must never emit output, mutate
 *   global state, persist data, or interact with external services.
 * - Each rule evaluates one detection signal independently; results are
 *   consumed by the DrupalDetector and its ConfidenceCalculator.
 * - The interface itself remains completely free of Drupal-specific
 *   implementation details. Concrete rules are free to inspect HTML, parse
 *   the DOM, interrogate asset URLs, analyse JavaScript or HTML
 *   attributes, explore API endpoints, or rely on any future detection
 *   strategy without violating the contract.
 */
interface RuleInterface
{
    /**
     * Evaluate the supplied HTML and URL for a single Drupal detection
     * signal.
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
