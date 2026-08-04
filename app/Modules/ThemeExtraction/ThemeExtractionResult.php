<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction;

/**
 * Immutable value object representing the result of a theme extraction.
 *
 * ThemeExtractionResult is the canonical result returned by every
 * ThemeExtractor implementation. It contains the outcome of a theme
 * extraction attempt — whether a theme was extracted, the confidence of
 * that outcome, and the normalized ThemeMetadata describing the extracted
 * theme when extraction succeeded.
 *
 * Responsibilities:
 *
 * - Represent the outcome of a theme extraction attempt.
 * - Carry the normalized theme metadata and confidence score.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it stores result data only and
 *   performs no extraction logic.
 * - Stateless, deterministic, and side-effect free.
 * - It contains no parsing logic and knows nothing about WordPress,
 *   Shopify, Ghost, Joomla, Drupal, TYPO3, or any other platform.
 */
final readonly class ThemeExtractionResult
{
    /**
     * @param bool                 $extracted Whether a theme was extracted.
     * @param ?ThemeMetadata       $theme     The normalized theme metadata,
     *                                        null when no theme was extracted.
     * @param int                  $confidence The confidence score (0–100).
     * @param array<string, mixed> $metadata   Additional information (evidence,
     *                                         sources, extraction details).
     */
    public function __construct(
        private bool $extracted,
        private ?ThemeMetadata $theme,
        private int $confidence,
        private array $metadata = [],
    ) {
    }

    /**
     * Return whether a theme was extracted.
     *
     * @return bool True when the extraction identified a theme.
     */
    public function isExtracted(): bool
    {
        return $this->extracted;
    }

    /**
     * Return the normalized theme metadata.
     *
     * @return ThemeMetadata|null The extracted theme metadata, or null when
     *                            no theme was extracted.
     */
    public function theme(): ?ThemeMetadata
    {
        return $this->theme;
    }

    /**
     * Return the confidence score of the extraction.
     *
     * @return int The confidence score (0–100).
     */
    public function confidence(): int
    {
        return $this->confidence;
    }

    /**
     * Return additional extraction information.
     *
     * @return array<string, mixed> The additional metadata.
     */
    public function metadata(): array
    {
        return $this->metadata;
    }
}
