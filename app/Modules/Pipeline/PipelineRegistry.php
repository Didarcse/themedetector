<?php

declare(strict_types=1);

namespace App\Modules\Pipeline;

use App\Modules\Pipeline\Contracts\PipelineStageInterface;

/**
 * Provides a central registry for every Detection Pipeline stage.
 *
 * The registry is the composition point for pipeline stage
 * implementations. It is responsible only for registering and exposing
 * stage instances. It performs no orchestration, no execution, no
 * detection, and no business logic.
 *
 * Responsibilities:
 *
 * - Register PipelineStageInterface implementations.
 * - Return all registered stages.
 * - Nothing else.
 *
 * Design philosophy:
 *
 * - Registry Pattern: the registry owns the pipeline stage collection and
 *   nothing more.
 * - Single Responsibility Principle: the registry has no business logic,
 *   no orchestration logic, no detection logic, and no HTTP.
 * - Open/Closed Principle: it works exclusively with
 *   PipelineStageInterface and has no knowledge of any concrete stage
 *   (Theme Detection, Theme Extraction, Plugin Detection, Technology
 *   Detection, etc.), so new stages can be registered without modifying
 *   the registry.
 * - Stages are never reordered, filtered, deduplicated, or transformed.
 *   The all() accessor returns exactly what was registered, in the order
 *   it was registered.
 * - The registry is deterministic and side-effect free, holding no state
 *   other than the stage collection itself.
 *
 * Future Compatibility:
 *
 * - Every future pipeline stage implementation — Technology Detection,
 *   Analytics Detection, Security Detection, and future modules — is
 *   registered through this registry.
 */
final class PipelineRegistry
{
    /**
     * @var list<PipelineStageInterface>
     */
    private array $stages = [];

    /**
     * Register a pipeline stage implementation.
     *
     * The stage is appended to the registry in the exact order it is
     * registered.
     *
     * @param PipelineStageInterface $stage The stage to register.
     */
    public function register(PipelineStageInterface $stage): void
    {
        $this->stages[] = $stage;
    }

    /**
     * Return every registered pipeline stage.
     *
     * Stages are returned exactly as registered: no reordering, no
     * filtering, and no transformation.
     *
     * @return list<PipelineStageInterface> The registered stages.
     */
    public function all(): array
    {
        return $this->stages;
    }
}
