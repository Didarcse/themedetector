<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\WordPress;

use App\Modules\Http\HttpClientInterface;
use App\Modules\Http\HttpException;
use App\Modules\Http\HttpResponse;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssDownloader;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the WordPressStyleCssDownloader.
 *
 * Verifies the complete public contract of the downloader: a successful
 * HTTP 200 response yields the response body, non-200 responses yield
 * null, transport exceptions are converted into null, the supplied URL is
 * passed to the HTTP client exactly once per call, and repeated calls are
 * deterministic.
 *
 * The tests are behaviour-driven and use mocks only for the
 * HttpClientInterface collaborator; the real WordPressStyleCssDownloader
 * is exercised, and no real HTTP request is ever performed.
 */
final class WordPressStyleCssDownloaderTest extends TestCase
{
    private const URL = 'https://example.com/wp-content/themes/twentytwentyfive/style.css';

    /**
     * Create a downloader backed by the given HTTP client.
     *
     * @param HttpClientInterface $client The HTTP client collaborator.
     *
     * @return WordPressStyleCssDownloader The downloader under test.
     */
    private function downloader(HttpClientInterface $client): WordPressStyleCssDownloader
    {
        return new WordPressStyleCssDownloader($client);
    }

    /**
     * Create an immutable HTTP response for the given status and body.
     *
     * @param int    $statusCode The HTTP status code.
     * @param string $body       The response body.
     *
     * @return HttpResponse The HTTP response.
     */
    private function response(int $statusCode, string $body = 'body'): HttpResponse
    {
        return new HttpResponse(
            originalUrl: self::URL,
            finalUrl: self::URL,
            statusCode: $statusCode,
            headers: [],
            body: $body,
        );
    }

    public function test_returns_response_body_for_http_200(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->method('get')->willReturn($this->response(200, '/* CSS */'));

        $result = $this->downloader($client)->download(self::URL);

        self::assertSame('/* CSS */', $result);
    }

    public function test_returns_null_for_http_404(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->method('get')->willReturn($this->response(404));

        $result = $this->downloader($client)->download(self::URL);

        self::assertNull($result);
    }

    public function test_returns_null_for_http_500(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->method('get')->willReturn($this->response(500));

        $result = $this->downloader($client)->download(self::URL);

        self::assertNull($result);
    }

    public function test_returns_null_when_http_client_throws_http_exception(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->method('get')->willThrowException(new HttpException('cURL error: connection refused'));

        $result = $this->downloader($client)->download(self::URL);

        self::assertNull($result);
    }

    public function test_passes_url_to_http_client(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects(self::once())
            ->method('get')
            ->with(self::URL)
            ->willReturn($this->response(200));

        $this->downloader($client)->download(self::URL);
    }

    public function test_performs_exactly_one_http_request(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects(self::once())
            ->method('get')
            ->willReturn($this->response(200));

        $this->downloader($client)->download(self::URL);
    }

    public function test_download_is_deterministic(): void
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->method('get')->willReturn($this->response(200, '/* CSS */'));

        $downloader = $this->downloader($client);

        $first = $downloader->download(self::URL);
        $second = $downloader->download(self::URL);

        self::assertSame($first, $second);
    }
}
