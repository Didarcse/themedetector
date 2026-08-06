<?php

declare(strict_types=1);

namespace App\Services;

use App\ViewModels\DetectionReportViewModel;

/**
 * Orchestrates the Detection Report workflow.
 *
 * DetectionService is the application-layer entry point for the Detection
 * Report integration. It validates and analyses the submitted URL through
 * the existing WebsiteReportAnalyzer — which normalizes and validates the
 * URL and runs the Detection, Theme Extraction, and Plugin Detection
 * engines — and then builds the immutable DetectionReportViewModel handed
 * to the report view.
 *
 * Responsibilities:
 *
 * - Orchestrate the detection report workflow.
 * - Validate the submitted URL through the existing analyzer.
 * - Execute the detection engines through the existing analyzer.
 * - Build the DetectionReportViewModel from the analysis result.
 *
 * Design philosophy:
 *
 * - Orchestrator: it wires the workflow steps together and nothing more.
 * - Facade: it is the single public entry point for the report page.
 * - Dependency Injection: every collaborator is provided through the
 *   constructor.
 * - Single Responsibility Principle: orchestration and presentation
 *   mapping only; it contains no detection, extraction, or business rules.
 * - Open/Closed Principle: the workflow grows by changing the underlying
 *   analyzer, never by modifying this service.
 * - Stateless, deterministic, and side-effect free except for the HTTP
 *   request delegated to the analyzer.
 */
final readonly class DetectionService
{
    /**
     * Create a new DetectionService.
     *
     * @param WebsiteReportAnalyzer $analyzer The analyzer that normalizes,
     *                                        validates, and analyses the
     *                                        submitted website.
     */
    public function __construct(
        private WebsiteReportAnalyzer $analyzer,
    ) {
    }

    /**
     * Detect the technology stack behind the given URL.
     *
     * The submitted URL is validated and analysed by the underlying
     * analyzer. Invalid URLs and unreachable websites never escape: the
     * analyzer converts them into an error report, which is mapped onto a
     * view model carrying the user-facing error message.
     *
     * @param string $url The website URL submitted by the user.
     *
     * @return DetectionReportViewModel The immutable report view model.
     */
    public function detect(string $url): DetectionReportViewModel
    {
        $report = $this->analyzer->analyze($url);

        return DetectionReportViewModel::fromReport($report, $url);
    }
}
