<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Request;
use App\Services\WebsiteReport;
use App\Services\WebsiteReportAnalyzer;

/**
 * Runs the Detection Report workflow and renders the report page.
 *
 * ReportController is the POST endpoint of the Detection Report MVP. It
 * reads the submitted URL from the request, delegates the complete
 * analysis to the WebsiteReportAnalyzer, and renders the report view
 * with the resulting WebsiteReport.
 *
 * The report view always renders — including for invalid URLs and
 * unreachable websites — because the WebsiteReport carries a user-facing
 * error message for those cases. This keeps the workflow free of redirects
 * and session state while remaining accessible.
 *
 * Design philosophy:
 *
 * - Orchestrator: it reads the input, delegates to the analyzer, and
 *   renders the result. It contains no detection or business logic.
 * - Dependency Injection: the analyzer is provided through the
 *   constructor.
 * - Single Responsibility Principle: accepting the URL submission and
 *   rendering the report is its only concern.
 * - Stateless: the controller holds no request or session state.
 */
final class ReportController
{
    public function __construct(
        private WebsiteReportAnalyzer $analyzer,
    ) {
    }

    public function __invoke(): string
    {
        $url = $this->urlFromRequest();

        $report = $this->analyzer->analyze($url);

        return view('report', [
            'url' => $url,
            'report' => $report,
        ]);
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

            return is_string($url) ? $url : '';
        }

        $url = Request::fromGlobals()->input('url', '');

        return is_string($url) ? $url : '';
    }
}
