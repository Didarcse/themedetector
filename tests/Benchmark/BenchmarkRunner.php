<?php

declare(strict_types=1);

namespace Tests\Benchmark;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionManager;
use App\Modules\PluginDetection\PluginDetectionManager;
use App\Modules\PluginDetection\PluginDetectionResult;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;

/**
 * Orchestrates the complete Detection Benchmark run.
 *
 * BenchmarkRunner is the entry point of the Detection Benchmark Suite. It
 * executes every benchmark case provided by the registered case providers
 * against the real detection engine — the CMS DetectionManager and the
 * PluginDetectionManager — measures the execution time of every case, and
 * assembles the resulting BenchmarkReport.
 *
 * This is NOT a test suite: the runner never asserts, never throws on a
 * failed detection, and never produces a pass/fail verdict for the build.
 * It is a benchmarking and regression framework that measures real-world
 * detection accuracy.
 *
 * Responsibilities:
 *
 * - Obtain every benchmark case from the registered providers.
 * - Build an immutable DetectionContext for every case from its offline
 *   HTML fixture.
 * - Execute the DetectionManager and the PluginDetectionManager against
 *   the context.
 * - Measure the execution time of every case.
 * - Assemble one BenchmarkResult per case and one BenchmarkReport.
 *
 * Design philosophy:
 *
 * - Orchestrator: the runner coordinates the engines and the cases and
 *   performs no detection, no parsing, no scoring, and no HTTP of its own.
 * - Dependency Injection: the detection engines and the case providers are
 *   provided through the constructor.
 * - Open/Closed Principle: new platforms and categories are introduced by
 *   new providers without modifying the runner.
 * - No HTTP implementation: every case carries its HTML fixture; the
 *   benchmark never performs network requests.
 * - Stateless, deterministic, and side-effect free: given the same engines
 *   and providers, run() always produces the same report.
 *
 * Example composition:
 *
 *     $runner = new BenchmarkRunner(
 *         $detectionManager,
 *         $pluginDetectionManager,
 *         [
 *             new WordPressPopularThemeCases(),
 *             new ShopifyBenchmarkCases(),
 *         ],
 *     );
 *
 *     echo $runner->run()->summary();
 */
final readonly class BenchmarkRunner
{
    /**
     * @param DetectionManager              $detectionManager       The CMS
     *                                                              detection
     *                                                              engine.
     * @param PluginDetectionManager        $pluginDetectionManager The plugin
     *                                                              detection
     *                                                              engine.
     * @param iterable<BenchmarkCaseProvider> $caseProviders         The case
     *                                                              providers.
     */
    public function __construct(
        private DetectionManager $detectionManager,
        private PluginDetectionManager $pluginDetectionManager,
        private iterable $caseProviders,
    ) {
    }

    /**
     * Run every benchmark case and assemble the benchmark report.
     *
     * Every case provided by the registered providers is executed against
     * the detection engines in provider order. A failed detection is
     * recorded, never thrown. An engine failure is unrecoverable and
     * propagates, since a broken engine must abort the benchmark rather
     * than silently skew its metrics.
     *
     * @return BenchmarkReport The aggregated benchmark report.
     */
    public function run(): BenchmarkReport
    {
        $results = [];

        foreach ($this->cases() as $case) {
            $results[] = $this->runCase($case);
        }

        return new BenchmarkReport($results);
    }

    /**
     * Execute a single benchmark case and produce its evaluation result.
     *
     * Builds an immutable DetectionContext from the case fixture, executes
     * both detection engines within a single timed window, and derives the
     * detected technology, theme, and plugin set from their results.
     *
     * @param BenchmarkCase $case The benchmark case to execute.
     *
     * @return BenchmarkResult The evaluation result of the case.
     */
    private function runCase(BenchmarkCase $case): BenchmarkResult
    {
        $context = new DetectionContext(
            originalUrl: $case->url(),
            finalUrl: $case->url(),
            html: $case->html(),
            statusCode: 200,
        );

        $start = hrtime(true);

        $detection = $this->detectionManager->detect($context);
        $pluginDetection = $this->pluginDetectionManager->detect($context);

        $executionTime = (hrtime(true) - $start) / 1_000_000_000;

        return new BenchmarkResult(
            case: $case,
            detected: $detection->isDetected(),
            detectedTechnology: $detection->isDetected() ? $detection->technology() : null,
            detectedTheme: $detection->theme(),
            detectedPlugins: $this->extractPlugins($pluginDetection),
            confidence: $detection->confidence(),
            executionTime: $executionTime,
        );
    }

    /**
     * Materialize every case from the registered providers.
     *
     * Cases are collected in provider registration order, preserving the
     * deterministic ordering contract of the suite.
     *
     * @return list<BenchmarkCase> The materialized benchmark cases.
     */
    private function cases(): array
    {
        $cases = [];

        foreach ($this->caseProviders as $provider) {
            foreach ($provider->cases() as $case) {
                $cases[] = $case;
            }
        }

        return $cases;
    }

    /**
     * Extract the reported plugin slug set from a plugin detection result.
     *
     * The plugin detection engine reports a single primary plugin; its
     * slug becomes the sole entry of the detected set. An undetected or
     * slug-less result contributes an empty set.
     *
     * @param PluginDetectionResult $pluginDetection The plugin detection
     *                                               result.
     *
     * @return list<string> The detected plugin slugs.
     */
    private function extractPlugins(PluginDetectionResult $pluginDetection): array
    {
        if (!$pluginDetection->isDetected()) {
            return [];
        }

        $plugin = $pluginDetection->plugin();

        if ($plugin === null || $plugin->slug() === null) {
            return [];
        }

        return [$plugin->slug()];
    }
}
