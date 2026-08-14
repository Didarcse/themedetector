<?php

declare(strict_types=1);

namespace Tests\Benchmark;

/**
 * Immutable aggregate of every benchmark case evaluation.
 *
 * BenchmarkReport is the canonical output of the Detection Benchmark
 * Suite. It aggregates the BenchmarkResult produced for every evaluated
 * case and exposes the aggregate metrics used to measure the real-world
 * accuracy of the detection engine: total cases, successful and failed
 * detections, CMS/theme/plugin accuracy rates, false positives, false
 * negatives, transport failures, exercised categories and platforms, the
 * platforms the suite does not cover, average confidence, and average
 * runtime.
 *
 * Responsibilities:
 *
 * - Aggregate every BenchmarkResult in evaluation order.
 * - Compute the aggregate benchmark metrics.
 * - Report which supported platforms the suite does and does not exercise.
 * - Render a human-readable console summary.
 * - Nothing else.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it stores and aggregates evaluation
 *   data only. It performs no detection, no parsing, and no timing.
 * - Deterministic: given the same results, every aggregate metric is
 *   always identical.
 * - Division is guarded: an empty report yields zero averages and zero
 *   accuracy rates, never a division-by-zero error.
 * - Honest reporting: an accuracy rate is only ever computed over the
 *   cases actually evaluated, and the platforms the suite does not
 *   exercise are reported explicitly instead of being folded into an
 *   aggregate.
 *
 * Metric semantics:
 *
 * - Successful detections: cases whose CMS detection is accurate.
 * - Failed detections: the remaining cases.
 * - CMS/Theme/Plugin accuracy: the percentage of cases whose respective
 *   metric is accurate.
 * - Transport failures: cases the engines could not evaluate because an
 *   outbound request failed at the transport level.
 * - Missing platforms: the supported platforms that have no cases in this
 *   report.
 * - Average confidence and average runtime: means over every evaluated
 *   case.
 */
final readonly class BenchmarkReport
{
    /**
     * The platforms the detection engine supports and the benchmark suite
     * is expected to cover.
     *
     * @var list<string>
     */
    private const SUPPORTED_PLATFORMS = [
        'WordPress',
        'Shopify',
        'Wix',
        'Webflow',
        'Joomla',
        'Drupal',
        'Ghost',
        'TYPO3',
        'Squarespace',
    ];

    /**
     * @param list<BenchmarkResult> $results            The evaluation
     *                                                  results, in
     *                                                  evaluation order.
     * @param list<string>          $exercisedPlatforms The platforms covered
     *                                                  by the providers that
     *                                                  produced this report.
     */
    public function __construct(
        private array $results,
        private array $exercisedPlatforms = [],
    ) {
    }

    /**
     * Return every evaluation result, in evaluation order.
     *
     * @return list<BenchmarkResult> The evaluation results.
     */
    public function results(): array
    {
        return $this->results;
    }

    /**
     * Return the total number of evaluated websites.
     *
     * @return int The total case count.
     */
    public function totalCases(): int
    {
        return count($this->results);
    }

    /**
     * Return the number of successful detections.
     *
     * @return int The number of cases with an accurate CMS detection.
     */
    public function successfulDetections(): int
    {
        $successful = 0;

        foreach ($this->results as $result) {
            if ($result->isSuccessful()) {
                $successful++;
            }
        }

        return $successful;
    }

    /**
     * Return the number of failed detections.
     *
     * @return int The total case count minus the successful detections.
     */
    public function failedDetections(): int
    {
        return $this->totalCases() - $this->successfulDetections();
    }

    /**
     * Return the average confidence score across every case.
     *
     * @return float The average confidence (0–100), or 0.0 for an empty
     *               report.
     */
    public function averageConfidence(): float
    {
        if ($this->totalCases() === 0) {
            return 0.0;
        }

        $total = 0;

        foreach ($this->results as $result) {
            $total += $result->confidence();
        }

        return $total / $this->totalCases();
    }

    /**
     * Return the average execution time in seconds.
     *
     * @return float The average runtime in seconds, or 0.0 for an empty
     *               report.
     */
    public function averageRuntime(): float
    {
        if ($this->totalCases() === 0) {
            return 0.0;
        }

        $total = 0.0;

        foreach ($this->results as $result) {
            $total += $result->executionTime();
        }

        return $total / $this->totalCases();
    }

    /**
     * Return the CMS detection accuracy as a percentage.
     *
     * @return float The accuracy percentage (0–100), or 0.0 for an empty
     *               report.
     */
    public function cmsAccuracy(): float
    {
        return $this->rate(static fn (BenchmarkResult $result): bool => $result->cmsAccurate());
    }

    /**
     * Return the theme detection accuracy as a percentage.
     *
     * @return float The accuracy percentage (0–100), or 0.0 for an empty
     *               report.
     */
    public function themeAccuracy(): float
    {
        return $this->rate(static fn (BenchmarkResult $result): bool => $result->themeAccurate());
    }

    /**
     * Return the plugin detection accuracy as a percentage.
     *
     * @return float The accuracy percentage (0–100), or 0.0 for an empty
     *               report.
     */
    public function pluginAccuracy(): float
    {
        return $this->rate(static fn (BenchmarkResult $result): bool => $result->pluginAccurate());
    }

    /**
     * Return the total number of false positives.
     *
     * @return int The false-positive count.
     */
    public function falsePositives(): int
    {
        $count = 0;

        foreach ($this->results as $result) {
            if ($result->isFalsePositive()) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Return the total number of false negatives.
     *
     * @return int The false-negative count.
     */
    public function falseNegatives(): int
    {
        $count = 0;

        foreach ($this->results as $result) {
            if ($result->isFalseNegative()) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Return the number of transport failures.
     *
     * A transport failure is a case the engines could not evaluate because
     * an outbound request failed at the HTTP layer. Transport failures are
     * reported separately and are never counted as false positives or
     * false negatives.
     *
     * @return int The transport-failure count.
     */
    public function transportFailures(): int
    {
        $count = 0;

        foreach ($this->results as $result) {
            if ($result->isTransportFailure()) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Return the number of evaluated cases per category.
     *
     * @return array<string, int> The case counts keyed by category, in
     *                            first-appearance order.
     */
    public function categories(): array
    {
        $categories = [];

        foreach ($this->results as $result) {
            $category = $result->case()->category();
            $categories[$category] = ($categories[$category] ?? 0) + 1;
        }

        return $categories;
    }

    /**
     * Return the platforms exercised by the providers of this report.
     *
     * @return list<string> The exercised platform names.
     */
    public function exercisedPlatforms(): array
    {
        return $this->exercisedPlatforms;
    }

    /**
     * Return the supported platforms the suite does not exercise.
     *
     * A missing platform has no cases in this report, so its accuracy can
     * never be claimed by the aggregate metrics.
     *
     * @return list<string> The supported platforms with no cases.
     */
    public function missingPlatforms(): array
    {
        return array_values(array_diff(self::SUPPORTED_PLATFORMS, $this->exercisedPlatforms));
    }

    /**
     * Render the human-readable console summary of this report.
     *
     * The summary lists the headline metrics: total websites, successful
     * and failed detections, the three accuracy rates, false positives and
     * negatives, transport failures, exercised categories, missing
     * platforms, average confidence, and average runtime.
     *
     * @return string The formatted console summary.
     */
    public function summary(): string
    {
        $categories = [];

        foreach ($this->categories() as $category => $count) {
            $categories[] = "{$category} ({$count})";
        }

        $lines = [
            'Detection Benchmark Summary',
            '===========================',
            sprintf('Total websites:           %d', $this->totalCases()),
            sprintf('Successful detections:    %d', $this->successfulDetections()),
            sprintf('Failed detections:        %d', $this->failedDetections()),
            sprintf('CMS detection accuracy:   %.1f%%', $this->cmsAccuracy()),
            sprintf('Theme detection accuracy: %.1f%%', $this->themeAccuracy()),
            sprintf('Plugin detection accuracy:%.1f%%', $this->pluginAccuracy()),
            sprintf('False positives:          %d', $this->falsePositives()),
            sprintf('False negatives:          %d', $this->falseNegatives()),
            sprintf('Transport failures:       %d', $this->transportFailures()),
            sprintf('Categories exercised:     %s', $categories === [] ? 'none' : implode(', ', $categories)),
            sprintf(
                'Platforms not exercised:  %s',
                $this->missingPlatforms() === [] ? 'none' : implode(', ', $this->missingPlatforms()),
            ),
            sprintf('Average confidence:       %.1f', $this->averageConfidence()),
            sprintf('Average runtime:          %.6fs', $this->averageRuntime()),
        ];

        return implode(PHP_EOL, $lines);
    }

    /**
     * Compute the percentage of results satisfying the given predicate.
     *
     * @param callable(BenchmarkResult): bool $predicate The accuracy
     *                                                   predicate.
     *
     * @return float The percentage (0–100), or 0.0 for an empty report.
     */
    private function rate(callable $predicate): float
    {
        if ($this->totalCases() === 0) {
            return 0.0;
        }

        $accurate = 0;

        foreach ($this->results as $result) {
            if ($predicate($result)) {
                $accurate++;
            }
        }

        return ($accurate / $this->totalCases()) * 100;
    }
}
