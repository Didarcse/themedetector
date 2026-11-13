<?php

declare(strict_types=1);

namespace App\Modules\Http\Exceptions;

/**
 * Raised when a destination is rejected by the SSRF host policy.
 *
 * The exception deliberately carries no destination details in its message,
 * preserving the existing generic "Invalid URL." response while allowing
 * callers to distinguish policy rejections from transport failures.
 */
final class SsrfBlockedException extends HttpClientException
{
}
