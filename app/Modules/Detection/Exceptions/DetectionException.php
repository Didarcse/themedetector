<?php

declare(strict_types=1);

namespace App\Modules\Detection\Exceptions;

use RuntimeException;
use Throwable;

/**
 * Base exception for all detection module errors.
 *
 * Thrown when detection encounters an unrecoverable error such as
 * a missing HTTP response, invalid configuration, or infrastructure
 * failure.  Not thrown for "not detected" outcomes — only for
 * genuine errors.
 */
final class DetectionException extends RuntimeException
{
    public function __construct(
        string $message,
        int $code = 0,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
