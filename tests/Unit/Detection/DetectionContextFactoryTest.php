<?php

declare(strict_types=1);

namespace Tests\Unit\Detection;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionContextFactory;
use App\Modules\Http\HttpResponse;
use PHPUnit\Framework\TestCase;

final class DetectionContextFactoryTest extends TestCase
{
    private function createResponse(): HttpResponse
    {
        return new HttpResponse(
            originalUrl: 'https://example.com',
            finalUrl: 'https://example.com',
            statusCode: 200,
            headers: [
                'Content-Type' => ['text/html'],
            ],
            body: '<html><body>Hello</body></html>',
        );
    }

    public function test_creates_detection_context(): void
    {
        $context = (new DetectionContextFactory())->create($this->createResponse());

        self::assertInstanceOf(DetectionContext::class, $context);
    }

    public function test_preserves_original_url(): void
    {
        $context = (new DetectionContextFactory())->create($this->createResponse());

        self::assertSame('https://example.com', $context->originalUrl());
    }

    public function test_preserves_final_url(): void
    {
        $context = (new DetectionContextFactory())->create($this->createResponse());

        self::assertSame('https://example.com', $context->finalUrl());
    }

    public function test_preserves_html(): void
    {
        $context = (new DetectionContextFactory())->create($this->createResponse());

        self::assertSame('<html><body>Hello</body></html>', $context->html());
    }

    public function test_preserves_status_code(): void
    {
        $context = (new DetectionContextFactory())->create($this->createResponse());

        self::assertSame(200, $context->statusCode());
    }

    public function test_returns_new_instance_every_time(): void
    {
        $factory = new DetectionContextFactory();
        $response = $this->createResponse();

        $first = $factory->create($response);
        $second = $factory->create($response);

        self::assertNotSame($first, $second);
    }

    public function test_factory_is_stateless(): void
    {
        $factory = new DetectionContextFactory();
        $response = $this->createResponse();

        $first = $factory->create($response);
        $second = $factory->create($response);

        self::assertSame($first->originalUrl(), $second->originalUrl());
        self::assertSame($first->finalUrl(), $second->finalUrl());
        self::assertSame($first->html(), $second->html());
        self::assertSame($first->statusCode(), $second->statusCode());
    }
}
