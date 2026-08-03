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
 *
 * Serves as the common parent for the more specific HTTP exception
 * family, allowing every transport failure to be caught through a
 * single exception type regardless of the concrete client or adapter
 * in use.
 */
class HttpException extends RuntimeException
{
    public function __construct(
        string $message,
        int $code = 0,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
