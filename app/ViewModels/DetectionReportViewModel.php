<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Domain\DetectionReport\DetectedTechnology;
use App\Domain\DetectionReport\DetectionReport;
use App\Modules\PluginDetection\PluginMetadata;
use App\Modules\ThemeExtraction\ThemeMetadata;

/**
 * Immutable view model for the Detection Report page.
 *
 * DetectionReportViewModel is the single presentation contract handed to
 * the report view. It carries every value the report page renders, derived
 * from the domain-level DetectionReport, so that the controller and the
 * view never touch raw engine results directly.
 *
 * Responsibilities:
 *
 * - Expose the canonical report fields: website URL, final URL, CMS, CMS
 *   confidence, theme name, theme version, theme author, detected plugins,
 *   detection confidence, and execution time.
 * - Expose the presentation state: error, detection, HTTP status, and the
 *   full set of detected technologies.
 * - Reuse the domain metadata value objects for rich theme and plugin
 *   presentation.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it stores presentation data only and
 *   performs no detection, no extraction, and no business logic.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class DetectionReportViewModel
{
    /**
     * @param list<string>            $plugins               Detected plugin
     *                                                       names in display
     *                                                       order.
     * @param list<string>            $technologies          Detected
     *                                                       technologies in
     *                                                       report order.
     * @param array<string, int>      $technologyConfidences Technology-to-
     *                                                       confidence map.
     * @param list<DetectedTechnology> $detectedTechnologies  The technologies
     *                                                       identified by the
     *                                                       Technology
     *                                                       Detection Engine.
     */
    private function __construct(
        private string $submittedUrl,
        private string $url,
        private string $finalUrl,
        private string $cms,
        private int $cmsConfidence,
        private ?string $themeName,
        private ?string $themeVersion,
        private ?string $themeAuthor,
        private array $plugins,
        private int $detectionConfidence,
        private float $executionTime,
        private int $statusCode,
        private ?string $error,
        private bool $hasDetection,
        private array $technologies,
        private array $technologyConfidences,
        private ?string $primaryTheme,
        private array $detectedTechnologies,
        private ?ThemeMetadata $themeMetadata,
        private int $themeConfidence,
        private ?PluginMetadata $pluginMetadata,
        private int $pluginConfidence,
    ) {
    }

    /**
     * Build a report view model from a completed website analysis.
     *
     * The domain-level DetectionReport is mapped onto the presentation
     * model. The normalized detection summary, the website information, and
     * the extracted metadata are copied into the display fields.
     *
     * @param DetectionReport $report       The completed website analysis.
     * @param string          $submittedUrl The raw URL as submitted by the
     *                                      user, kept for display and form
     *                                      repopulation.
     *
     * @return self The immutable report view model.
     */
    public static function fromReport(DetectionReport $report, string $submittedUrl): self
    {
        $summary = $report->summary();
        $website = $report->websiteInformation();

        return new self(
            submittedUrl: $submittedUrl,
            url: $website->url(),
            finalUrl: $website->finalUrl(),
            cms: $summary->cms(),
            cmsConfidence: $summary->cmsConfidence(),
            themeName: $summary->themeName(),
            themeVersion: $summary->themeVersion(),
            themeAuthor: $summary->themeAuthor(),
            plugins: $summary->plugins(),
            detectionConfidence: $summary->detectionConfidence(),
            executionTime: $report->detectionTime(),
            statusCode: $website->statusCode(),
            error: $report->primaryError()?->message(),
            hasDetection: $report->hasDetection(),
            technologies: $summary->technologies(),
            technologyConfidences: $summary->technologyConfidences(),
            primaryTheme: $summary->primaryTheme(),
            detectedTechnologies: $report->technologies(),
            themeMetadata: $report->themeMetadata(),
            themeConfidence: $report->themeConfidence(),
            pluginMetadata: $report->pluginMetadata(),
            pluginConfidence: $report->pluginConfidence(),
        );
    }

    /**
     * Return the raw URL submitted by the user.
     *
     * @return string The raw submitted URL.
     */
    public function submittedUrl(): string
    {
        return $this->submittedUrl;
    }

    /**
     * Return the normalized website URL.
     *
     * @return string The normalized analysed URL, empty when the analysis
     *                failed before the website could be reached.
     */
    public function url(): string
    {
        return $this->url;
    }

    /**
     * Return the final URL after redirects.
     *
     * @return string The final URL, empty when the analysis failed.
     */
    public function finalUrl(): string
    {
        return $this->finalUrl;
    }

    /**
     * Return the detected CMS name.
     *
     * @return string The primary detected CMS, or an empty string when no
     *                CMS was detected.
     */
    public function cms(): string
    {
        return $this->cms;
    }

    /**
     * Return the confidence of the CMS detection.
     *
     * @return int The confidence score (0–100).
     */
    public function cmsConfidence(): int
    {
        return $this->cmsConfidence;
    }

    /**
     * Return the extracted theme name.
     *
     * @return string|null The theme name, or null when no theme was
     *                     extracted.
     */
    public function themeName(): ?string
    {
        return $this->themeName;
    }

    /**
     * Return the extracted theme version.
     *
     * @return string|null The theme version, or null when unknown.
     */
    public function themeVersion(): ?string
    {
        return $this->themeVersion;
    }

    /**
     * Return the extracted theme author.
     *
     * @return string|null The theme author, or null when unknown.
     */
    public function themeAuthor(): ?string
    {
        return $this->themeAuthor;
    }

    /**
     * Return the detected plugin names in display order.
     *
     * @return list<string> The detected plugin names.
     */
    public function plugins(): array
    {
        return $this->plugins;
    }

    /**
     * Return the overall detection confidence.
     *
     * The overall confidence is the highest confidence reported by any
     * detection engine (CMS detection, theme extraction, plugin detection).
     *
     * @return int The overall confidence score (0–100).
     */
    public function detectionConfidence(): int
    {
        return $this->detectionConfidence;
    }

    /**
     * Return the total detection execution time.
     *
     * @return float The total detection time in seconds.
     */
    public function executionTime(): float
    {
        return $this->executionTime;
    }

    /**
     * Return the analysed website's HTTP status code.
     *
     * @return int The HTTP status code, 0 when the analysis failed.
     */
    public function statusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Return the user-facing error message.
     *
     * @return string|null The error message, or null on success.
     */
    public function error(): ?string
    {
        return $this->error;
    }

    /**
     * Return whether the analysis failed.
     *
     * @return bool True when the report carries an error.
     */
    public function hasError(): bool
    {
        return $this->error !== null;
    }

    /**
     * Return whether a CMS was detected.
     *
     * @return bool True when at least one technology was detected.
     */
    public function hasDetection(): bool
    {
        return $this->hasDetection;
    }

    /**
     * Return every detected technology in report order.
     *
     * @return list<string> The detected technologies.
     */
    public function technologies(): array
    {
        return $this->technologies;
    }

    /**
     * Return the number of detected technologies.
     *
     * @return int The number of detected technologies.
     */
    public function technologiesCount(): int
    {
        return count($this->technologies);
    }

    /**
     * Return the confidence for a specific detected technology.
     *
     * @param string $technology The technology name.
     *
     * @return int The confidence score (0–100), 0 when the technology was
     *             not detected.
     */
    public function confidenceForTechnology(string $technology): int
    {
        return $this->technologyConfidences[$technology] ?? 0;
    }

    /**
     * Return every technology identified by the Technology Detection Engine.
     *
     * @return list<DetectedTechnology> The detected technologies, empty
     *                                  when none were identified.
     */
    public function detectedTechnologies(): array
    {
        return $this->detectedTechnologies;
    }

    /**
     * Return the theme name reported by the CMS detection, if any.
     *
     * @return string|null The detected theme name, or null when unknown.
     */
    public function primaryTheme(): ?string
    {
        return $this->primaryTheme;
    }

    /**
     * Return the extracted theme metadata.
     *
     * @return ThemeMetadata|null The extracted theme metadata, or null when
     *                            no theme was extracted.
     */
    public function themeMetadata(): ?ThemeMetadata
    {
        return $this->themeMetadata;
    }

    /**
     * Return the theme extraction confidence.
     *
     * @return int The confidence score (0–100).
     */
    public function themeConfidence(): int
    {
        return $this->themeConfidence;
    }

    /**
     * Return the primary detected plugin metadata.
     *
     * @return PluginMetadata|null The detected plugin metadata, or null when
     *                             no plugin was detected.
     */
    public function pluginMetadata(): ?PluginMetadata
    {
        return $this->pluginMetadata;
    }

    /**
     * Return the plugin detection confidence.
     *
     * @return int The confidence score (0–100).
     */
    public function pluginConfidence(): int
    {
        return $this->pluginConfidence;
    }
}
