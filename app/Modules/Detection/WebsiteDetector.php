<?php

declare(strict_types=1);

namespace App\Modules\Detection;

use App\Modules\Http\HttpClientInterface;

/**
 * Public entry point for the Detection Engine.
 *
 * Orchestrates the complete detection pipeline and hides all
 * infrastructure details from consumers. A caller only supplies a website
 * URL and receives a DetectionResult.
 *
 * Responsibilities:
 *
 * - Fetch the website's response through an HttpClientInterface.
 * - Convert the HttpResponse into a DetectionContext.
 * - Delegate detection to the DetectionManager and return its result.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is a facade and pipeline
 *   orchestrator only. It contains no CMS detection logic, performs no
 *   HTML parsing, calculates no confidence, and merges no metadata.
 * - Dependency Inversion Principle: it depends on the
 *   HttpClientInterface abstraction and the DetectionManager, never on
 *   concrete technologies (WordPress, Joomla, Drupal, Ghost, TYPO3, etc.)
 *   or concrete HTTP transports.
 * - The facade is stateless and deterministic except for the network I/O
 *   inherent to performing a request, and side-effect free except for the
 *   delegated HTTP request.
 */
final readonly class WebsiteDetector
{
    /**
     * Create the detection pipeline.
     *
     * @param HttpClientInterface      $httpClient       Performs the outbound
     *                                                   HTTP request.
     * @param DetectionContextFactory  $contextFactory   Converts the HTTP
     *                                                   response into a
     *                                                   DetectionContext.
     * @param DetectionManager         $detectionManager Coordinates the
     *                                                   registered detectors.
     */
    public function __construct(
        private HttpClientInterface $httpClient,
        private DetectionContextFactory $contextFactory,
        private DetectionManager $detectionManager,
    ) {
    }

    /**
     * Detect the technology of a website by URL.
     *
     * @param string $url The website URL to detect.
     *
     * @return DetectionResult The detection result with the highest
     *                         confidence.
     */
    public function detect(string $url): DetectionResult
    {
        $response = $this->httpClient->get($url);

        $context = $this->contextFactory->create($response);

        return $this->detectionManager->detect($context);
    }
}
