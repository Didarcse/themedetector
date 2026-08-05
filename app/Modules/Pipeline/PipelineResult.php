<?php

declare(strict_types=1);

namespace App\Modules\Pipeline;

use App\Modules\Detection\DetectionResult;
use App\Modules\PluginDetection\PluginDetectionResult;
use App\Modules\ThemeExtraction\ThemeExtractionResult;

/**
 * Immutable aggregate of every Detection Pipeline stage result.
 *
 * PipelineResult is the canonical output of the Detection Pipeline. It
 * aggregates the immutable results produced by every executed stage, in
 * execution order, and exposes typed accessors for the module results the
 * pipeline currently coordinates.
 *
 * Responsibilities:
 *
 * - Aggregate every executed stage result in execution order.
 * - Expose the full result collection.
 * - Expose typed accessors for the known module results.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Aggregate: it is the single point that contains every module result
 *   of a pipeline run.
 * - Single Responsibility Principle: it stores pipeline results only and
 *   performs no detection, parsing, or business logic.
 * - Stateless, deterministic, and side-effect free.
 * - It contains no orchestration logic and knows nothing about how a
 *   result was produced.
 *
 * Future Compatibility:
 *
 * - Future module results (Technology, Analytics, Security, and more) are
 *   aggregated through the generic result collection without breaking
 *   changes; typed accessors are added only as modules are added.
 */
final readonly class PipelineResult
{
    /**
     * @param list<object> $results The immutable module results produced by
     *                              every executed stage, in execution order.
     */
    public function __construct(
        private array $results,
    ) {
    }

    /**
     * Return every stage result, in execution order.
     *
     * @return list<object> The immutable module results.
     */
    public function results(): array
    {
        return $this->results;
    }

    /**
     * Return the theme detection result, when present.
     *
     * The Theme Detection stage produces the shared Detection Engine
     * result. Null is returned when the stage was not executed or did not
     * produce a DetectionResult.
     *
     * @return DetectionResult|null The theme detection result, or null when
     *                              absent.
     */
    public function themeDetection(): ?DetectionResult
    {
        foreach ($this->results as $result) {
            if ($result instanceof DetectionResult) {
                return $result;
            }
        }

        return null;
    }

    /**
     * Return the theme extraction result, when present.
     *
     * Null is returned when the stage was not executed or did not produce
     * a ThemeExtractionResult.
     *
     * @return ThemeExtractionResult|null The theme extraction result, or
     *                                    null when absent.
     */
    public function themeExtraction(): ?ThemeExtractionResult
    {
        foreach ($this->results as $result) {
            if ($result instanceof ThemeExtractionResult) {
                return $result;
            }
        }

        return null;
    }

    /**
     * Return the plugin detection result, when present.
     *
     * Null is returned when the stage was not executed or did not produce
     * a PluginDetectionResult.
     *
     * @return PluginDetectionResult|null The plugin detection result, or
     *                                    null when absent.
     */
    public function pluginDetection(): ?PluginDetectionResult
    {
        foreach ($this->results as $result) {
            if ($result instanceof PluginDetectionResult) {
                return $result;
            }
        }

        return null;
    }
}
