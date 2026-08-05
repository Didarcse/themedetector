<?php

declare(strict_types=1);

namespace App\Modules\Detection\Shopify\Rules;

use App\Modules\Http\HttpClient;
use App\Modules\Http\HttpException;
use App\Modules\Http\HttpResponse;
use JsonException;

/**
 * Detects Shopify by verifying the official /cart.js endpoint.
 *
 * Builds the cart.js URL from the supplied website URL, performs a GET
 * request, validates the JSON response contains expected Shopify cart
 * fields with a weighted scoring model, and returns a matched result
 * when the minimum score threshold is met.
 */
final class CartEndpointRule implements RuleInterface
{
    private const CONFIDENCE = 40;

    private const ENDPOINT = '/cart.js';

    private const FIELD_WEIGHTS = [
        'token' => 3,
        'items' => 3,
        'item_count' => 2,
        'total_price' => 2,
        'currency' => 1,
    ];

    private const MIN_SCORE = 5;

    public function __construct(
        private readonly HttpClient $httpClient,
    ) {
    }

    /**
     * Evaluate the target by querying the Shopify cart endpoint.
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
        $endpoint = $this->buildCartUrl($url);

        $response = $this->fetchCart($endpoint);

        if ($response === null) {
            return $this->noMatch();
        }

        try {
            $payload = json_decode(
                json: $response->body(),
                associative: true,
                flags: JSON_THROW_ON_ERROR,
            );
        } catch (JsonException) {
            return $this->noMatch();
        }

        if (!is_array($payload)) {
            return $this->noMatch();
        }

        if (!$this->isValidCartResponse($payload)) {
            return $this->noMatch();
        }

        return [
            'matched' => true,
            'confidence' => self::CONFIDENCE,
            'metadata' => [
                'cart_endpoint' => true,
                'cart_url' => $endpoint,
            ],
        ];
    }

    /**
     * Build the /cart.js URL using only the scheme, host, and optional
     * port from the supplied URL.  Any existing path, query, or fragment
     * is ignored.
     */
    private function buildCartUrl(string $url): string
    {
        $parts = parse_url($url);

        $scheme = $parts['scheme'] ?? 'https';
        $host = $parts['host'] ?? '';
        $port = isset($parts['port']) ? ':' . $parts['port'] : '';

        return $scheme . '://' . $host . $port . self::ENDPOINT;
    }

    private function fetchCart(string $url): ?HttpResponse
    {
        try {
            $response = $this->httpClient->get($url);
        } catch (HttpException) {
            return null;
        }

        if ($response->statusCode() !== 200) {
            return null;
        }

        $contentType = $this->findHeader($response->headers(), 'Content-Type');

        if ($contentType === null) {
            return null;
        }

        if (!str_contains(strtolower($contentType), 'application/json')) {
            return null;
        }

        return $response;
    }

    /**
     * Return the first value for a header name, case-insensitively.
     *
     * @param array<string, list<string>> $headers
     */
    private function findHeader(array $headers, string $name): ?string
    {
        $lowerName = strtolower($name);

        foreach ($headers as $key => $values) {
            if (strtolower($key) !== $lowerName) {
                continue;
            }

            if ($values === []) {
                return null;
            }

            return $values[0];
        }

        return null;
    }

    /**
     * Validate the decoded payload using a weighted scoring model.
     *
     * A total score of at least 5 (out of 11) is required for a valid
     * Shopify cart response.
     *
     * @param array<mixed> $payload
     */
    private function isValidCartResponse(array $payload): bool
    {
        $score = 0;

        foreach (self::FIELD_WEIGHTS as $field => $weight) {
            if (array_key_exists($field, $payload)) {
                $score += $weight;
            }
        }

        return $score >= self::MIN_SCORE;
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
