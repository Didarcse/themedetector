<?php

declare(strict_types=1);

namespace App\Services;

use App\Modules\Detection\Core\DetectionReport;
use App\Modules\PluginDetection\PluginDetectionResult;
use App\Modules\ThemeExtraction\ThemeExtractionResult;

/**
 * Immutable value object representing a complete website detection report.
 *
 * WebsiteReport is the canonical read-only output of the public detection
 * report page. It aggregates the Detection Engine result, the Theme
 * Extraction Engine result, and the Plugin Detection Engine result produced
 * for a single analysed URL, together with the total detection time.
 *
 * Responsibilities:
 *
 * - Represent the outcome of a single website analysis.
 * - Carry the normalized engine results and the detection duration.
 * - Expose the analysis state (error, detection) through read-only
 *   accessors.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it stores analysis data only and
 *   performs no detection, no extraction, and no business logic.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class WebsiteReport
{
    /**
     * Create a website detection report instance.
     *
     * @param string                   $url           The normalized analysed
     *                                                URL.
     * @param string                   $finalUrl      The final URL after
     *                                                redirects, empty when the
     *                                                analysis failed.
     * @param DetectionReport|null     $detection     The Detection Engine
     *                                                report, null when the
     *                                                analysis failed.
     * @param ThemeExtractionResult|null $theme       The Theme Extraction
     *                                                result, null when the
     *                                                analysis failed.
     * @param PluginDetectionResult|null $plugin      The Plugin Detection
     *                                                result, null when the
     *                                                analysis failed.
     * @param float                    $detectionTime Total detection duration
     *                                                in seconds.
     * @param int                      $statusCode    The analysed website's
     *                                                HTTP status, 0 when the
     *                                                analysis failed.
     * @param string|null              $error         A user-facing error
     *                                                message, null on success.
     */
    public function __construct(
        private string $url,
        private string $finalUrl,
        private ?DetectionReport $detection,
        private ?ThemeExtractionResult $theme,
        private ?PluginDetectionResult $plugin,
        private float $detectionTime,
        private int $statusCode,
        private ?string $error = null,
    ) {
    }

    public function url(): string
    {
        return $this->url;
    }

    public function finalUrl(): string
    {
        return $this->finalUrl;
    }

    public function detection(): ?DetectionReport
    {
        return $this->detection;
    }

    public function theme(): ?ThemeExtractionResult
    {
        return $this->theme;
    }

    public function plugin(): ?PluginDetectionResult
    {
        return $this->plugin;
    }

    public function detectionTime(): float
    {
        return $this->detectionTime;
    }

    public function statusCode(): int
    {
        return $this->statusCode;
    }

    public function error(): ?string
    {
        return $this->error;
    }

    public function hasError(): bool
    {
        return $this->error !== null;
    }

    public function hasDetection(): bool
    {
        return $this->detection?->hasDetection() ?? false;
    }
}
