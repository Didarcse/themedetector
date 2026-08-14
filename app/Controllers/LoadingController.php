<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Request;

/**
 * Renders the Detection Flow loading page.
 *
 * LoadingController is the entry point of the detection flow between the
 * homepage and the detection report. It accepts the submitted URL from the
 * POST body or the query string, validates it, and renders the loading
 * view. The loading view drives the client-side progress animation and
 * then performs the actual analysis through the existing report endpoint,
 * so this controller contains no detection logic.
 *
 * Design philosophy:
 *
 * - Orchestrator: it reads the input, validates it, and renders the
 *   loading page. It performs no analysis.
 * - Single Responsibility Principle: accepting the URL submission and
 *   rendering the loading page is its only concern.
 * - Stateless: the controller holds no request or session state.
 */
final class LoadingController
{
    public function __invoke(): string
    {
        $url = $this->urlFromRequest();

        return view('loading', [
            'url' => $url,
            'invalid' => !$this->isValidUrl($url),
            'pageTitle' => 'Analyzing Website',
            'pageDescription' => 'Detecting the CMS, theme, and plugins behind '
                . ($url !== '' ? $url : 'your website') . '.',
            'robots' => 'noindex, nofollow',
            'activeNav' => 'home',
        ], 'layouts.app');
    }

    /**
     * Read the submitted URL from the current request.
     *
     * Prefers the Request registered in the container (set by the HTTP
     * entry point) and falls back to rebuilding the request from the
     * globals for CLI contexts.
     *
     * @return string The submitted URL, or an empty string when absent.
     */
    private function urlFromRequest(): string
    {
        $request = $this->request();

        $url = $request->input('url', '');

        if (!is_string($url) || $url === '') {
            $url = $request->queryParam('url', '');
        }

        return is_string($url) ? trim($url) : '';
    }

    private function request(): Request
    {
        $container = app();

        if ($container->has(Request::class)) {
            return $container->get(Request::class);
        }

        return Request::fromGlobals();
    }

    /**
     * Validate a submitted URL.
     *
     * Mirrors the URL normalization used by the detection analyzer: a
     * missing scheme is inferred as HTTPS before validation.
     *
     * @param string $url The raw submitted URL.
     *
     * @return bool True when the URL is valid.
     */
    private function isValidUrl(string $url): bool
    {
        if ($url === '') {
            return false;
        }

        if (preg_match('#^https?://#i', $url) !== 1) {
            $url = 'https://' . $url;
        }

        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
}
