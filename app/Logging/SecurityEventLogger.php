<?php

declare(strict_types=1);

namespace App\Logging;

use App\Core\Request;
use Throwable;

/**
 * Central security event catalogue and redaction boundary.
 *
 * This class owns the supported event names and their severities. Callers
 * provide domain-specific values only; all context is allowlisted and
 * redacted before it reaches the underlying logger. Logging is fail-open.
 */
final class SecurityEventLogger
{
    public const CSRF_REJECTED = 'security.csrf.rejected';

    public const SESSION_FAILED = 'security.session.failed';

    public const API_AUTH_REJECTED = 'api.auth.rejected';

    public const API_REQUEST_REJECTED = 'api.request.rejected';

    public const API_RATE_LIMIT_DENIED = 'api.rate_limit.denied';

    public const API_WORKLOAD_REJECTED = 'api.workload.rejected';

    public const WEB_RATE_LIMIT_DENIED = 'web.rate_limit.denied';

    public const HTTP_SSRF_BLOCKED = 'http.ssrf.blocked';

    public const HTTP_REQUEST_FAILED = 'http.request.failed';

    public const DETECTION_ENGINE_DEGRADED = 'detection.engine.degraded';

    public const HTTP_NOT_FOUND = 'http.not_found';

    public const APP_EXCEPTION = 'app.exception';

    private ?Request $request = null;

    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly ContextRedactor $redactor,
    ) {
    }

    /**
     * Attach the current request so every event carries correlation metadata.
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * Clear the attached request so later events cannot inherit stale context.
     */
    public function clearRequest(): void
    {
        $this->request = null;
    }

    /**
     * Log a CSRF rejection.
     */
    public function csrfRejected(): void
    {
        $this->log(self::CSRF_REJECTED, [
            'status' => 403,
            'reason' => 'missing_or_invalid_token',
        ]);
    }

    /**
     * Log a session initialization, persistence, or storage failure.
     */
    public function sessionFailed(string $reason): void
    {
        $this->log(self::SESSION_FAILED, [
            'reason' => $reason,
        ]);
    }

    /**
     * Log a rejected API authentication attempt.
     */
    public function apiAuthRejected(string $reason, bool $hasAuthorization): void
    {
        $this->log(self::API_AUTH_REJECTED, [
            'status' => 401,
            'reason' => $reason,
            'has_authorization' => $hasAuthorization,
        ]);
    }

    /**
     * Log a rejected API request.
     *
     * @param array<string, mixed> $context Additional allowlisted context.
     */
    public function apiRequestRejected(int $status, string $reason, array $context = []): void
    {
        $this->log(self::API_REQUEST_REJECTED, [
            'status' => $status,
            'reason' => $reason,
        ] + $context);
    }

    /**
     * Log an API rate-limit denial.
     */
    public function apiRateLimitDenied(
        string $tier,
        int $limit,
        int $remaining,
        int $retryAfter,
    ): void {
        $this->log(self::API_RATE_LIMIT_DENIED, [
            'status' => 429,
            'tier' => $tier,
            'limit' => $limit,
            'remaining' => $remaining,
            'retry_after' => $retryAfter,
        ]);
    }

    /**
     * Log an API workload-concurrency denial.
     */
    public function apiWorkloadRejected(int $maxConcurrent): void
    {
        $this->log(self::API_WORKLOAD_REJECTED, [
            'status' => 429,
            'reason' => 'workload_limit_reached',
            'max_concurrent' => $maxConcurrent,
        ]);
    }

    /**
     * Log a web rate-limit denial.
     */
    public function webRateLimitDenied(int $limit, int $retryAfter): void
    {
        $this->log(self::WEB_RATE_LIMIT_DENIED, [
            'status' => 429,
            'tier' => 'web',
            'limit' => $limit,
            'retry_after' => $retryAfter,
        ]);
    }

    /**
     * Log a blocked SSRF target.
     */
    public function ssrfBlocked(string $targetUrl): void
    {
        $this->log(self::HTTP_SSRF_BLOCKED, [
            'target_url' => $targetUrl,
            'reason' => 'host_not_allowed',
        ]);
    }

    /**
     * Log an outbound HTTP request failure.
     */
    public function httpRequestFailed(
        string $targetUrl,
        string $reason,
        ?int $status = null,
    ): void {
        $context = [
            'target_url' => $targetUrl,
            'reason' => $reason,
        ];

        if ($status !== null) {
            $context['status'] = $status;
        }

        $this->log(self::HTTP_REQUEST_FAILED, $context);
    }

    /**
     * Log a degraded detection engine.
     */
    public function detectionEngineDegraded(string $engine): void
    {
        $this->log(self::DETECTION_ENGINE_DEGRADED, [
            'engine' => $engine,
            'reason' => 'engine_failure',
        ]);
    }

    /**
     * Log a request that did not match any route.
     */
    public function notFound(): void
    {
        $this->log(self::HTTP_NOT_FOUND, [
            'status' => 404,
        ]);
    }

    /**
     * Log an unhandled exception without its message or stack trace.
     */
    public function appException(Throwable $exception): void
    {
        $this->log(self::APP_EXCEPTION, [
            'status' => 500,
            'exception_class' => $exception::class,
            'exception_file' => $exception->getFile(),
            'exception_line' => $exception->getLine(),
        ]);
    }

    /**
     * Write an event after validating its name and redacting its context.
     *
     * @param array<string, mixed> $context The event context.
     */
    public function log(string $event, array $context = []): void
    {
        $level = $this->levelFor($event);

        if ($level === null) {
            $this->fallback('unsupported event.');

            return;
        }

        try {
            $requestContext = $this->redactor->requestMetadata($this->request);
            $safeContext = $this->redactor->redact($context);
            $this->logger->log($level, $event, $requestContext + $safeContext);
        } catch (Throwable) {
            $this->fallback();
        }
    }

    /**
     * Emit a sanitized operational message without any event context.
     */
    private function fallback(string $reason = ''): void
    {
        try {
            $message = 'ThemeDetectorTool security logging failure.';

            if ($reason !== '') {
                $message .= ' ' . $reason;
            }

            @error_log($message);
        } catch (Throwable) {
        }
    }

    /**
     * Resolve the supported severity for an event.
     */
    private function levelFor(string $event): ?LogLevel
    {
        return match ($event) {
            self::CSRF_REJECTED,
            self::API_AUTH_REJECTED,
            self::API_REQUEST_REJECTED,
            self::API_RATE_LIMIT_DENIED,
            self::API_WORKLOAD_REJECTED,
            self::WEB_RATE_LIMIT_DENIED,
            self::HTTP_SSRF_BLOCKED,
            self::DETECTION_ENGINE_DEGRADED => LogLevel::WARNING,
            self::SESSION_FAILED,
            self::HTTP_REQUEST_FAILED,
            self::APP_EXCEPTION => LogLevel::ERROR,
            self::HTTP_NOT_FOUND => LogLevel::INFO,
            default => null,
        };
    }
}
