<?php

declare(strict_types=1);

namespace App\Services;

use App\Modules\Detection\Core\DetectionPipeline;
use App\Modules\Detection\DetectionContextFactory;
use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpException;
use App\Modules\PluginDetection\PluginDetectionManager;
use App\Modules\ThemeExtraction\ThemeExtractor;

/**
 * Orchestrates the complete website detection report workflow.
 *
 * WebsiteReportAnalyzer is the application-layer entry point of the
 * detection report page. It normalizes and validates the supplied URL,
 * retrieves the target website once through the HTTP client, creates the
 * immutable DetectionContext, and runs the three production detection
 * engines in order:
 *
 * - Detection Engine (CMS detection) via the DetectionPipeline.
 * - Theme Extraction Engine via the ThemeExtractor facade.
 * - Plugin Detection Engine via the PluginDetectionManager.
 *
 * Every engine result and the total detection time are assembled into an
 * immutable WebsiteReport. Transport failures and invalid URLs never
 * escape: they are converted into an error report instead.
 *
 * Responsibilities:
 *
 * - Normalize and validate the supplied URL.
 * - Retrieve the target website through the HTTP client.
 * - Create the immutable DetectionContext.
 * - Run the Detection, Theme Extraction, and Plugin Detection engines.
 * - Measure the total detection time.
 * - Assemble and return an immutable WebsiteReport.
 *
 * Design philosophy:
 *
 * - Orchestrator: it wires the workflow steps together and nothing more.
 * - Facade: it is the single public entry point for the report page.
 * - Dependency Injection: every collaborator is provided through the
 *   constructor.
 * - Single Responsibility Principle: coordination only; it contains no
 *   detection, extraction, parsing, or business rules.
 * - Side-effect free except for the delegated HTTP request.
 */
final readonly class WebsiteReportAnalyzer
{
    /**
     * Create a new WebsiteReportAnalyzer.
     *
     * @param HttpClientInterface     $httpClient     The HTTP client used to
     *                                                retrieve the target
     *                                                website.
     * @param DetectionContextFactory $contextFactory The factory that creates
     *                                                the immutable
     *                                                DetectionContext.
     * @param DetectionPipeline       $pipeline       The Detection Engine
     *                                                pipeline.
     * @param ThemeExtractor          $themeExtractor The Theme Extraction
     *                                                Engine facade.
     * @param PluginDetectionManager  $pluginManager  The Plugin Detection
     *                                                Engine manager.
     */
    public function __construct(
        private HttpClientInterface $httpClient,
        private DetectionContextFactory $contextFactory,
        private DetectionPipeline $pipeline,
        private ThemeExtractor $themeExtractor,
        private PluginDetectionManager $pluginManager,
    ) {
    }

    /**
     * Analyse the website at the given URL and return the report.
     *
     * The URL is normalized (a scheme is added when missing) and validated.
     * On success the three detection engines run in order and their results
     * are assembled into a WebsiteReport together with the measured
     * detection time and the analysed website's HTTP status code. Invalid
     * URLs and transport failures produce an error report that always
     * carries a user-facing message.
     *
     * @param string $url The website URL submitted by the user.
     *
     * @return WebsiteReport The immutable detection report.
     */
    public function analyze(string $url): WebsiteReport
    {
        $url = $this->normalizeUrl($url);

        if ($url === null) {
            return $this->errorReport(
                url: '',
                message: 'Please enter a valid website URL, for example https://example.com.',
            );
        }

        $startedAt = microtime(true);

        try {
            $response = $this->httpClient->get($url);
            $context = $this->contextFactory->create($response);

            $detection = $this->pipeline->analyze($context);
            $theme = $this->themeExtractor->extract($context);
            $plugin = $this->pluginManager->detect($context);

            return new WebsiteReport(
                url: $url,
                finalUrl: $response->finalUrl(),
                detection: $detection,
                theme: $theme,
                plugin: $plugin,
                detectionTime: microtime(true) - $startedAt,
                statusCode: $response->statusCode(),
            );
        } catch (HttpException) {
            return $this->errorReport(
                url: $url,
                message: 'The website could not be reached. Please check the URL and try again.',
            );
        }
    }

    /**
     * Build an error report for the given message.
     *
     * @param string $url     The normalized URL, empty when invalid.
     * @param string $message The user-facing error message.
     *
     * @return WebsiteReport The immutable error report.
     */
    private function errorReport(string $url, string $message): WebsiteReport
    {
        return new WebsiteReport(
            url: $url,
            finalUrl: '',
            detection: null,
            theme: null,
            plugin: null,
            detectionTime: 0.0,
            statusCode: 0,
            error: $message,
        );
    }

    /**
     * Normalize and validate a submitted URL.
     *
     * A missing scheme is inferred as HTTPS before validation. When the
     * input is empty or not a valid absolute http(s) URL, null is returned.
     *
     * @param string $url The raw submitted URL.
     *
     * @return string|null The normalized valid URL, or null when invalid.
     */
    private function normalizeUrl(string $url): ?string
    {
        $url = trim($url);

        if ($url === '') {
            return null;
        }

        if (preg_match('#^https?://#i', $url) !== 1) {
            $url = 'https://' . $url;
        }

        $validated = filter_var($url, FILTER_VALIDATE_URL);

        return $validated === false ? null : $url;
    }
}
