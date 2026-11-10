<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Api\RateLimitResult;
use App\Api\RateLimiter;
use App\Core\Request;
use App\Core\Response;
use App\Domain\DetectionReport\DetectionError;
use App\Domain\DetectionReport\DetectionReport;
use App\Domain\DetectionReport\WebsiteInformation;
use App\Security\CsrfGuard;
use App\Services\DetectionService;
use App\ViewModels\DetectionReportViewModel;

/**
 * Accepts detection submissions and renders the Detection Report page.
 *
 * DetectionController is the POST endpoint of the Detection Report
 * integration. It resolves the client IP through the trusted REMOTE_ADDR
 * only, consumes one web rate-limit token, and — when still allowed —
 * delegates the complete analysis to the DetectionService and renders the
 * report view with the resulting DetectionReportViewModel.
 *
 * A rate-limited request never reaches the DetectionService: it receives
 * a 429 response carrying Retry-After and renders the same report view
 * with a user-facing rate-limit error.
 *
 * The report view always renders — including for invalid URLs and
 * unreachable websites — because the view model carries a user-facing
 * error message for those cases. This keeps the workflow free of redirects
 * and session state while remaining accessible.
 *
 * Design philosophy:
 *
 * - Orchestrator: it reads the input, enforces the rate-limit boundary, and
 *   renders the result. It contains no detection or business logic.
 * - Dependency Injection: the service and the rate limiter are provided
 *   through the constructor.
 * - Single Responsibility Principle: accepting the URL submission,
 *   enforcing the per-IP budget, and rendering the report is its only
 *   concern.
 * - Stateless: the controller holds no request or session state.
 */
final class DetectionController
{
    /**
     * Fallback identity when REMOTE_ADDR is absent, so a malformed server
     * environment still produces a deterministic identifier and never
     * throws.
     */
    private const FALLBACK_IP = 'unknown';

    public function __construct(
        private readonly DetectionService $service,
        private readonly RateLimiter $webRateLimiter,
        private readonly CsrfGuard $csrf,
    ) {
    }

    public function __invoke(): Response
    {
        $request = $this->currentRequest();

        $rejection = $this->csrf->reject($request);

        if ($rejection !== null) {
            return $rejection;
        }

        $url = $this->urlFromRequest($request);

        $rate = $this->webRateLimiter->consume($this->clientIp($request));

        if (!$rate->allowed()) {
            return $this->rateLimitResponse($url, $rate);
        }

        $report = $this->service->detect($url);

        return Response::html(view('report', [
            'report' => $report,
            'pageTitle' => 'Detection Report',
            'pageDescription' => $url !== '' ? 'Detection report for ' . $url . '.' : 'Website detection report.',
            'robots' => 'noindex, nofollow',
            'activeNav' => 'home',
        ], 'layouts.app'));
    }

    /**
     * Render the report page as a 429 rate-limit response.
     *
     * The same report view and error rendering used for invalid URLs and
     * unreachable websites is reused, so the limited user never sees a
     * broken frame. Detection is intentionally NOT executed.
     *
     * @param string         $url  The submitted URL for page repopulation.
     * @param RateLimitResult $rate The rate-limit outcome.
     *
     * @return Response The 429 response with a Retry-After header.
     */
    private function rateLimitResponse(string $url, RateLimitResult $rate): Response
    {
        $message = 'Too many requests. Please wait a moment before trying again.';

        $report = new DetectionReport(
            websiteInformation: new WebsiteInformation(url: '', finalUrl: '', statusCode: 0),
            errors: [
                new DetectionError(
                    code: 'rate_limited',
                    message: $message,
                    source: self::class,
                ),
            ],
        );

        $model = DetectionReportViewModel::fromReport($report, $url);

        return Response::html(
            view('report', [
                'report' => $model,
                'pageTitle' => 'Too Many Requests',
                'pageDescription' => $message,
                'robots' => 'noindex, nofollow',
                'activeNav' => 'home',
            ], 'layouts.app'),
            429,
            ['Retry-After' => (string) $rate->retryAfterSeconds()],
        );
    }

    /**
     * Resolve the current request from the container.
     *
     * Prefers the Request registered in the container (set by the HTTP
     * entry point) and falls back to rebuilding the request from the
     * globals for CLI contexts.
     *
     * @return Request The current request.
     */
    private function currentRequest(): Request
    {
        $container = app();

        if ($container->has(Request::class)) {
            return $container->get(Request::class);
        }

        return Request::fromGlobals();
    }

    /**
     * Read the submitted URL from the current request.
     *
     * @param Request $request The current request.
     *
     * @return string The submitted URL, or an empty string when absent.
     */
    private function urlFromRequest(Request $request): string
    {
        $url = $request->input('url', '');

        return is_string($url) ? trim($url) : '';
    }

    /**
     * Resolve the client IP for the web rate limit.
     *
     * Only REMOTE_ADDR is trusted; forwarded headers are ignored so a
     * client cannot spoof its identity. A missing or non-string value maps
     * to the deterministic FALLBACK_IP so the limiter always receives a
     * valid identifier.
     *
     * @param Request $request The current request.
     *
     * @return string The client IP, or the fallback identifier.
     */
    private function clientIp(Request $request): string
    {
        $ip = $request->server()['REMOTE_ADDR'] ?? null;

        return is_string($ip) && $ip !== '' ? $ip : self::FALLBACK_IP;
    }
}
