<?php

declare(strict_types=1);

namespace App\Domain\DetectionReport;

/**
 * Immutable value object representing a single detection error.
 *
 * DetectionError is the canonical error record of the detection domain. It
 * carries a stable machine-readable code, a user-facing message, and an
 * optional source so that every consumer — views, API responses, JSON/PDF
 * export, CLI tools, and monitoring — renders and classifies errors
 * consistently.
 *
 * Responsibilities:
 *
 * - Represent a single error produced during a website analysis.
 * - Carry the error code, message, and the component that produced it.
 * - Provide optional structured context for logging and monitoring.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it stores error data only.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class DetectionError
{
    /**
     * Create a detection error instance.
     *
     * @param string               $code    A stable machine-readable error
     *                                      code, e.g. "transport_failure".
     * @param string               $message A user-facing error message.
     * @param string|null          $source  The component that produced the
     *                                      error, null when unknown.
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
     * Return the machine-readable error code.
     *
     * @return string The stable error code.
     */
    public function code(): string
    {
        return $this->code;
    }

    /**
     * Return the user-facing error message.
     *
     * @return string The error message.
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * Return the component that produced the error.
     *
     * @return string|null The error source, or null when unknown.
     */
    public function source(): ?string
    {
        return $this->source;
    }

    /**
     * Return additional structured error context.
     *
     * @return array<string, mixed> The structured context.
     */
    public function context(): array
    {
        return $this->context;
    }
}
