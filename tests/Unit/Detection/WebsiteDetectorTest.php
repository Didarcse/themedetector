<?php

declare(strict_types=1);

namespace Tests\Unit\Detection;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionContextFactory;
use App\Modules\Detection\DetectionManager;
use App\Modules\Detection\DetectionResult;
use App\Modules\Detection\WebsiteDetector;
use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpResponse;
use PHPUnit\Framework\TestCase;

final class WebsiteDetectorTest extends TestCase
{
    private const URL = 'https://example.com';
    private const HTML = '<!DOCTYPE html><html><head></head><body></body></html>';

    private function createResponse(): HttpResponse
    {
        return new HttpResponse(
            originalUrl: self::URL,
            finalUrl: self::URL,
            statusCode: 200,
            headers: [],
            body: self::HTML,
        );
    }

    private function createContext(): DetectionContext
    {
        return new DetectionContext(
            originalUrl: self::URL,
            finalUrl: self::URL,
            html: self::HTML,
            statusCode: 200,
        );
    }

    private function createResult(): DetectionResult
    {
        return new DetectionResult(
            technology: 'Unknown',
            detected: false,
            confidence: 0,
            theme: null,
            plugins: [],
            metadata: [],
        );
    }

    private function createDetector(
        HttpClientInterface $httpClient,
        DetectionManager $manager,
        DetectionContextFactory $factory,
    ): WebsiteDetector {
        return new WebsiteDetector($httpClient, $manager, $factory);
    }

    public function test_requests_target_url_using_http_client(): void
    {
        $response = $this->createResponse();

        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient->expects(self::once())
            ->method('get')
            ->with(self::URL)
            ->willReturn($response);

        $factory = $this->createMock(DetectionContextFactory::class);
        $factory->expects(self::once())
            ->method('create')
            ->with($this->identicalTo($response))
            ->willReturn($this->createContext());

        $manager = $this->createMock(DetectionManager::class);
        $manager->expects(self::once())
            ->method('detect')
            ->willReturn($this->createResult());

        $this->createDetector($httpClient, $manager, $factory)->detect(self::URL);
    }

    public function test_passes_http_response_to_context_factory(): void
    {
        $response = $this->createResponse();
        $context = $this->createContext();

        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient->expects(self::once())
            ->method('get')
            ->with(self::URL)
            ->willReturn($response);

        $factory = $this->createMock(DetectionContextFactory::class);
        $factory->expects(self::once())
            ->method('create')
            ->with($this->identicalTo($response))
            ->willReturn($context);

        $manager = $this->createMock(DetectionManager::class);
        $manager->expects(self::once())
            ->method('detect')
            ->willReturn($this->createResult());

        $this->createDetector($httpClient, $manager, $factory)->detect(self::URL);
    }

    public function test_passes_context_to_detection_manager(): void
    {
        $response = $this->createResponse();
        $context = $this->createContext();
        $result = $this->createResult();

        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient->expects(self::once())
            ->method('get')
            ->with(self::URL)
            ->willReturn($response);

        $factory = $this->createMock(DetectionContextFactory::class);
        $factory->expects(self::once())
            ->method('create')
            ->with($this->identicalTo($response))
            ->willReturn($context);

        $manager = $this->createMock(DetectionManager::class);
        $manager->expects(self::once())
            ->method('detect')
            ->with($this->identicalTo($context))
            ->willReturn($result);

        $this->createDetector($httpClient, $manager, $factory)->detect(self::URL);
    }

    public function test_returns_detection_result(): void
    {
        $response = $this->createResponse();
        $context = $this->createContext();
        $result = $this->createResult();

        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient->expects(self::once())
            ->method('get')
            ->with(self::URL)
            ->willReturn($response);

        $factory = $this->createMock(DetectionContextFactory::class);
        $factory->expects(self::once())
            ->method('create')
            ->willReturn($context);

        $manager = $this->createMock(DetectionManager::class);
        $manager->expects(self::once())
            ->method('detect')
            ->willReturn($result);

        $actual = $this->createDetector($httpClient, $manager, $factory)->detect(self::URL);

        self::assertSame($result, $actual);
    }

    public function test_detect_returns_detection_result_instance(): void
    {
        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient->expects(self::once())
            ->method('get')
            ->with(self::URL)
            ->willReturn($this->createResponse());

        $factory = $this->createMock(DetectionContextFactory::class);
        $factory->expects(self::once())
            ->method('create')
            ->willReturn($this->createContext());

        $manager = $this->createMock(DetectionManager::class);
        $manager->expects(self::once())
            ->method('detect')
            ->willReturn($this->createResult());

        $actual = $this->createDetector($httpClient, $manager, $factory)->detect(self::URL);

        self::assertInstanceOf(DetectionResult::class, $actual);
    }

    public function test_detect_is_stateless(): void
    {
        $response = $this->createResponse();
        $context = $this->createContext();
        $result = $this->createResult();

        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient->expects(self::exactly(2))
            ->method('get')
            ->with(self::URL)
            ->willReturn($response);

        $factory = $this->createMock(DetectionContextFactory::class);
        $factory->expects(self::exactly(2))
            ->method('create')
            ->with($this->identicalTo($response))
            ->willReturn($context);

        $manager = $this->createMock(DetectionManager::class);
        $manager->expects(self::exactly(2))
            ->method('detect')
            ->with($this->identicalTo($context))
            ->willReturn($result);

        $detector = $this->createDetector($httpClient, $manager, $factory);

        self::assertSame($result, $detector->detect(self::URL));
        self::assertSame($result, $detector->detect(self::URL));
    }
}
