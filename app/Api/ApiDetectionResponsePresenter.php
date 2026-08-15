<?php

declare(strict_types=1);

namespace App\Api;

use App\Domain\DetectionReport\DetectionReport;

/**
 * Whitelist-only presenter for the public API response envelope.
 *
 * ApiDetectionResponsePresenter maps a domain DetectionReport onto the
 * public JSON contract. It never serializes domain objects directly and it
 * only ever exposes the safe fields the schema whitelists: website
 * information, the normalized summary (CMS, theme, plugins, technologies,
 * confidence), and detection time. Everything else — the raw HTML context,
 * response headers, engine metadata, error context and error source — is
 * deliberately unreachable.
 *
 * Responsibilities:
 *
 * - Build the top-level v1 envelope (schemaVersion, requestId, success,
 *   data, errors).
 * - Project the whitelisted response data from a DetectionReport.
 * - Map analysis errors to their public code and message only.
 *
 * Design philosophy:
 *
 * - Whitelist only: every emitted field is explicit; nothing is reflected
 *   or serialized wholesale.
 * - Never expose internals: context, headers, metadata, and error source
 *   stay internal.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class ApiDetectionResponsePresenter
{
    public const SCHEMA_VERSION = 'v1';

    /**
     * The error codes the public contract exposes.
     *
     * @var list<string>
     */
    private const PUBLIC_ERROR_CODES = ['invalid_url', 'transport_failure'];

    /**
     * Build a successful envelope around response data.
     *
     * @param array<mixed> $data      The whitelisted response data.
     * @param string       $requestId The request identifier.
     *
     * @return array<string, mixed> The v1 success envelope.
     */
    public function success(array $data, string $requestId): array
    {
        return [
            'schemaVersion' => self::SCHEMA_VERSION,
            'requestId' => $requestId,
            'success' => true,
            'data' => $data,
            'errors' => [],
        ];
    }

    /**
     * Build an error envelope for a single public error.
     *
     * @param string $code      The stable public error code.
     * @param string $message   The user-facing message.
     * @param string $requestId The request identifier.
     *
     * @return array<string, mixed> The v1 error envelope.
     */
    public function error(string $code, string $message, string $requestId): array
    {
        return [
            'schemaVersion' => self::SCHEMA_VERSION,
            'requestId' => $requestId,
            'success' => false,
            'data' => null,
            'errors' => [
                ['code' => $code, 'message' => $message],
            ],
        ];
    }

    /**
     * Build an error envelope for multiple validation errors.
     *
     * @param list<array{code: string, message: string}> $errors    The
     *                                                              errors.
     * @param string                                     $requestId The request
     *                                                              identifier.
     *
     * @return array<string, mixed> The v1 error envelope.
     */
    public function errors(array $errors, string $requestId): array
    {
        return [
            'schemaVersion' => self::SCHEMA_VERSION,
            'requestId' => $requestId,
            'success' => false,
            'data' => null,
            'errors' => $errors,
        ];
    }

    /**
     * Present a complete detection report.
     *
     * Error reports map onto the public error contract using only their
     * whitelisted code and message. Successful reports use the whitelisted
     * response data.
     *
     * @param DetectionReport $report    The domain report.
     * @param string          $requestId The request identifier.
     *
     * @return array<string, mixed> The v1 envelope.
     */
    public function present(DetectionReport $report, string $requestId): array
    {
        if ($report->hasError()) {
            $primary = $report->primaryError();
            $code = $primary?->code() ?? 'analysis_failed';

            if (!in_array($code, self::PUBLIC_ERROR_CODES, true)) {
                $code = 'analysis_failed';
            }

            return $this->error($code, (string) $primary?->message(), $requestId);
        }

        return $this->success($this->data($report), $requestId);
    }

    /**
     * Project the whitelisted response data from a report.
     *
     * Only safe, normalized fields are emitted: website facts, the summary
     * headline fields, and detection time. Theme, plugins, and technologies
     * are drawn from the canonical summary and theme metadata.
     *
     * @param DetectionReport $report The domain report.
     *
     * @return array<string, mixed> The whitelisted data payload.
     */
    public function data(DetectionReport $report): array
    {
        $summary = $report->summary();
        $website = $report->websiteInformation();
        $theme = $report->themeMetadata();

        $technologies = [];
        $seen = [];

        foreach ($summary->technologies() as $technology) {
            $seen[$technology] = true;
            $technologies[] = [
                'name' => $technology,
                'confidence' => $summary->confidenceForTechnology($technology),
            ];
        }

        foreach ($report->technologies() as $detected) {
            $name = $detected->name();

            if (isset($seen[$name])) {
                continue;
            }

            $seen[$name] = true;
            $technologies[] = [
                'name' => $name,
                'confidence' => $detected->confidence(),
            ];
        }

        return [
            'website' => [
                'url' => $website->url(),
                'finalUrl' => $website->finalUrl(),
                'statusCode' => $website->statusCode(),
            ],
            'cms' => $summary->cms(),
            'cmsConfidence' => $summary->cmsConfidence(),
            'theme' => $theme === null ? null : [
                'name' => $theme->name(),
                'version' => $theme->version(),
                'author' => $theme->author(),
            ],
            'plugins' => $summary->plugins(),
            'technologies' => $technologies,
            'detectionConfidence' => $summary->detectionConfidence(),
            'detectionTimeMs' => (int) round($report->detectionTime() * 1000),
        ];
    }
}
