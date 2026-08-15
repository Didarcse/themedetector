<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\DetectionReport\DetectedTechnology;
use App\Domain\DetectionReport\DetectionError;
use App\Domain\DetectionReport\DetectionReport;
use App\Domain\DetectionReport\DetectionSummary;
use App\Domain\DetectionReport\WebsiteInformation;
use App\Modules\Detection\Core\DetectionPipeline;
use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionContextFactory;
use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpException;
use App\Modules\PluginDetection\PluginDetectionManager;
use App\Modules\TechnologyDetection\TechnologyDetector;
use App\Modules\ThemeExtraction\ThemeExtractor;
use RuntimeException;

/**
 * Orchestrates the complete website detection report workflow.
 *
 * WebsiteReportAnalyzer is the application-layer entry point of the
 * detection report page. It normalizes and validates the supplied URL,
 * retrieves the target website once through the HTTP client, creates the
 * immutable DetectionContext, and runs the four production detection
 * engines in order:
 *
 * - Detection Engine (CMS detection) via the DetectionPipeline.
 * - Theme Extraction Engine via the ThemeExtractor facade.
 * - Plugin Detection Engine via the PluginDetectionManager.
 * - Technology Detection Engine via the TechnologyDetector facade.
 *
 * Every engine result and the total detection time are assembled into an
 * immutable domain DetectionReport. Transport failures and invalid URLs
 * never escape: they are converted into an error report instead. A
 * Technology Detection Engine failure never breaks the report; it is
 * reported as an empty technology list instead.
 *
 * Responsibilities:
 *
 * - Normalize and validate the supplied URL.
 * - Retrieve the target website through the HTTP client.
 * - Create the immutable DetectionContext.
 * - Run the Detection, Theme Extraction, Plugin Detection, and Technology
 *   Detection engines.
 * - Measure the total detection time.
 * - Assemble and return an immutable domain DetectionReport.
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
     * @param HttpClientInterface     $httpClient        The HTTP client used
     *                                                   to retrieve the
     *                                                   target website.
     * @param DetectionContextFactory $contextFactory    The factory that
     *                                                   creates the immutable
     *                                                   DetectionContext.
     * @param DetectionPipeline       $pipeline          The Detection Engine
     *                                                   pipeline.
     * @param ThemeExtractor          $themeExtractor    The Theme Extraction
     *                                                   Engine facade.
     * @param PluginDetectionManager  $pluginManager     The Plugin Detection
     *                                                   Engine manager.
     * @param TechnologyDetector      $technologyDetector The Technology
     *                                                   Detection Engine
     *                                                   facade.
     */
    public function __construct(
        private HttpClientInterface $httpClient,
        private DetectionContextFactory $contextFactory,
        private DetectionPipeline $pipeline,
        private ThemeExtractor $themeExtractor,
        private PluginDetectionManager $pluginManager,
        private TechnologyDetector $technologyDetector,
    ) {
    }

    /**
     * Analyse the website at the given URL and return the report.
     *
     * The URL is normalized (a scheme is added when missing) and validated.
     * On success the four detection engines run in order and their results
     * are assembled into a domain DetectionReport together with the
     * measured detection time and the analysed website's HTTP status code.
     * Invalid URLs and transport failures produce an error report that
     * always carries a user-facing message.
     *
     * @param string $url The website URL submitted by the user.
     *
     * @return DetectionReport The immutable detection report.
     */
    public function analyze(string $url): DetectionReport
    {
        $url = $this->normalizeUrl($url);

        if ($url === null) {
            return $this->errorReport(
                url: '',
                code: 'invalid_url',
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
            $technologies = $this->detectTechnologies($context);

            return new DetectionReport(
                websiteInformation: new WebsiteInformation(
                    url: $url,
                    finalUrl: $response->finalUrl(),
                    statusCode: $response->statusCode(),
                ),
                engine: $detection,
                theme: $theme,
                plugin: $plugin,
                technologies: $technologies,
                summary: DetectionSummary::from($detection, $theme, $plugin),
                detectionTime: microtime(true) - $startedAt,
            );
        } catch (HttpException) {
            return $this->errorReport(
                url: $url,
                code: 'transport_failure',
                message: 'The website could not be reached. Please check the URL and try again.',
            );
        }
    }

    /**
     * Run the Technology Detection Engine and map its results.
     *
     * The engine runs against the existing immutable DetectionContext and
     * performs no HTTP requests. A technology detection failure never
     * breaks the report: when the engine cannot produce results, an empty
     * list is returned instead.
     *
     * @param DetectionContext $context The immutable detection context.
     *
     * @return list<DetectedTechnology> The detected technologies, empty
     *                                  when none were identified or the
     *                                  engine failed.
     */
    private function detectTechnologies(DetectionContext $context): array
    {
        try {
            $results = $this->technologyDetector->detect($context);
        } catch (RuntimeException) {
            return [];
        }

        $technologies = [];

        foreach ($results as $result) {
            $metadata = $result->metadata();

            if ($metadata === null) {
                continue;
            }

            $technologies[] = new DetectedTechnology(
                name: $metadata->name(),
                category: $metadata->category() ?? 'Technology',
                confidence: $result->confidence(),
                version: $metadata->version(),
            );
        }

        return $technologies;
    }

    /**
     * Build an error report for the given message.
     *
     * @param string $url     The normalized URL, empty when invalid.
     * @param string $code    The stable machine-readable error code.
     * @param string $message The user-facing error message.
     *
     * @return DetectionReport The immutable error report.
     */
    private function errorReport(string $url, string $code, string $message): DetectionReport
    {
        return new DetectionReport(
            websiteInformation: new WebsiteInformation(
                url: $url,
                finalUrl: '',
                statusCode: 0,
            ),
            errors: [
                new DetectionError(
                    code: $code,
                    message: $message,
                    source: 'WebsiteReportAnalyzer',
                ),
            ],
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
