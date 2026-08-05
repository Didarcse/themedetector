<?php

declare(strict_types=1);

namespace App\Modules\Detection\WordPress\Rules;

use App\Modules\Http\HttpClient;
use App\Modules\Http\HttpException;

/**
 * Detects WordPress by verifying the existence of the xmlrpc.php endpoint.
 *
 * Builds the xmlrpc.php URL from the supplied website URL, performs a GET
 * request, and checks the response body for the presence of both "XML-RPC"
 * and "POST" (case-insensitive), which indicates a valid WordPress
 * xmlrpc.php endpoint.
 */
final class XmlRpcRule implements RuleInterface
{
    public function __construct(
        private readonly HttpClient $httpClient,
    ) {
    }

    /**
     * Evaluate the target by probing xmlrpc.php.
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
        $xmlrpcUrl = $this->buildXmlRpcUrl($url);

        $body = $this->fetchEndpoint($xmlrpcUrl);

        if ($body === null) {
            return $this->noMatch();
        }

        $lower = strtolower($body);

        if (!str_contains($lower, 'xml-rpc') || !str_contains($lower, 'post')) {
            return $this->noMatch();
        }

        return [
            'matched' => true,
            'confidence' => 25,
            'metadata' => [
                'xmlrpc_url' => $xmlrpcUrl,
            ],
        ];
    }

    private function buildXmlRpcUrl(string $url): string
    {
        $parts = parse_url($url);

        $scheme = $parts['scheme'] ?? 'https';
        $host = $parts['host'] ?? '';
        $path = isset($parts['path']) ? rtrim($parts['path'], '/') : '';

        return $scheme . '://' . $host . $path . '/xmlrpc.php';
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
