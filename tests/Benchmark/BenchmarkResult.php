<?php

declare(strict_types=1);

namespace Tests\Benchmark;

/**
 * Immutable evaluation outcome of a single benchmark case.
 *
 * BenchmarkResult captures the observed detection-engine output for one
 * BenchmarkCase together with the ground-truth expectations of that case,
 * and exposes the accuracy metrics the Detection Benchmark Suite reports:
 * CMS Detection Accuracy, Theme Detection Accuracy, Plugin Detection
 * Accuracy, False Positives, False Negatives, Execution Time, and
 * Confidence Score.
 *
 * Responsibilities:
 *
 * - Store the observed detection outcome (CMS, theme, plugins, confidence).
 * - Store the measured execution time.
 * - Expose the per-metric accuracy verdicts.
 * - Nothing else.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Metric derivation is deterministic and side-effect free: every
 *   accuracy verdict is computed from the stored observation and the case
 *   ground truth, never from external state.
 * - Single Responsibility Principle: it stores and exposes one case's
 *   evaluation only. It performs no detection, no parsing, no timing, and
 *   no aggregation.
 *
 * Metric semantics:
 *
 * - CMS Detection Accuracy: the expected technology was identified when
 *   one was expected; nothing was identified when none was expected.
 * - Theme Detection Accuracy: when a theme is expected, it was reported;
 *   when no theme is expected (platforms without a theme concept), no
 *   theme was claimed.
 * - Plugin Detection Accuracy: the detected plugin set equals the expected
 *   plugin set exactly.
 * - False Positive: a CMS detection was produced that is incorrect.
 * - False Negative: an expected CMS was not correctly identified.
 * - A case is successful when its CMS detection is accurate.
 */
final readonly class BenchmarkResult
{
    /**
     * @param BenchmarkCase $case               The benchmark case being
     *                                          evaluated.
     * @param bool          $detected           Whether the engine detected a
     *                                          CMS.
     * @param string|null   $detectedTechnology The detected CMS technology,
     *                                          null when nothing was
     *                                          detected.
     * @param string|null   $detectedTheme      The theme reported by the
     *                                          engine.
     * @param list<string>  $detectedPlugins    The plugin slugs reported by
     *                                          the engine.
     * @param int           $confidence         The confidence score (0–100).
     * @param float         $executionTime      The measured execution time
     *                                          in seconds.
     */
    public function __construct(
        private BenchmarkCase $case,
        private bool $detected,
        private ?string $detectedTechnology,
        private ?string $detectedTheme,
        private array $detectedPlugins,
        private int $confidence,
        private float $executionTime,
    ) {
    }

    /**
     * Return the benchmark case being evaluated.
     *
     * @return BenchmarkCase The benchmark case.
     */
    public function case(): BenchmarkCase
    {
        return $this->case;
    }

    /**
     * Return whether the engine detected a CMS.
     *
     * @return bool True when a CMS was detected.
     */
    public function isDetected(): bool
    {
        return $this->detected;
    }

    /**
     * Return the detected CMS technology.
     *
     * @return string|null The detected CMS, or null when nothing was
     *                     detected.
     */
    public function detectedTechnology(): ?string
    {
        return $this->detectedTechnology;
    }

    /**
     * Return the theme reported by the engine.
     *
     * @return string|null The reported theme, or null when none was
     *                     reported.
     */
    public function detectedTheme(): ?string
    {
        return $this->detectedTheme;
    }

    /**
     * Return the plugin slugs reported by the engine.
     *
     * @return list<string> The reported plugin slugs.
     */
    public function detectedPlugins(): array
    {
        return $this->detectedPlugins;
    }

    /**
     * Return the confidence score of the detection.
     *
     * @return int The confidence score (0–100).
     */
    public function confidence(): int
    {
        return $this->confidence;
    }

    /**
     * Return the measured execution time in seconds.
     *
     * @return float The execution time in seconds.
     */
    public function executionTime(): float
    {
        return $this->executionTime;
    }

    /**
     * Return whether the CMS detection is accurate.
     *
     * When a technology is expected, the engine must have detected exactly
     * that technology. When no technology is expected (a negative case),
     * the engine must have detected nothing.
     *
     * @return bool True when the CMS detection is accurate.
     */
    public function cmsAccurate(): bool
    {
        $expected = $this->case->expectedTechnology();

        if ($expected === null) {
            return !$this->detected;
        }

        return $this->detected && $this->detectedTechnology === $expected;
    }

    /**
     * Return whether the theme detection is accurate.
     *
     * When a theme is expected, the engine must report exactly that theme.
     * When no theme is expected, the engine must report no theme; this
     * keeps platforms without a theme concept from being scored down.
     *
     * @return bool True when the theme detection is accurate.
     */
    public function themeAccurate(): bool
    {
        $expected = $this->case->expectedTheme();

        if ($expected === null) {
            return $this->detectedTheme === null;
        }

        return $this->detectedTheme === $expected;
    }

    /**
     * Return whether the plugin detection is accurate.
     *
     * The reported plugin set must equal the expected plugin set exactly:
     * every expected plugin must be present and no unexpected plugin may
     * be reported.
     *
     * @return bool True when the plugin detection is accurate.
     */
    public function pluginAccurate(): bool
    {
        $expected = $this->case->expectedPlugins();

        if ($expected === []) {
            return $this->detectedPlugins === [];
        }

        return array_diff($expected, $this->detectedPlugins) === []
            && array_diff($this->detectedPlugins, $expected) === [];
    }

    /**
     * Return whether the case produced a false positive.
     *
     * A false positive is a CMS detection that is incorrect: the engine
     * claimed a technology when none was expected, or claimed a technology
     * different from the expected one.
     *
     * @return bool True when a false positive occurred.
     */
    public function isFalsePositive(): bool
    {
        return $this->detected && !$this->cmsAccurate();
    }

    /**
     * Return whether the case produced a false negative.
     *
     * A false negative is an expected CMS that was not correctly
     * identified: the engine detected nothing, or detected a technology
     * different from the expected one.
     *
     * @return bool True when a false negative occurred.
     */
    public function isFalseNegative(): bool
    {
        return $this->case->expectedTechnology() !== null && !$this->cmsAccurate();
    }

    /**
     * Return whether the case is a successful detection.
     *
     * A case is successful when its CMS detection is accurate. Theme and
     * plugin accuracy are reported as separate metrics.
     *
     * @return bool True when the CMS detection is accurate.
     */
    public function isSuccessful(): bool
    {
        return $this->cmsAccurate();
    }
}
