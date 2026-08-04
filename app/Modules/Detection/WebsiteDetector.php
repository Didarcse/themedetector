<?php

declare(strict_types=1);

namespace App\Modules\Detection;

use App\Modules\Http\HttpClientInterface;

/**
 * Public entry point for the ThemeDetectorTool Detection Engine.
 *
 * WebsiteDetector coordinates the complete website detection workflow: it
 * retrieves the target website using the HTTP client, delegates
 * DetectionContext creation to the DetectionContextFactory, hands the
 * context to the DetectionManager, and returns the DetectionResult.
 *
 * WebsiteDetector is the only class external consumers should interact
 * with for CMS detection.
 *
 * Responsibilities:
 *
 * - Retrieve the target website via the HTTP client.
 * - Delegate DetectionContext creation to the DetectionContextFactory.
 * - Delegate detection to the DetectionManager.
 * - Return the DetectionResult.
 *
 * Design philosophy:
 *
 * - Facade: it is the single public entry point for the Detection Engine.
 * - Orchestrator: it wires the workflow steps together and nothing more.
 * - Dependency Injection: collaborators are provided through the
 *   constructor.
 * - Single Responsibility Principle: coordination only; it contains no
 *   CMS detection logic, confidence calculation, or HTML parsing.
 * - Open/Closed Principle: new detection strategies are added without
 *   modifying this class.
 * - Stateless, deterministic, and side-effect free except for the
 *   delegated HTTP request.
 */
final readonly class WebsiteDetector
{
    /**
     * Create a new WebsiteDetector.
     *
     * @param HttpClientInterface       $httpClient The HTTP client used to
     *                                              retrieve target websites.
     * @param DetectionManager          $manager    The DetectionManager that
     *                                              performs CMS detection.
     * @param DetectionContextFactory   $factory    The factory that creates
     *                                              DetectionContext objects.
     */
    public function __construct(
        private HttpClientInterface $httpClient,
        private DetectionManager $manager,
        private DetectionContextFactory $factory,
    ) {
    }

    /**
     * Detect the CMS of the website at the given URL.
     *
     * Retrieves the website via the HTTP client, creates the
     * DetectionContext through the DetectionContextFactory, delegates
     * detection to the DetectionManager, and returns the resulting
     * DetectionResult.
     *
     * @param string $url The absolute URL of the website to detect.
     *
     * @return DetectionResult The detection result.
     */
    public function detect(string $url): DetectionResult
    {
        $response = $this->httpClient->get($url);

        $context = $this->factory->create($response);

        return $this->manager->detect($context);
    }
}
