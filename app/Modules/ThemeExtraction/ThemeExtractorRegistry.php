<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction;

use App\Modules\ThemeExtraction\Contracts\ThemeExtractorInterface;

/**
 * Provides a central registry for every Theme Extractor supported by the
 * Theme Extraction Engine.
 *
 * The registry is responsible only for registering and exposing extractor
 * instances. It performs no extraction, no orchestration, no confidence
 * calculation, and no HTTP requests.
 *
 * Responsibilities:
 *
 * - Store extractor instances in the exact order they were provided.
 * - Expose every registered extractor via the all() accessor.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: the registry has no business logic,
 *   no extraction logic, no HTML parsing, no HTTP, and no confidence
 *   calculation.
 * - Open/Closed Principle: it works exclusively with
 *   ThemeExtractorInterface and has no knowledge of any concrete
 *   platform (WordPress, Shopify, Ghost, Joomla, Drupal, TYPO3, etc.),
 *   so new extractors can be added without modifying the registry.
 * - Extractors are never reordered, filtered, or transformed. The all()
 *   accessor returns exactly what was supplied.
 * - The registry is stateless after construction, deterministic, and
 *   side-effect free.
 */
final readonly class ThemeExtractorRegistry
{
    /**
     * @var list<ThemeExtractorInterface>
     */
    private readonly array $extractors;

    /**
     * @param iterable<ThemeExtractorInterface> $extractors The extractors
     *                                                      to register.
     */
    public function __construct(
        iterable $extractors,
    ) {
        $this->extractors = $this->materialize($extractors);
    }

    /**
     * Return every registered theme extractor.
     *
     * Extractors are returned exactly as provided: no reordering, no
     * filtering, and no transformation.
     *
     * @return iterable<ThemeExtractorInterface>
     */
    public function all(): iterable
    {
        return $this->extractors;
    }

    /**
     * Convert an iterable to a list, preserving insertion order.
     *
     * @param iterable<ThemeExtractorInterface> $extractors The iterable to
     *                                                      materialize.
     *
     * @return list<ThemeExtractorInterface> The materialized extractors.
     */
    private function materialize(iterable $extractors): array
    {
        $result = [];

        foreach ($extractors as $extractor) {
            $result[] = $extractor;
        }

        return $result;
    }
}
