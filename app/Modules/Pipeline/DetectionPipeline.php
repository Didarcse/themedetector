<?php

declare(strict_types=1);

namespace App\Modules\Pipeline;

use App\Modules\Detection\DetectionContext;

/**
 * Public facade of the Detection Pipeline.
 *
 * DetectionPipeline is the only public entry point for the Detection
 * Pipeline. It delegates the complete pipeline run to the
 * PipelineManager and exposes the aggregated PipelineResult.
 *
 * Responsibilities:
 *
 * - Delegate pipeline execution to the PipelineManager.
 * - Return the resulting PipelineResult.
 *
 * Design philosophy:
 *
 * - Facade: DetectionPipeline is the single public entry point for
 *   pipeline orchestration.
 * - Pure delegation: it performs no detection, no parsing, no HTTP, and
 *   no business logic.
 * - Dependency Injection: the manager is provided through the constructor.
 * - Stateless, deterministic, and side-effect free: given the same
 *   manager and context, it always produces the same PipelineResult.
 *
 * Future Compatibility:
 *
 * - Future stages are added to the pipeline through the PipelineRegistry
 *   without modifying this facade.
 */
final readonly class DetectionPipeline
{
    /**
     * @param PipelineManager $manager The pipeline orchestrator.
     */
    public function __construct(
        private PipelineManager $manager,
    ) {
    }

    /**
     * Run the Detection Pipeline against the given context.
     *
     * The context carries the immutable HTTP response data collected by
     * the Detection Engine. The pipeline executes every supporting stage
     * in registration order and returns the aggregated PipelineResult.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return PipelineResult The aggregated pipeline result.
     */
    public function run(DetectionContext $context): PipelineResult
    {
        return $this->manager->run($context);
    }
}
