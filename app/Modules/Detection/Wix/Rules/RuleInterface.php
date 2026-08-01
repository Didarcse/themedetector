<?php

declare(strict_types=1);

namespace App\Modules\Detection\Wix\Rules;

/**
 * Contract for every Wix detection rule.
 *
 * A rule is a single, focused signal used to determine whether a given
 * website is built on Wix. Each implementation inspects the supplied HTML
 * source and URL independently of other rules, keeping detection modular,
 * testable, and composable.
 *
 * Implementations must be stateless and side-effect free: a rule should
 * never mutate global state, persist data, or emit output. The evaluated
 * evidence is returned as a structured result array consumed by the
 * Wix detector and its confidence calculator.
 *
 * The interface remains technology-agnostic: no Wix-specific knowledge is
 * encoded here. Concrete rules are free to parse markup, interrogate asset
 * URLs, or rely on any other strategy without violating the contract.
 */
interface RuleInterface
{
    /**
     * Evaluate the supplied HTML and URL for a single Wix detection signal.
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
