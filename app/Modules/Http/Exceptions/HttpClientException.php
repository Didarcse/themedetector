<?php

declare(strict_types=1);

namespace App\Modules\Http\Exceptions;

use App\Modules\Http\HttpException;

/**
 * Base exception for every HTTP client failure in the ThemeDetectorTool
 * platform.
 *
 * Every HTTP-related exception must extend this class. Examples include
 * InvalidUrlException, TransportException, TimeoutException,
 * TooManyRedirectsException, and SSLException. The base exception
 * represents failures occurring while performing outbound HTTP
 * communication.
 *
 * The class extends HttpException so that every client failure remains
 * catchable through the legacy HttpException contract, in addition to
 * the more specific HttpClientException family.
 *
 * Responsibilities:
 *
 * - Represent HTTP client failures.
 * - Serve as the common parent exception for all HTTP-related
 *   exceptions.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is an exception base class
 *   only. It performs no HTTP requests, contains no HTTP logic, and
 *   stores no request data.
 * - The class is stateless and side-effect free, and it is designed for
 *   inheritance: future exceptions must extend this class.
 */
class HttpClientException extends HttpException
{
}
