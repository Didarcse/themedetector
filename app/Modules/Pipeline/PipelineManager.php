<?php

declare(strict_types=1);

namespace App\Modules\Pipeline;

use App\Modules\Detection\DetectionContext;

/**
 * Coordinates the complete Detection Pipeline.
 *
 * The PipelineManager is the orchestration layer of the Detection
 * Pipeline. It iterates the stages registered in the PipelineRegistry,
 * executes every stage that supports the supplied context, and aggregates
 * the resulting module results into a single PipelineResult.
 *
 * Responsibilities:
 *
 * - Obtain every registered stage from the PipelineRegistry.
 * - Iterate through the stages in registration order.
 * - Invoke supports() on each stage.
 * - Execute every stage that supports the supplied DetectionContext.
 * - Aggregate every stage result, in execution order.
 * - Produce one PipelineResult.
 *
 * Design philosophy:
 *
 * - Orchestrator Pattern: the manager coordinates the registered stages
 *   and never performs detection itself.
 * - Single Responsibility Principle: the manager performs pure
 *   orchestration only. It does no HTTP requests, no parsing, no
 *   confidence calculation, and no detection logic.
 * - Dependency Injection: the manager depends on the PipelineRegistry and
 *   receives it through the constructor.
 * - Open/Closed Principle: it works exclusively with
 *   PipelineStageInterface and has no knowledge of any concrete stage
 *   (Theme Detection, Theme Extraction, Plugin Detection, Technology
 *   Detection, etc.), so new stages can be added without modifying the
 *   manager.
 * - Stages are never reordered and never executed more than once.
 * - The pipeline preserves execution order and stops only on
 *   unrecoverable failures: a stage that throws halts the pipeline, while
 *   a stage that does not support the context is simply skipped.
 * - The manager is stateless, deterministic, and side-effect free: given
 *   the same registry and context, it always produces the same
 *   PipelineResult, and the given DetectionContext is never changed.
 *
 * Future Compatibility:
 *
 * - Future pipeline stage implementations are discovered only through
 *   the PipelineRegistry and are consumed by this manager without
 *   modification.
 */
final readonly class PipelineManager
{
    /**
     * @param PipelineRegistry $registry The registry of registered pipeline
     *                                   stages.
     */
    public function __construct(
        private PipelineRegistry $registry,
    ) {
    }

    /**
     * Execute the registered pipeline stages and produce a PipelineResult.
     *
     * Stages are consulted in registration order. Every stage that
     * supports the context is executed exactly once, in that order, and
     * its immutable result is collected. A stage that does not support
     * the context is skipped. When no stage supports the context, an
     * empty PipelineResult is produced. A stage failure is unrecoverable
     * and halts the pipeline. The given DetectionContext is never changed.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return PipelineResult The aggregated pipeline result.
     */
    public function run(DetectionContext $context): PipelineResult
    {
        $results = [];

        foreach ($this->registry->all() as $stage) {
            if (!$stage->supports($context)) {
                continue;
            }

            $results[] = $stage->execute($context);
        }

        return new PipelineResult($results);
    }
}
