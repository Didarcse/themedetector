<?php

declare(strict_types=1);

namespace Tests\Integration\Detection;

use App\Core\Application;
use App\Modules\Detection\DetectionResult;
use App\Modules\Detection\DetectorRegistry;
use App\Modules\Detection\WebsiteDetector;
use App\Modules\Detection\WordPress\ConfidenceCalculator;
use App\Modules\Detection\WordPress\Rules\GeneratorRule;
use App\Modules\Detection\WordPress\Rules\ThemePathRule;
use App\Modules\Detection\WordPress\WordPressDetector;
use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpResponse;
use PHPUnit\Framework\TestCase;

/**
 * Fake HTTP client for the Detection Engine integration tests.
 *
 * Replaces the real HTTP client in the container so that no network I/O
 * occurs. It always returns the same static WordPress-generator page.
 */
final class FakeHttpClient implements HttpClientInterface
{
    public function get(string $url): HttpResponse
    {
        return new HttpResponse(
            originalUrl: 'https://example.com',
            finalUrl: 'https://example.com',
            statusCode: 200,
            headers: [],
            body: '<meta name="generator" content="WordPress">',
        );
    }
}

/**
 * End-to-end integration tests for the public WebsiteDetector API.
 *
 * Verifies the complete Detection Engine workflow using real services:
 * WebsiteDetector, the HTTP client fake, DetectionContextFactory,
 * DetectionManager, DetectorRegistry, and the real WordPressDetector with
 * its real rules. Only the HTTP client is replaced.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Integration: verifies the full collaboration chain from HTTP response
 *   through context creation to detection result.
 * - Fast, deterministic, and independent: no mocks, no stubs, no
 *   reflection, and no network I/O.
 * - Each test verifies exactly one behaviour.
 */
final class WebsiteDetectorIntegrationTest extends TestCase
{
    private const URL = 'https://example.com';

    public function test_detect_returns_detection_result(): void
    {
        $result = $this->detectWordPress();

        self::assertInstanceOf(DetectionResult::class, $result);
    }

    public function test_detect_identifies_wordpress(): void
    {
        $result = $this->detectWordPress();

        self::assertSame('WordPress', $result->technology());
    }

    public function test_detect_reports_positive_confidence(): void
    {
        $result = $this->detectWordPress();

        self::assertGreaterThan(0, $result->confidence());
    }

    public function test_detect_reports_detected(): void
    {
        $result = $this->detectWordPress();

        self::assertTrue($result->isDetected());
    }

    /**
     * Boot the application, replace the HTTP client with the fake, and
     * run the complete Detection Engine workflow.
     */
    private function detectWordPress(): DetectionResult
    {
        $detector = $this->createBootedApplication()->container()->get(WebsiteDetector::class);

        return $detector->detect(self::URL);
    }

    private function createBootedApplication(): Application
    {
        $application = new Application();
        $application->boot();

        $container = $application->container();
        $container->set(HttpClientInterface::class, new FakeHttpClient());
        $container->set(DetectorRegistry::class, new DetectorRegistry([
            $this->createWordPressDetector(),
        ]));

        return $application;
    }

    private function createWordPressDetector(): WordPressDetector
    {
        return new WordPressDetector(
            [
                new GeneratorRule(),
                new ThemePathRule(),
            ],
            new ConfidenceCalculator(),
        );
    }
}
