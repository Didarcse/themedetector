<?php

declare(strict_types=1);

namespace App\Domain\DetectionReport;

use App\Modules\Detection\Core\DetectionReport as EngineDetectionReport;
use App\Modules\PluginDetection\PluginDetectionResult;
use App\Modules\ThemeExtraction\ThemeExtractionResult;

/**
 * Immutable value object representing the normalized detection summary.
 *
 * DetectionSummary is the canonical flat projection of a completed website
 * analysis. It carries the headline fields every consumer renders — CMS,
 * theme, plugins, confidence, and technologies — derived once from the
 * engine results so that views, API responses, JSON/PDF export, CLI tools,
 * and monitoring read a single normalized source.
 *
 * Responsibilities:
 *
 * - Expose the normalized CMS, theme, and plugin headline fields.
 * - Expose the overall detection confidence.
 * - Expose the detected technologies and their confidences.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it is a pure projection; it holds no
 *   detection, extraction, or business logic.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class DetectionSummary
{
    /**
     * Create a detection summary instance.
     *
     * Prefer the static from() factory, which derives every field from the
     * engine results in one consistent pass.
     *
     * @param string              $cms                   The primary detected
     *                                                   CMS, empty when none
     *                                                   was detected.
     * @param int                 $cmsConfidence         The CMS detection
     *                                                   confidence (0–100).
     * @param string|null         $themeName             The extracted theme
     *                                                   name.
     * @param string|null         $themeVersion          The extracted theme
     *                                                   version.
     * @param string|null         $themeAuthor           The extracted theme
     *                                                   author.
     * @param list<string>        $plugins               Detected plugin names in
     *                                                   display order.
     * @param int                 $detectionConfidence   The overall detection
     *                                                   confidence (0–100).
     * @param list<string>        $technologies          Detected technologies in
     *                                                   report order.
     * @param array<string, int>  $technologyConfidences Technology-to-confidence
     *                                                   map.
     * @param string|null         $primaryTheme          The theme name reported
     *                                                   by the CMS detection.
     */
    public function __construct(
        private string $cms,
        private int $cmsConfidence,
        private ?string $themeName,
        private ?string $themeVersion,
        private ?string $themeAuthor,
        private array $plugins,
        private int $detectionConfidence,
        private array $technologies,
        private array $technologyConfidences,
        private ?string $primaryTheme,
    ) {
    }

    /**
     * Project a summary from the engine results.
     *
     * Every field is derived from the Detection Engine report, the Theme
     * Extraction result, and the Plugin Detection result in one consistent
     * pass. Plugin names are deduplicated with the primary detected plugin
     * first. The overall detection confidence is the highest confidence
     * reported by any engine.
     *
     * @param EngineDetectionReport|null $engine The Detection Engine report.
     * @param ThemeExtractionResult|null $theme  The Theme Extraction result.
     * @param PluginDetectionResult|null $plugin The Plugin Detection result.
     *
     * @return self The normalized summary.
     */
    public static function from(
        ?EngineDetectionReport $engine,
        ?ThemeExtractionResult $theme,
        ?PluginDetectionResult $plugin,
    ): self {
        $themeMetadata = $theme !== null && $theme->isExtracted() ? $theme->theme() : null;
        $pluginMetadata = $plugin !== null && $plugin->isDetected() ? $plugin->plugin() : null;

        $pluginNames = [];

        if ($pluginMetadata !== null) {
            $pluginNames[$pluginMetadata->name()] = $pluginMetadata->name();
        }

        foreach (($engine?->primary()?->plugins() ?? []) as $pluginName) {
            $pluginNames[$pluginName] = $pluginName;
        }

        $cms = $engine?->primaryTechnology() ?? '';
        $cmsConfidence = $engine?->highestConfidence() ?? 0;

        return new self(
            cms: $cms,
            cmsConfidence: $cmsConfidence,
            themeName: $themeMetadata?->name(),
            themeVersion: $themeMetadata?->version(),
            themeAuthor: $themeMetadata?->author(),
            plugins: array_values($pluginNames),
            detectionConfidence: max(
                $cmsConfidence,
                $theme?->confidence() ?? 0,
                $plugin?->confidence() ?? 0,
            ),
            technologies: $engine?->technologies() ?? [],
            technologyConfidences: $engine?->confidenceMap() ?? [],
            primaryTheme: $engine?->primary()?->theme(),
        );
    }

    /**
     * Return the primary detected CMS.
     *
     * @return string The CMS name, or an empty string when no CMS was
     *                detected.
     */
    public function cms(): string
    {
        return $this->cms;
    }

    /**
     * Return the CMS detection confidence.
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
     * @return int The confidence score (0–100).
     */
    public function detectionConfidence(): int
    {
        return $this->detectionConfidence;
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
     * Return the technology-to-confidence map.
     *
     * @return array<string, int> The map keyed by technology name.
     */
    public function technologyConfidences(): array
    {
        return $this->technologyConfidences;
    }

    /**
     * Return the theme name reported by the CMS detection.
     *
     * @return string|null The detected theme name, or null when unknown.
     */
    public function primaryTheme(): ?string
    {
        return $this->primaryTheme;
    }
}
