<?php

declare(strict_types=1);

namespace App\Api;

/**
 * Strict schema validation for the public API request body.
 *
 * ApiRequestValidator enforces the POST /api/v1/detect request contract:
 * the body must be a JSON object with a single string "url" field, no
 * unknown fields, a trimmed non-empty value of at most 2048 characters,
 * and a valid http(s) URL. Scheme inference mirrors the existing analyzer
 * so a scheme-less host is treated as https.
 *
 * Responsibilities:
 *
 * - Validate the request body against the strict schema.
 * - Reject unknown fields.
 * - Normalize the URL using the existing scheme-inference rules.
 * - Produce machine-readable validation errors.
 *
 * Design philosophy:
 *
 * - Boundary only: it validates the request contract and contains no
 *   detection, extraction, or business logic.
 * - Strict schema: unknown fields are rejected so the API surface stays
 *   stable.
 * - Stateless, deterministic, and side-effect free.
 */
final class ApiRequestValidator
{
    public const MAX_URL_LENGTH = 2048;

    /**
     * Validate a decoded JSON request body.
     *
     * @param mixed $body The decoded JSON body.
     *
     * @return ApiRequestValidation The validation outcome.
     */
    public function validate(mixed $body): ApiRequestValidation
    {
        if (!is_array($body)) {
            return new ApiRequestValidation(false, [[
                'code' => 'body_not_object',
                'message' => 'The request body must be a JSON object.',
            ]]);
        }

        if (array_is_list($body)) {
            return new ApiRequestValidation(false, [[
                'code' => 'body_not_object',
                'message' => 'The request body must be a JSON object.',
            ]]);
        }

        $errors = $this->fieldErrors($body);

        if ($errors !== []) {
            return new ApiRequestValidation(false, $errors);
        }

        $url = $this->validatedUrl($body);

        return new ApiRequestValidation(true, [], $url ?? '');
    }

    /**
     * Validate the "url" field and reject unknown fields.
     *
     * @param array<mixed> $body The decoded JSON object.
     *
     * @return list<array{code: string, message: string}> The errors, empty
     *                                                    when valid.
     */
    private function fieldErrors(array $body): array
    {
        $errors = [];

        foreach (array_keys($body) as $field) {
            if ($field !== 'url') {
                $errors[] = [
                    'code' => 'unknown_field',
                    'message' => sprintf('Unknown field [%s] is not allowed.', (string) $field),
                ];
            }
        }

        if (!array_key_exists('url', $body)) {
            $errors[] = [
                'code' => 'url_required',
                'message' => 'The "url" field is required.',
            ];

            return $errors;
        }

        $url = $body['url'];

        if (!is_string($url)) {
            $errors[] = [
                'code' => 'url_invalid_type',
                'message' => 'The "url" field must be a string.',
            ];

            return $errors;
        }

        $url = trim($url);

        if ($url === '') {
            $errors[] = [
                'code' => 'url_empty',
                'message' => 'The "url" field must not be empty.',
            ];

            return $errors;
        }

        if (strlen($url) > self::MAX_URL_LENGTH) {
            $errors[] = [
                'code' => 'url_too_long',
                'message' => sprintf('The "url" field must not exceed %d characters.', self::MAX_URL_LENGTH),
            ];

            return $errors;
        }

        if ($this->normalizeUrl($url) === null) {
            $errors[] = [
                'code' => 'url_invalid_format',
                'message' => 'The "url" field must be a valid http(s) URL.',
            ];
        }

        return $errors;
    }

    /**
     * Return the normalized URL of a validated body.
     *
     * Mirrors fieldErrors(): null is returned whenever the "url" field is
     * missing, not a string, empty, too long, or not a valid http(s) URL.
     *
     * @param array<mixed> $body The decoded JSON object.
     *
     * @return string|null The normalized URL, or null when invalid.
     */
    private function validatedUrl(array $body): ?string
    {
        $url = $body['url'] ?? null;

        if (!is_string($url)) {
            return null;
        }

        $url = trim($url);

        if ($url === '' || strlen($url) > self::MAX_URL_LENGTH) {
            return null;
        }

        return $this->normalizeUrl($url);
    }

    /**
     * Normalize and validate a submitted URL.
     *
     * A missing scheme is inferred as HTTPS before validation. Only explicit
     * http/https schemes are accepted: any other explicit scheme (ftp, file,
     * gopher, ...) is rejected so an unsupported scheme can never reach the
     * detection pipeline. The inference rules intentionally mirror the
     * existing analyzer's normalization so the request boundary and the
     * detection pipeline agree on validity.
     *
     * @param string $url The raw submitted URL.
     *
     * @return string|null The normalized valid URL, or null when invalid.
     */
    private function normalizeUrl(string $url): ?string
    {
        $url = trim($url);

        if ($url === '') {
            return null;
        }

        if (preg_match('#^[a-z][a-z0-9+.\-]*://#i', $url) === 1) {
            if (preg_match('#^https?://#i', $url) !== 1) {
                return null;
            }
        } else {
            $url = 'https://' . $url;
        }

        $validated = filter_var($url, FILTER_VALIDATE_URL);

        return $validated === false ? null : $url;
    }
}
