<?php

declare(strict_types=1);

namespace App\Api;

/**
 * Immutable value object describing the outcome of API request validation.
 *
 * ApiRequestValidation carries whether the request body satisfied the
 * strict schema, the machine-readable errors raised when it did not, and —
 * on success — the normalized URL ready for analysis.
 *
 * Responsibilities:
 *
 * - Represent the outcome of a validation attempt.
 * - Carry the validation errors and the normalized URL.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it stores validation data only.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class ApiRequestValidation
{
    /**
     * Create a validation result.
     *
     * @param bool                               $valid  Whether the request
     *                                                   satisfied the schema.
     * @param list<array{code: string, message: string}> $errors The errors,
     *                                                   empty when valid.
     * @param string                             $url    The normalized URL,
     *                                                   empty when invalid.
     */
    public function __construct(
        private bool $valid,
        private array $errors,
        private string $url = '',
    ) {
    }

    /**
     * Return whether the request is valid.
     *
     * @return bool True when the request satisfied the schema.
     */
    public function valid(): bool
    {
        return $this->valid;
    }

    /**
     * Return the validation errors.
     *
     * @return list<array{code: string, message: string}> The errors, empty
     *                                                    when valid.
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Return the normalized URL.
     *
     * @return string The normalized URL, empty when the request is invalid.
     */
    public function url(): string
    {
        return $this->url;
    }
}
