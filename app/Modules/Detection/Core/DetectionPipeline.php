<?php

declare(strict_types=1);

namespace App\Modules\Detection\Core;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionEngine;
use App\Modules\Detection\DetectionResult;

/**
 * Coordinates the complete detection workflow.
 *
 * Passes a DetectionContext to the DetectionEngine, filters and sorts
 * the results, merges metadata, determines the primary technology,
 * and returns an immutable DetectionReport.
 *
 * The pipeline is technology-agnostic and contains no CMS-specific
 * or detector-specific logic.
 */
final class DetectionPipeline
{
    public function __construct(
        private readonly DetectionEngine $engine,
    ) {
    }

    /**
     * Analyse the given context and produce a DetectionReport.
     */
    public function analyze(DetectionContext $context): DetectionReport
    {
        $results = $this->engine->detect($context);

        $successful = $this->successfulResults($results);

        $successful = $this->sortResults($successful);

        return new DetectionReport(
            results: $successful,
            metadata: $this->mergeMetadata($successful),
            primary: $this->primaryResult($successful),
        );
    }

    /**
     * Keep only detected results, preserving original order.
     *
     * @param list<DetectionResult> $results
     *
     * @return list<DetectionResult>
     */
    private function successfulResults(array $results): array
    {
        $successful = [];

        foreach ($results as $result) {
            if ($result->isDetected()) {
                $successful[] = $result;
            }
        }

        return $successful;
    }

    /**
     * Sort by confidence descending and return a new list.
     *
     * PHP 8+ sorting is stable, so equal-confidence results retain
     * their original registration order.
     *
     * @param list<DetectionResult> $results
     *
     * @return list<DetectionResult>
     */
    private function sortResults(array $results): array
    {
        usort($results, static function (DetectionResult $a, DetectionResult $b): int {
            return $b->confidence() <=> $a->confidence();
        });

        return $results;
    }

    /**
     * Merge metadata using array_replace.
     *
     * Results are already sorted by confidence descending, so the
     * iteration is reversed to ensure higher-confidence detections
     * take precedence when keys collide.
     *
     * @param list<DetectionResult> $results
     *
     * @return array<string, mixed>
     */
    private function mergeMetadata(array $results): array
    {
        $metadata = [];

        foreach (array_reverse($results) as $result) {
            $metadata = array_replace($metadata, $result->metadata());
        }

        return $metadata;
    }

    /**
     * Return the first (highest-confidence) result, or null.
     *
     * @param list<DetectionResult> $results
     */
    private function primaryResult(array $results): ?DetectionResult
    {
        return $results[0] ?? null;
    }
}
