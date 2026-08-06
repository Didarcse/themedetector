<?php

declare(strict_types=1);

namespace App\Domain\DetectionReport;

use App\Modules\Detection\Core\DetectionReport as EngineDetectionReport;
use App\Modules\PluginDetection\PluginDetectionResult;
use App\Modules\PluginDetection\PluginMetadata;
use App\Modules\ThemeExtraction\ThemeExtractionResult;
use App\Modules\ThemeExtraction\ThemeMetadata;

/**
 * Immutable domain model representing a complete website analysis.
 *
 * DetectionReport is the single source of truth for the outcome of a
 * website analysis. It aggregates the website information, the Detection
 * Engine report, the Theme Extraction result, the Plugin Detection result,
 * the normalized detection summary, the measured detection time, and every
 * warning and error produced along the way. Views, API responses, JSON/PDF
 * export, CLI tools, and monitoring all read this one aggregate.
 *
 * Responsibilities:
 *
 * - Aggregate the full outcome of a single website analysis.
 * - Expose the normalized summary and the raw engine results.
 * - Expose the analysis state (errors, warnings, detection).
 *
 * Design philosophy:
 *
 * - Immutable Aggregate: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it stores analysis data only.
 * - Pure Domain Model: it contains no HTTP, rendering, database, or
 *   business logic.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class DetectionReport
{
    /**
     * Create a detection report instance.
     *
     * @param WebsiteInformation           $websiteInformation The analysed
     *                                                         website facts.
     * @param EngineDetectionReport|null   $engine             The Detection
     *                                                         Engine report,
     *                                                         null when the
     *                                                         analysis failed.
     * @param ThemeExtractionResult|null   $theme              The Theme
     *                                                         Extraction
     *                                                         result, null
     *                                                         when the analysis
     *                                                         failed.
     * @param PluginDetectionResult|null   $plugin             The Plugin
     *                                                         Detection
     *                                                         result, null when
     *                                                         the analysis
     *                                                         failed.
     * @param DetectionSummary             $summary            The normalized
     *                                                         detection
     *                                                         summary.
     * @param float                        $detectionTime      Total detection
     *                                                         duration in
     *                                                         seconds.
     * @param list<DetectionWarning>       $warnings           Warnings produced
     *                                                         during the
     *                                                         analysis.
     * @param list<DetectionError>         $errors             Errors produced
     *                                                         during the
     *                                                         analysis.
     */
    public function __construct(
        private WebsiteInformation $websiteInformation,
        private ?EngineDetectionReport $engine = null,
        private ?ThemeExtractionResult $theme = null,
        private ?PluginDetectionResult $plugin = null,
        private DetectionSummary $summary = new DetectionSummary(
            cms: '',
            cmsConfidence: 0,
            themeName: null,
            themeVersion: null,
            themeAuthor: null,
            plugins: [],
            detectionConfidence: 0,
            technologies: [],
            technologyConfidences: [],
            primaryTheme: null,
        ),
        private float $detectionTime = 0.0,
        private array $warnings = [],
        private array $errors = [],
    ) {
    }

    /**
     * Return the analysed website information.
     *
     * @return WebsiteInformation The website facts.
     */
    public function websiteInformation(): WebsiteInformation
    {
        return $this->websiteInformation;
    }

    /**
     * Return the Detection Engine report.
     *
     * @return EngineDetectionReport|null The engine report, or null when the
     *                                    analysis failed.
     */
    public function engine(): ?EngineDetectionReport
    {
        return $this->engine;
    }

    /**
     * Return the Theme Extraction result.
     *
     * @return ThemeExtractionResult|null The theme result, or null when the
     *                                    analysis failed.
     */
    public function theme(): ?ThemeExtractionResult
    {
        return $this->theme;
    }

    /**
     * Return the Plugin Detection result.
     *
     * @return PluginDetectionResult|null The plugin result, or null when the
     *                                    analysis failed.
     */
    public function plugin(): ?PluginDetectionResult
    {
        return $this->plugin;
    }

    /**
     * Return the normalized detection summary.
     *
     * @return DetectionSummary The normalized summary.
     */
    public function summary(): DetectionSummary
    {
        return $this->summary;
    }

    /**
     * Return the total detection execution time.
     *
     * @return float The total detection time in seconds.
     */
    public function detectionTime(): float
    {
        return $this->detectionTime;
    }

    /**
     * Return every warning produced during the analysis.
     *
     * @return list<DetectionWarning> The warnings, empty when none occurred.
     */
    public function warnings(): array
    {
        return $this->warnings;
    }

    /**
     * Return every error produced during the analysis.
     *
     * @return list<DetectionError> The errors, empty on success.
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Return the first error produced during the analysis.
     *
     * @return DetectionError|null The primary error, or null on success.
     */
    public function primaryError(): ?DetectionError
    {
        return $this->errors[0] ?? null;
    }

    /**
     * Return whether the analysis failed.
     *
     * @return bool True when at least one error was produced.
     */
    public function hasError(): bool
    {
        return $this->errors !== [];
    }

    /**
     * Return whether a CMS was detected.
     *
     * @return bool True when at least one technology was detected.
     */
    public function hasDetection(): bool
    {
        return $this->engine?->hasDetection() ?? false;
    }

    /**
     * Return the extracted theme metadata.
     *
     * @return ThemeMetadata|null The extracted theme metadata, or null when
     *                            no theme was extracted.
     */
    public function themeMetadata(): ?ThemeMetadata
    {
        return $this->theme !== null && $this->theme->isExtracted() ? $this->theme->theme() : null;
    }

    /**
     * Return the theme extraction confidence.
     *
     * @return int The confidence score (0–100).
     */
    public function themeConfidence(): int
    {
        return $this->theme?->confidence() ?? 0;
    }

    /**
     * Return the primary detected plugin metadata.
     *
     * @return PluginMetadata|null The detected plugin metadata, or null when
     *                             no plugin was detected.
     */
    public function pluginMetadata(): ?PluginMetadata
    {
        return $this->plugin !== null && $this->plugin->isDetected() ? $this->plugin->plugin() : null;
    }

    /**
     * Return the plugin detection confidence.
     *
     * @return int The confidence score (0–100).
     */
    public function pluginConfidence(): int
    {
        return $this->plugin?->confidence() ?? 0;
    }
}
