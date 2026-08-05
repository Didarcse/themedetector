<?php

declare(strict_types=1);

namespace App\Modules\Detection\WordPress\Rules;

use App\Modules\Http\HttpClient;
use App\Modules\Http\HttpException;

/**
 * Detects WordPress by querying the /wp-json/ REST API endpoint.
 *
 * Builds the endpoint URL from the supplied website URL, downloads the
 * response via HttpClient, validates it is a genuine WordPress REST API
 * by checking for the presence of "namespaces" or "routes", and extracts
 * optional site metadata.
 */
final class WPJsonRule implements RuleInterface
{
    public function __construct(
        private readonly HttpClient $httpClient,
    ) {
    }

    /**
     * Evaluate the target by querying the WordPress REST API.
     *
     * @param string $html The complete HTML source of the target website.
     * @param string $url  The original website URL.
     *
     * @return array{
     *     matched: bool,
     *     confidence: int,
     *     metadata: array<string, mixed>
     * }
     */
    public function evaluate(string $html, string $url): array
    {
        $restApiUrl = $this->buildRestApiUrl($url);

        $body = $this->fetchEndpoint($restApiUrl);

        if ($body === null) {
            return $this->noMatch();
        }

        $data = json_decode($body, true);

        if (!is_array($data)) {
            return $this->noMatch();
        }

        if (!isset($data['namespaces']) && !isset($data['routes'])) {
            return $this->noMatch();
        }

        return [
            'matched' => true,
            'confidence' => 40,
            'metadata' => $this->extractMetadata($data, $restApiUrl),
        ];
    }

    private function buildRestApiUrl(string $url): string
    {
        $parts = parse_url($url);

        $scheme = $parts['scheme'] ?? 'https';
        $host = $parts['host'] ?? '';
        $path = isset($parts['path']) ? rtrim($parts['path'], '/') : '';

        return $scheme . '://' . $host . $path . '/wp-json/';
    }

    private function fetchEndpoint(string $url): ?string
    {
        try {
            $response = $this->httpClient->get($url);

            if ($response->statusCode() < 200 || $response->statusCode() >= 300) {
                return null;
            }

            return $response->body();
        } catch (HttpException) {
            return null;
        }
    }

    /**
     * @param array<mixed> $data
     *
     * @return array<string, mixed>
     */
    private function extractMetadata(array $data, string $restApiUrl): array
    {
        $metadata = [
            'rest_api_url' => $restApiUrl,
        ];

        if (isset($data['name']) && (is_string($data['name']) || is_numeric($data['name']))) {
            $metadata['site_name'] = (string) $data['name'];
        }

        if (isset($data['description']) && is_string($data['description'])) {
            $metadata['description'] = $data['description'];
        }

        if (isset($data['url']) && is_string($data['url'])) {
            $metadata['site_url'] = $data['url'];
        }

        if (isset($data['home']) && is_string($data['home'])) {
            $metadata['home'] = $data['home'];
        }

        if (isset($data['gmt_offset']) && (is_string($data['gmt_offset']) || is_int($data['gmt_offset']) || is_float($data['gmt_offset']))) {
            $metadata['gmt_offset'] = $data['gmt_offset'];
        }

        return $metadata;
    }

    /**
     * @return array{matched: false, confidence: 0, metadata: array<string, mixed>}
     */
    private function noMatch(): array
    {
        return [
            'matched' => false,
            'confidence' => 0,
            'metadata' => [],
        ];
    }
}
