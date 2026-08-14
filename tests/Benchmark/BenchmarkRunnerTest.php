<?php

declare(strict_types=1);

namespace Tests\Benchmark;

use App\Core\Container;
use App\Modules\Detection\DetectionManager;
use App\Modules\Detection\DetectorRegistryFactory;
use App\Modules\Http\HttpClient;
use App\Modules\Http\HttpClientInterface;
use App\Modules\PluginDetection\PluginDetectionManager;
use App\Modules\PluginDetection\PluginRegistryFactory;
use App\Modules\ThemeExtraction\ThemeExtractionManager;
use App\Modules\ThemeExtraction\ThemeExtractor;
use App\Modules\ThemeExtraction\ThemeExtractorRegistryFactory;
use PHPUnit\Framework\TestCase;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;
use Tests\Benchmark\Shopify\ShopifyBenchmarkCases;
use Tests\Benchmark\Webflow\WebflowBenchmarkCases;
use Tests\Benchmark\Wix\WixBenchmarkCases;
use Tests\Benchmark\WordPress\WordPressCommercialThemeCases;
use Tests\Benchmark\WordPress\WordPressCustomThemeCases;
use Tests\Benchmark\WordPress\WordPressDefaultThemeCases;
use Tests\Benchmark\WordPress\WordPressPopularPluginCases;
use Tests\Benchmark\WordPress\WordPressPopularThemeCases;
use Tests\Support\OfflineHttpClient;

/**
 * Verifies the benchmark harness correctness guarantees.
 *
 * The suite must exercise the real Theme Extractor engine (recording the
 * extracted theme name and version) and must never perform a real network
 * request: every outbound call flows through the OfflineHttpClient, which
 * serves the per-case fixture responses and answers everything else with
 * HTTP 404.
 */
final class BenchmarkRunnerTest extends TestCase
{
    public function test_runner_invokes_real_theme_extractor_and_records_theme_name_and_version(): void
    {
        $offline = new OfflineHttpClient();

        $report = $this->runner([new WordPressPopularThemeCases()], $offline)->run();

        $astra = $report->results()[0];

        $this->assertSame('Astra', $astra->detectedTheme());
        $this->assertSame('4.8.3', $astra->detectedThemeVersion());
        $this->assertTrue($astra->themeAccurate());
        $this->assertSame('WordPress', $astra->detectedTechnology());
        $this->assertSame(['contact-form-7'], $astra->detectedPlugins());
    }

    public function test_runner_never_performs_real_network_requests(): void
    {
        $offline = new OfflineHttpClient();

        $report = $this->runner($this->allProviders(), $offline)->run();

        $this->assertSame(21, $report->totalCases());
        $this->assertNotEmpty($offline->requestedUrls());

        $this->assertContains(
            'https://www.bellaspa.com/cart.js',
            $offline->requestedUrls(),
        );

        $this->assertContains(
            'https://www.acme-agency.com/wp-json/',
            $offline->requestedUrls(),
        );

        $this->assertContains(
            'https://www.acme-agency.com/wp-content/themes/astra/style.css',
            $offline->requestedUrls(),
        );
    }

    public function test_offline_client_serves_seeded_responses_and_404s_unknown_urls(): void
    {
        $client = new OfflineHttpClient();

        $client->seed(['https://example.test/style.css' => 'Theme Name: Example']);

        $this->assertSame(200, $client->get('https://example.test/style.css')->statusCode());
        $this->assertSame('Theme Name: Example', $client->get('https://example.test/style.css')->body());
        $this->assertSame(404, $client->get('https://example.test/cart.js')->statusCode());
        $this->assertSame(404, $client->get('https://example.test/wp-json/')->statusCode());

        $this->assertSame(
            [
                'https://example.test/style.css',
                'https://example.test/style.css',
                'https://example.test/cart.js',
                'https://example.test/wp-json/',
            ],
            $client->requestedUrls(),
        );
    }

    public function test_report_distinguishes_metrics_and_makes_missing_platforms_explicit(): void
    {
        $offline = new OfflineHttpClient();

        $report = $this->runner(
            [new WordPressPopularThemeCases(), new ShopifyBenchmarkCases()],
            $offline,
        )->run();

        $this->assertSame(5, $report->totalCases());
        $this->assertSame(100.0, $report->cmsAccuracy());
        $this->assertSame(100.0, $report->themeAccuracy());
        $this->assertSame(100.0, $report->pluginAccuracy());
        $this->assertSame(0, $report->falsePositives());
        $this->assertSame(0, $report->falseNegatives());
        $this->assertSame(0, $report->transportFailures());
        $this->assertSame(['popular-theme' => 3, 'storefront' => 2], $report->categories());
        $this->assertSame(['WordPress', 'Shopify'], $report->exercisedPlatforms());
        $this->assertSame(
            ['Wix', 'Webflow', 'Joomla', 'Drupal', 'Ghost', 'TYPO3', 'Squarespace'],
            $report->missingPlatforms(),
        );
    }

    /**
     * @param list<BenchmarkCaseProvider> $providers
     */
    private function runner(array $providers, OfflineHttpClient $offline): BenchmarkRunner
    {
        $container = new Container();
        $container->set(HttpClient::class, $offline);
        $container->set(HttpClientInterface::class, $offline);

        $detectionManager = new DetectionManager(
            (new DetectorRegistryFactory())->create($container),
        );

        $pluginDetectionManager = new PluginDetectionManager(
            (new PluginRegistryFactory())->create($container),
        );

        $themeExtractor = new ThemeExtractor(
            new ThemeExtractionManager(
                (new ThemeExtractorRegistryFactory())->create($container),
            ),
        );

        return new BenchmarkRunner(
            detectionManager: $detectionManager,
            pluginDetectionManager: $pluginDetectionManager,
            themeExtractor: $themeExtractor,
            caseProviders: $providers,
            offlineHttpClient: $offline,
        );
    }

    /**
     * @return list<BenchmarkCaseProvider>
     */
    private function allProviders(): array
    {
        return [
            new WordPressPopularThemeCases(),
            new WordPressDefaultThemeCases(),
            new WordPressCustomThemeCases(),
            new WordPressCommercialThemeCases(),
            new WordPressPopularPluginCases(),
            new ShopifyBenchmarkCases(),
            new WixBenchmarkCases(),
            new WebflowBenchmarkCases(),
        ];
    }
}
