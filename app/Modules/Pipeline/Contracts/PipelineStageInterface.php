<?php

declare(strict_types=1);

namespace App\Modules\Pipeline\Contracts;

use App\Modules\Detection\DetectionContext;

/**
 * Contract for every Detection Pipeline stage implementation.
 *
 * A pipeline stage wraps one detection-related module (Theme Detection,
 * Theme Extraction, Plugin Detection, and future modules) and exposes it
 * to the PipelineManager through a uniform contract. Every stage decides
 * whether it supports the supplied detection context and, if so, executes
 * its underlying module and returns the immutable module result.
 *
 * Responsibilities:
 *
 * - Expose a stable, unique stage identifier.
 * - Determine whether the stage supports the given detection context.
 * - Execute the underlying module and return its immutable result.
 *
 * Design philosophy:
 *
 * - Interface Segregation Principle: the contract exposes only the
 *   operations a pipeline stage needs.
 * - Contract: consumers depend on this abstraction rather than on a
 *   concrete stage.
 * - Dependency Injection and Open/Closed Principle: new stages are
 *   introduced by implementing this interface without modifying existing
 *   code.
 * - Single Responsibility Principle: a stage adapts one detection module
 *   only. It never performs detection, parsing, HTTP, or business logic of
 *   its own.
 * - Stateless, deterministic, and side-effect free.
 *
 * Future Compatibility:
 *
 * - Every future stage — Technology Detection, Analytics Detection,
 *   Security Detection, and future modules — must implement this contract.
 * - The execute() result is intentionally exposed as an immutable object
 *   so the pipeline can aggregate heterogeneous module results without
 *   changing this contract.
 *
 * The interface knows nothing about SEO, Security, Performance, or
 * Website Intelligence.
 */
interface PipelineStageInterface
{
    /**
     * Return the canonical, stable identifier of this stage.
     *
     * The identifier is snake_case and unique within a pipeline, for
     * example 'theme-detection', 'theme-extraction', or 'plugin-detection'.
     *
     * @return string The canonical stage identifier.
     */
    public function name(): string;

    /**
     * Determine whether the stage supports the given detection context.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return bool True when the stage supports the supplied context.
     */
    public function supports(DetectionContext $context): bool;

    /**
     * Execute the underlying detection module against the given context.
     *
     * The context carries the immutable HTTP response data collected by
     * the Detection Engine. Stages translate that data into a normalized
     * module result and perform no additional HTTP requests of their own.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return object The immutable module result produced by the stage
     *                (for example DetectionResult,
     *                ThemeExtractionResult, or PluginDetectionResult).
     */
    public function execute(DetectionContext $context): object;
}
