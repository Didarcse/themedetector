<?php

declare(strict_types=1);

namespace App\Domain\DetectionReport;

/**
 * Immutable value object representing a single detection warning.
 *
 * DetectionWarning is the canonical warning record of the detection domain.
 * It carries a stable machine-readable code, a user-facing message, and an
 * optional source so that every consumer — views, API responses, JSON/PDF
 * export, CLI tools, and monitoring — renders and classifies warnings
 * consistently.
 *
 * Responsibilities:
 *
 * - Represent a single non-fatal warning produced during a website analysis.
 * - Carry the warning code, message, and the component that produced it.
 * - Provide optional structured context for logging and monitoring.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it stores warning data only.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class DetectionWarning
{
    /**
     * Create a detection warning instance.
     *
     * @param string               $code    A stable machine-readable warning
     *                                      code, e.g. "partial_theme_meta".
     * @param string               $message A user-facing warning message.
     * @param string|null          $source  The component that produced the
     *                                      warning, null when unknown.
     * @param array<string, mixed> $context Additional structured context for
     *                                      logging and monitoring.
     */
    public function __construct(
        private string $code,
        private string $message,
        private ?string $source = null,
        private array $context = [],
    ) {
    }

    /**
     * Return the machine-readable warning code.
     *
     * @return string The stable warning code.
     */
    public function code(): string
    {
        return $this->code;
    }

    /**
     * Return the user-facing warning message.
     *
     * @return string The warning message.
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * Return the component that produced the warning.
     *
     * @return string|null The warning source, or null when unknown.
     */
    public function source(): ?string
    {
        return $this->source;
    }

    /**
     * Return additional structured warning context.
     *
     * @return array<string, mixed> The structured context.
     */
    public function context(): array
    {
        return $this->context;
    }
}
