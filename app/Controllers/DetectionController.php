<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Request;
use App\Services\DetectionService;

/**
 * Accepts detection submissions and renders the Detection Report page.
 *
 * DetectionController is the POST endpoint of the Detection Report
 * integration. It reads the submitted URL from the request, delegates the
 * complete analysis to the DetectionService, and renders the report view
 * with the resulting DetectionReportViewModel.
 *
 * The report view always renders — including for invalid URLs and
 * unreachable websites — because the view model carries a user-facing
 * error message for those cases. This keeps the workflow free of redirects
 * and session state while remaining accessible.
 *
 * Design philosophy:
 *
 * - Orchestrator: it reads the input, delegates to the service, and
 *   renders the result. It contains no detection or business logic.
 * - Dependency Injection: the service is provided through the constructor.
 * - Single Responsibility Principle: accepting the URL submission and
 *   rendering the report is its only concern.
 * - Stateless: the controller holds no request or session state.
 */
final class DetectionController
{
    public function __construct(
        private DetectionService $service,
    ) {
    }

    public function __invoke(): string
    {
        $url = $this->urlFromRequest();

        $report = $this->service->detect($url);

        return view('report', [
            'report' => $report,
            'pageTitle' => 'Detection Report',
            'pageDescription' => $url !== '' ? 'Detection report for ' . $url . '.' : 'Website detection report.',
            'activeNav' => 'home',
        ], 'layouts.app');
    }

    /**
     * Read the submitted URL from the current request.
     *
     * Prefers the Request registered in the container (set by the HTTP
     * entry point) and falls back to rebuilding the request from the
     * globals for CLI contexts.
     *
     * @return string The submitted URL, or an empty string when absent.
     */
    private function urlFromRequest(): string
    {
        $container = app();

        if ($container->has(Request::class)) {
            $url = $container->get(Request::class)->input('url', '');

            return is_string($url) ? trim($url) : '';
        }

        $url = Request::fromGlobals()->input('url', '');

        return is_string($url) ? trim($url) : '';
    }
}
