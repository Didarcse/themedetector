<?php

declare(strict_types=1);

namespace App\Modules\Http;

use RuntimeException;
use Throwable;

/**
 * Base exception for all HTTP client errors.
 *
 * Thrown when a request fails at the transport level — cURL errors,
 * connection timeouts, DNS resolution failures, SSL verification
 * failures, invalid HTTP responses, or general network errors.
 */
final class HttpException extends RuntimeException
{
    public function __construct(
        string $message,
        int $code = 0,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
