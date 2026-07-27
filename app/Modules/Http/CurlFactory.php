<?php

declare(strict_types=1);

namespace App\Modules\Http;

/**
 * Factory for creating pre-configured cURL handles.
 *
 * Centralises default cURL options so every request shares a consistent
 * transport configuration. Used by HttpClient.
 */
final class CurlFactory
{
    private function __construct() {}

    /**
     * Create and return a fully configured cURL handle.
     */
    public static function create(): \CurlHandle
    {
        $handle = curl_init();

        if ($handle === false) {
            throw new HttpException('Failed to initialize cURL.');
        }

        curl_setopt_array($handle, [
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_FOLLOWLOCATION  => true,
            CURLOPT_MAXREDIRS       => 10,
            CURLOPT_CONNECTTIMEOUT  => 10,
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_ENCODING        => '',
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_2TLS,
            CURLOPT_SSL_VERIFYPEER  => true,
            CURLOPT_SSL_VERIFYHOST  => 2,
            CURLOPT_USERAGENT       => UserAgent::random(),
            CURLOPT_HEADER          => true,
            CURLOPT_FAILONERROR     => false,
            CURLOPT_IPRESOLVE       => CURL_IPRESOLVE_WHATEVER,
        ]);

        return $handle;
    }
}
