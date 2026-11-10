<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Security\CsrfGuard;

/**
 * Renders the Detection Flow loading page.
 *
 * LoadingController is the entry point of the detection flow between the
 * homepage and the detection report. A POST submission is CSRF-protected
 * and starts the automatic loading workflow; a GET renders a manual Start
 * action so a cross-site navigation can never consume detection resources
 * automatically. The controller accepts the URL from the POST body or the
 * query string and contains no detection logic.
 *
 * Design philosophy:
 *
 * - Orchestrator: it reads the input, validates it, and renders the
 *   loading page. It performs no analysis.
 * - Single Responsibility Principle: accepting the URL submission and
 *   rendering the loading page is its only concern.
 */
final class LoadingController
{
    public function __construct(
        private readonly CsrfGuard $csrf,
    ) {
    }

    public function __invoke(): Response
    {
        $request = $this->request();
        $isPost = $request->method() === 'POST';

        if ($isPost) {
            $rejection = $this->csrf->reject($request);

            if ($rejection !== null) {
                return $rejection;
            }
        }

        $url = $this->urlFromRequest($request);

        return Response::html(view('loading', [
            'url' => $url,
            'invalid' => !$this->isValidUrl($url),
            'autoStart' => $isPost,
            'token' => csrf_token(),
            'pageTitle' => 'Analyzing Website',
            'pageDescription' => 'Detecting the CMS, theme, and plugins behind '
                . ($url !== '' ? $url : 'your website') . '.',
            'robots' => 'noindex, nofollow',
            'activeNav' => 'home',
        ], 'layouts.app'));
    }

    /**
     * Read the submitted URL from the current request.
     *
     * @param Request $request The current request.
     *
     * @return string The submitted URL, or an empty string when absent.
     */
    private function urlFromRequest(Request $request): string
    {
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
