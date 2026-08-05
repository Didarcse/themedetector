<?php

declare(strict_types=1);

namespace Tests\Unit\Http;

use App\Modules\Http\Curl\CurlAdapterInterface;
use App\Modules\Http\Curl\CurlResponse;
use App\Modules\Http\CurlHttpClient;
use App\Modules\Http\Exceptions\HttpClientException;
use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the CurlHttpClient orchestration layer.
 *
 * Verifies that CurlHttpClient correctly orchestrates the HTTP transport
 * layer by collaborating with a mocked CurlAdapterInterface. The tests
 * are behaviour-driven and mock-based only: they never call curl_*(),
 * never use file://, never touch the network, and never inspect private
 * implementation details.
 */
final class CurlHttpClientTest extends TestCase
{
    private const URL = 'https://example.com';
    private const TIMEOUT = 15;
    private const USER_AGENT = 'ThemeDetectorTool/2.0';

    /**
     * Create a mock CurlAdapterInterface.
     *
     * @return CurlAdapterInterface&MockObject
     */
    private function createAdapter(): CurlAdapterInterface&MockObject
    {
        return $this->createMock(CurlAdapterInterface::class);
    }

    /**
     * Create a CurlResponse representing a raw transport exchange.
     */
    private function createCurlResponse(): CurlResponse
    {
        return new CurlResponse(
            originalUrl: self::URL,
            finalUrl: self::URL,
            statusCode: 200,
            rawHeaders: "HTTP/2 200 OK\r\n"
                . "Content-Type: text/html\r\n"
                . "Cache-Control: no-cache\r\n"
                . "Set-Cookie: first\r\n"
                . "Set-Cookie: second\r\n",
            body: '<html>Example</html>',
        );
    }

    /**
     * Create a CurlHttpClient backed by the given adapter.
     */
    private function makeClient(CurlAdapterInterface $adapter): CurlHttpClient
    {
        return new CurlHttpClient($adapter, self::TIMEOUT, self::USER_AGENT);
    }

    public function test_implements_http_client_interface(): void
    {
        self::assertInstanceOf(HttpClientInterface::class, $this->makeClient($this->createAdapter()));
    }

    public function test_throws_exception_for_invalid_url(): void
    {
        $adapter = $this->createAdapter();
        $adapter->expects(self::never())->method('execute');

        $this->expectException(HttpClientException::class);
        $this->expectExceptionMessage('Invalid URL.');

        $this->makeClient($adapter)->get('invalid-url');
    }

    public function test_delegates_request_to_adapter(): void
    {
        $adapter = $this->createAdapter();
        $adapter->expects(self::once())
            ->method('execute')
            ->with(self::URL, self::TIMEOUT, self::USER_AGENT)
            ->willReturn($this->createCurlResponse());

        $this->makeClient($adapter)->get(self::URL);
    }

    public function test_returns_http_response(): void
    {
        $adapter = $this->createAdapter();
        $adapter->method('execute')->willReturn($this->createCurlResponse());

        $response = $this->makeClient($adapter)->get(self::URL);

        self::assertInstanceOf(HttpResponse::class, $response);
    }

    public function test_copies_original_url(): void
    {
        $adapter = $this->createAdapter();
        $adapter->method('execute')->willReturn($this->createCurlResponse());

        $response = $this->makeClient($adapter)->get(self::URL);

        self::assertSame(self::URL, $response->originalUrl());
    }

    public function test_copies_final_url(): void
    {
        $adapter = $this->createAdapter();
        $adapter->method('execute')->willReturn($this->createCurlResponse());

        $response = $this->makeClient($adapter)->get(self::URL);

        self::assertSame(self::URL, $response->finalUrl());
    }

    public function test_copies_status_code(): void
    {
        $adapter = $this->createAdapter();
        $adapter->method('execute')->willReturn($this->createCurlResponse());

        $response = $this->makeClient($adapter)->get(self::URL);

        self::assertSame(200, $response->statusCode());
    }

    public function test_copies_body(): void
    {
        $adapter = $this->createAdapter();
        $adapter->method('execute')->willReturn($this->createCurlResponse());

        $response = $this->makeClient($adapter)->get(self::URL);

        self::assertSame('<html>Example</html>', $response->body());
    }

    public function test_parses_headers(): void
    {
        $adapter = $this->createAdapter();
        $adapter->method('execute')->willReturn($this->createCurlResponse());

        $response = $this->makeClient($adapter)->get(self::URL);

        self::assertSame(['text/html'], $response->headers()['Content-Type']);
        self::assertSame(['no-cache'], $response->headers()['Cache-Control']);
    }

    public function test_preserves_duplicate_headers(): void
    {
        $adapter = $this->createAdapter();
        $adapter->method('execute')->willReturn($this->createCurlResponse());

        $response = $this->makeClient($adapter)->get(self::URL);

        self::assertSame(['first', 'second'], $response->headers()['Set-Cookie']);
    }

    public function test_propagates_adapter_exception(): void
    {
        $exception = new HttpClientException('cURL error: connection refused');

        $adapter = $this->createAdapter();
        $adapter->method('execute')->willThrowException($exception);

        $this->expectException(HttpClientException::class);
        $this->expectExceptionMessage('cURL error: connection refused');

        $this->makeClient($adapter)->get(self::URL);
    }
}
