<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection;

use App\Modules\Detection\DetectionContext;
use RuntimeException;

/**
 * Coordinates the complete technology detection workflow.
 *
 * The TechnologyDetectionManager is the orchestration layer of the
 * Technology Detection Engine. It iterates the detectors registered in the
 * TechnologyRegistry, delegates detection to every detector that supports
 * the supplied context, and aggregates the resulting
 * TechnologyDetectionResult instances into a single deterministic list.
 *
 * Responsibilities:
 *
 * - Obtain every registered detector from the TechnologyRegistry.
 * - Iterate through the detectors in registration order.
 * - Invoke supports() on each detector.
 * - Delegate detection to every detector that supports the supplied
 *   DetectionContext.
 * - Aggregate all returned results in registration order.
 * - Deduplicate the aggregated results by slug, falling back to the
 *   normalized technology name, keeping the highest-confidence result.
 * - Return the deduplicated list of TechnologyDetectionResult instances.
 * - Throw a RuntimeException when no detector has been registered.
 *
 * Design philosophy:
 *
 * - Orchestrator Pattern: the manager coordinates the registered
 *   detectors and never performs detection itself.
 * - Multi-hit dispatch: unlike the mutually exclusive platform modules, a
 *   website concurrently runs many technologies (JavaScript libraries,
 *   analytics platforms, and CDNs at the same time), so every supporting
 *   detector is consulted and its results are aggregated.
 * - Single Responsibility Principle: the manager performs pure
 *   orchestration only. It does no HTTP requests, no parsing, no
 *   confidence calculation, and no technology-specific logic.
 * - Dependency Injection: the manager depends on the TechnologyRegistry
 *   and receives it through the constructor.
 * - Open/Closed Principle: it works exclusively with
 *   TechnologyDetectorInterface and has no knowledge of any concrete
 *   technology (JavaScript libraries, analytics platforms, CDNs, etc.), so
 *   new detectors can be added without modifying the manager.
 * - Detectors are never reordered and never executed more than once.
 * - Deduplication is deterministic: results are compared by slug (or
 *   normalized name when no slug is present) and the highest-confidence
 *   result wins, with the first occurrence keeping its position in the
 *   output list. Ties keep the earlier result.
 * - Fail Fast: an empty registry is a composition error and is reported
 *   with a RuntimeException instead of silently returning an empty list.
 * - The manager is stateless, deterministic, and side-effect free: given
 *   the same registry and context, it always returns the same list.
 *
 * Future Compatibility:
 *
 * - Future technology detector implementations are discovered only through
 *   the TechnologyRegistry and are consumed by this manager without
 *   modification.
 */
final readonly class TechnologyDetectionManager
{
    /**
     * @param TechnologyRegistry $registry The registry of registered
     *                                     technology detectors.
     */
    public function __construct(
        private TechnologyRegistry $registry,
    ) {
    }

    /**
     * Detect the technologies of the website represented by the given
     * context.
     *
     * Detectors are consulted in registration order and every detector
     * that supports the context is delegated to. All returned results are
     * aggregated in registration order and deduplicated by slug (or by
     * normalized technology name when no slug is present), keeping the
     * highest-confidence result for each deduplication key. When no
     * detector supports the context, an empty list is returned. The given
     * DetectionContext is never changed.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return list<TechnologyDetectionResult> The deduplicated technology
     *                                          detection results, in
     *                                          registration order.
     *
     * @throws RuntimeException When no detector has been registered.
     */
    public function detect(DetectionContext $context): array
    {
        $detectors = $this->registry->all();

        if ($detectors === []) {
            throw new RuntimeException('No technology detectors have been registered.');
        }

        $concatenated = [];

        foreach ($detectors as $detector) {
            if (!$detector->supports($context)) {
                continue;
            }

            foreach ($detector->detect($context) as $result) {
                $concatenated[] = $result;
            }
        }

        $winnersByKey = [];
        $firstSeenPositionByKey = [];

        foreach ($concatenated as $position => $result) {
            $key = self::deduplicationKey($result);

            if ($key === null) {
                continue;
            }

            if (!array_key_exists($key, $firstSeenPositionByKey)) {
                $firstSeenPositionByKey[$key] = $position;
            }

            $winner = $winnersByKey[$key] ?? null;

            if ($winner === null || $result->confidence() > $winner->confidence()) {
                $winnersByKey[$key] = $result;
            }
        }

        $aggregated = [];

        foreach ($concatenated as $position => $result) {
            $key = self::deduplicationKey($result);

            if ($key === null) {
                $aggregated[] = $result;
                continue;
            }

            if ($firstSeenPositionByKey[$key] === $position) {
                $aggregated[] = $winnersByKey[$key];
            }
        }

        return $aggregated;
    }

    /**
     * Resolve the deduplication key of a detection result.
     *
     * The slug is the canonical deduplication key. When the result carries
     * no metadata or no slug, the normalized technology name is used
     * instead. When neither key is available, null is returned and the
     * result is never deduplicated.
     *
     * @param TechnologyDetectionResult $result The detection result.
     *
     * @return string|null The deduplication key, or null when no key can
     *                     be resolved.
     */
    private static function deduplicationKey(TechnologyDetectionResult $result): ?string
    {
        $metadata = $result->metadata();

        if ($metadata === null) {
            return null;
        }

        $slug = $metadata->slug();

        if ($slug !== null && trim($slug) !== '') {
            return $slug;
        }

        $name = strtolower(trim($metadata->name()));

        return $name === '' ? null : $name;
    }
}
