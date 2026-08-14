<?php

declare(strict_types=1);

namespace Tests\Benchmark;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionManager;
use App\Modules\Http\HttpException;
use App\Modules\PluginDetection\PluginDetectionManager;
use App\Modules\PluginDetection\PluginDetectionResult;
use App\Modules\ThemeExtraction\ThemeExtractor;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;
use Tests\Support\OfflineHttpClient;

/**
 * Orchestrates the complete Detection Benchmark run.
 *
 * BenchmarkRunner is the entry point of the Detection Benchmark Suite. It
 * executes every benchmark case provided by the registered case providers
 * against the real detection engines — the CMS DetectionManager, the
 * PluginDetectionManager, and the ThemeExtractor — measures the execution
 * time of every case, and assembles the resulting BenchmarkReport.
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
 * - Seed the offline HTTP client with the case's fixture responses.
 * - Execute the DetectionManager, the PluginDetectionManager, and the
 *   real ThemeExtractor against the context.
 * - Record the detected theme name and version from the ThemeExtractor.
 * - Record transport failures separately from detection outcomes.
 * - Measure the execution time of every case.
 * - Assemble one BenchmarkResult per case and one BenchmarkReport.
 *
 * Design philosophy:
 *
 * - Orchestrator: the runner coordinates the engines and the cases and
 *   performs no detection, no parsing, no scoring, and no HTTP of its own.
 * - Dependency Injection: the detection engines, the theme extractor, the
 *   offline HTTP client, and the case providers are provided through the
 *   constructor.
 * - Open/Closed Principle: new platforms and categories are introduced by
 *   new providers without modifying the runner.
 * - Honest offline execution: every network request the engines would
 *   make flows through the injected OfflineHttpClient, which serves the
 *   per-case fixture responses and never touches the network.
 * - Stateless, deterministic, and side-effect free: given the same engines
 *   and providers, run() always produces the same report.
 *
 * Example composition:
 *
 *     $runner = new BenchmarkRunner(
 *         $detectionManager,
 *         $pluginDetectionManager,
 *         $themeExtractor,
 *         [
 *             new WordPressPopularThemeCases(),
 *             new ShopifyBenchmarkCases(),
 *         ],
 *         $offlineHttpClient,
 *     );
 *
 *     echo $runner->run()->summary();
 */
final readonly class BenchmarkRunner
{
    /**
     * @param DetectionManager                $detectionManager       The CMS
     *                                                                detection
     *                                                                engine.
     * @param PluginDetectionManager          $pluginDetectionManager The plugin
     *                                                                detection
     *                                                                engine.
     * @param ThemeExtractor                  $themeExtractor         The real
     *                                                                Theme
     *                                                                Extractor
     *                                                                engine.
     * @param iterable<BenchmarkCaseProvider> $caseProviders          The case
     *                                                                providers.
     * @param OfflineHttpClient               $offlineHttpClient      The offline
     *                                                                HTTP client
     *                                                                seeded per
     *                                                                case.
     */
    public function __construct(
        private DetectionManager $detectionManager,
        private PluginDetectionManager $pluginDetectionManager,
        private ThemeExtractor $themeExtractor,
        private iterable $caseProviders,
        private OfflineHttpClient $offlineHttpClient,
    ) {
    }

    /**
     * Run every benchmark case and assemble the benchmark report.
     *
     * Every case provided by the registered providers is executed against
     * the detection engines in provider order. A failed detection is
     * recorded, never thrown. A transport failure is recorded on the case
     * result, never thrown. An engine failure is unrecoverable and
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

        return new BenchmarkReport($results, $this->exercisedPlatforms());
    }

    /**
     * Execute a single benchmark case and produce its evaluation result.
     *
     * Seeds the offline HTTP client with the case fixture responses,
     * builds an immutable DetectionContext from the case HTML fixture,
     * executes the detection engines and the real ThemeExtractor within a
     * single timed window, and derives the detected technology, theme,
     * theme version, and plugin set from their results.
     *
     * @param BenchmarkCase $case The benchmark case to execute.
     *
     * @return BenchmarkResult The evaluation result of the case.
     */
    private function runCase(BenchmarkCase $case): BenchmarkResult
    {
        $this->offlineHttpClient->seed($case->responses());

        $context = new DetectionContext(
            originalUrl: $case->url(),
            finalUrl: $case->url(),
            html: $case->html(),
            statusCode: 200,
        );

        $start = hrtime(true);

        $transportFailure = false;
        $detection = null;
        $pluginDetection = null;
        $themeExtraction = null;

        try {
            $detection = $this->detectionManager->detect($context);
            $pluginDetection = $this->pluginDetectionManager->detect($context);
            $themeExtraction = $this->themeExtractor->extract($context);
        } catch (HttpException) {
            $transportFailure = true;
        }

        $executionTime = (hrtime(true) - $start) / 1_000_000_000;

        $detected = $detection?->isDetected() ?? false;
        $theme = $themeExtraction?->theme();

        return new BenchmarkResult(
            case: $case,
            detected: $detected,
            detectedTechnology: $detected ? $detection->technology() : null,
            detectedTheme: $theme?->name(),
            detectedThemeVersion: $theme?->version(),
            detectedPlugins: $this->extractPlugins($pluginDetection),
            confidence: $detected ? $detection->confidence() : 0,
            executionTime: $executionTime,
            transportFailure: $transportFailure,
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
     * Collect the platforms exercised by the registered providers.
     *
     * The platform names are reported by the BenchmarkReport so that the
     * suite states explicitly which supported platforms were measured and
     * which were not.
     *
     * @return list<string> The exercised platform names, in provider order.
     */
    private function exercisedPlatforms(): array
    {
        $platforms = [];

        foreach ($this->caseProviders as $provider) {
            $platforms[] = $provider->platform();
        }

        return array_values(array_unique($platforms));
    }

    /**
     * Extract the reported plugin slug set from a plugin detection result.
     *
     * The plugin detection engine reports a single primary plugin; its
     * slug becomes the sole entry of the detected set. An undetected or
     * slug-less result, as well as a case that failed at the transport
     * level, contributes an empty set.
     *
     * @param PluginDetectionResult|null $pluginDetection The plugin
     *                                                    detection result.
     *
     * @return list<string> The detected plugin slugs.
     */
    private function extractPlugins(?PluginDetectionResult $pluginDetection): array
    {
        if ($pluginDetection === null || !$pluginDetection->isDetected()) {
            return [];
        }

        $plugin = $pluginDetection->plugin();

        if ($plugin === null || $plugin->slug() === null) {
            return [];
        }

        return [$plugin->slug()];
    }
}
