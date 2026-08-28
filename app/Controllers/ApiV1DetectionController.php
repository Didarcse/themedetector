<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Api\AnalysisCache;
use App\Api\ApiClientIdentity;
use App\Api\ApiDetectionResponsePresenter;
use App\Api\ApiKeyStore;
use App\Api\ApiRequestValidator;
use App\Api\RateLimitResult;
use App\Api\RateLimiter;
use App\Api\WorkloadGuard;
use App\Core\Request;
use App\Core\Response;
use App\Services\WebsiteReportAnalyzer;

/**
 * Public API endpoint for website detection.
 *
 * ApiV1DetectionController is the thin request boundary for
 * POST /api/v1/detect. It performs content-type, authentication, and
 * schema validation, enforces the rate limit and the workload guard, and
 * then delegates the actual analysis to the existing WebsiteReportAnalyzer
 * — the exact same pipeline the web /detect page uses. The result is
 * mapped onto the public JSON contract by the response presenter.
 *
 * Design philosophy:
 *
 * - Thin boundary: it contains no detection, extraction, or business
 *   logic; everything is delegated to existing services.
 * - Same pipeline: it reuses WebsiteReportAnalyzer, so the API inherits
 *   the Sprint 49 SSRF protection with no second HTTP client.
 * - Boundary concerns stay in the boundary: validation, authentication,
 *   rate limiting, caching, and presentation.
 * - Stateless: the controller holds no request or session state.
 */
final class ApiV1DetectionController
{
    /**
     * Create the API endpoint controller.
     *
     * @param ApiKeyStore                   $apiKeys           The accepted
     *                                                          API keys.
     * @param ApiRequestValidator           $validator         The strict
     *                                                          request schema
     *                                                          validator.
     * @param WebsiteReportAnalyzer         $analyzer          The existing
     *                                                          detection
     *                                                          analyzer.
     * @param ApiDetectionResponsePresenter $presenter         The response
     *                                                          presenter.
     * @param AnalysisCache                 $cache             The response
     *                                                          cache.
     * @param RateLimiter                   $anonymousLimiter  The per-IP
     *                                                          limiter.
     * @param RateLimiter                   $keyedLimiter      The per-key
     *                                                          limiter.
     * @param WorkloadGuard                 $guard             The concurrency
     *                                                          guard.
     */
    public function __construct(
        private ApiKeyStore $apiKeys,
        private ApiRequestValidator $validator,
        private WebsiteReportAnalyzer $analyzer,
        private ApiDetectionResponsePresenter $presenter,
        private AnalysisCache $cache,
        private RateLimiter $anonymousLimiter,
        private RateLimiter $keyedLimiter,
        private WorkloadGuard $guard,
    ) {
    }

    public function __invoke(): Response
    {
        $request = app()->get(Request::class);

        $requestId = bin2hex(random_bytes(16));

        if (!$this->hasJsonContentType($request)) {
            return $this->json(
                $this->presenter->error(
                    'unsupported_media_type',
                    'Content-Type must be application/json.',
                    $requestId,
                ),
                415,
            );
        }

        if ($request->bodyExceedsLimit()) {
            return $this->json(
                $this->presenter->error(
                    'payload_too_large',
                    'The request body exceeds the maximum allowed size.',
                    $requestId,
                ),
                413,
            );
        }

        $payload = json_decode($request->body(), true);

        if ($payload === null && trim($request->body()) !== 'null') {
            return $this->json(
                $this->presenter->error(
                    'invalid_json',
                    'The request body is not valid JSON.',
                    $requestId,
                ),
                400,
            );
        }

        $authentication = $this->authenticate($request, $requestId);

        if ($authentication instanceof Response) {
            return $authentication;
        }

        $validation = $this->validator->validate($payload);

        if (!$validation->valid()) {
            return $this->json($this->presenter->errors($validation->errors(), $requestId), 422);
        }

        $url = $validation->url();
        $limiter = $authentication->isKeyed() ? $this->keyedLimiter : $this->anonymousLimiter;
        $rate = $limiter->consume($authentication->identifier());

        if (!$rate->allowed()) {
            return $this->json(
                $this->presenter->error(
                    'rate_limited',
                    'Rate limit exceeded. Try again later.',
                    $requestId,
                ),
                429,
                $this->rateLimitHeaders($rate),
            );
        }

        if (!$this->guard->acquire()) {
            return $this->json(
                $this->presenter->error(
                    'rate_limited',
                    'The server is busy. Try again later.',
                    $requestId,
                ),
                429,
            );
        }

        try {
            $cached = $this->cache->get($url);

            if ($cached !== null) {
                return $this->json($this->presenter->success($cached, $requestId), 200, $this->rateLimitHeaders($rate));
            }

            $report = $this->analyzer->analyze($url);

            if ($report->hasError()) {
                return $this->json($this->presenter->present($report, $requestId), 200, $this->rateLimitHeaders($rate));
            }

            $data = $this->presenter->data($report);
            $this->cache->set($url, $data);

            return $this->json($this->presenter->success($data, $requestId), 200, $this->rateLimitHeaders($rate));
        } finally {
            $this->guard->release();
        }
    }

    /**
     * Authenticate the request and resolve its rate-limit identity.
     *
     * A missing Authorization header is treated as an anonymous client.
     * When API keys are configured, anonymous requests are rejected with
     * 401. A present but invalid Bearer key is always rejected with 401.
     * The key is never read from the query string and never logged.
     *
     * @param Request $request   The current request.
     * @param string  $requestId The request identifier.
     *
     * @return ApiClientIdentity|Response The identity, or a 401 response.
     */
    private function authenticate(Request $request, string $requestId): ApiClientIdentity|Response
    {
        $authorization = trim($this->serverString($request, 'HTTP_AUTHORIZATION'));

        if ($authorization === '') {
            if ($this->apiKeys->hasKeys()) {
                return $this->json(
                    $this->presenter->error(
                        'unauthorized',
                        'A valid API key is required.',
                        $requestId,
                    ),
                    401,
                );
            }

            return new ApiClientIdentity(ApiClientIdentity::TIER_ANONYMOUS, $this->clientIp($request));
        }

        if (preg_match('#^Bearer\s+(\S+)$#i', $authorization, $matches) !== 1) {
            return $this->json(
                $this->presenter->error(
                    'unauthorized',
                    'The Authorization header must use the Bearer scheme.',
                    $requestId,
                ),
                401,
            );
        }

        $key = $matches[1];

        if (!$this->apiKeys->validate($key)) {
            return $this->json(
                $this->presenter->error(
                    'unauthorized',
                    'Invalid API key.',
                    $requestId,
                ),
                401,
            );
        }

        return new ApiClientIdentity(ApiClientIdentity::TIER_KEYED, $key);
    }

    /**
     * Resolve the client IP for anonymous rate limiting.
     *
     * Only REMOTE_ADDR is trusted; forwarded headers are ignored so a
     * client cannot spoof its identity.
     *
     * @param Request $request The current request.
     *
     * @return string The client IP, or "unknown".
     */
    private function clientIp(Request $request): string
    {
        $ip = $request->server()['REMOTE_ADDR'] ?? null;

        return is_string($ip) && $ip !== '' ? $ip : 'unknown';
    }

    /**
     * Build the standard rate-limit response headers.
     *
     * @param RateLimitResult $rate The rate-limit outcome.
     *
     * @return array<string, string> The headers.
     */
    private function rateLimitHeaders(RateLimitResult $rate): array
    {
        $headers = [
            'X-RateLimit-Limit' => (string) $rate->limit(),
            'X-RateLimit-Remaining' => (string) $rate->remaining(),
        ];

        if (!$rate->allowed()) {
            $headers['Retry-After'] = (string) $rate->retryAfterSeconds();
        }

        return $headers;
    }

    /**
     * Return whether the request declares an application/json content type.
     *
     * @param Request $request The current request.
     *
     * @return bool True when the media type is application/json.
     */
    private function hasJsonContentType(Request $request): bool
    {
        $contentType = strtolower(trim($this->serverString($request, 'HTTP_CONTENT_TYPE')));
        $mediaType = trim(explode(';', $contentType)[0]);

        return $mediaType === 'application/json';
    }

    /**
     * Read a server value as a string.
     *
     * Server values may be any type; anything that is not a string is
     * treated as absent so callers always receive a string.
     *
     * @param Request $request The current request.
     * @param string  $name    The server key.
     *
     * @return string The value, or "" when absent or not a string.
     */
    private function serverString(Request $request, string $name): string
    {
        $value = $request->server()[$name] ?? '';

        return is_string($value) ? $value : '';
    }

    /**
     * Build a JSON response with optional extra headers.
     *
     * @param array<string, mixed> $payload The JSON payload.
     * @param int                  $status  The HTTP status code.
     * @param array<string, string> $headers The extra response headers.
     *
     * @return Response The JSON response.
     */
    private function json(array $payload, int $status, array $headers = []): Response
    {
        return new Response(
            json_encode($payload, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE),
            $status,
            array_merge(['Content-Type' => 'application/json; charset=UTF-8'], $headers),
        );
    }
}
