<?php

declare(strict_types=1);

namespace App\Controllers;

/**
 * Renders the application About page.
 *
 * AboutController is the entry point of the About page. It renders the
 * about view, which explains what ThemeDetectorTool does, how detection
 * works, and which platforms are supported.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: rendering the About page is its only
 *   concern. It contains no business logic.
 * - Stateless and deterministic: given the same state it always renders
 *   the same page.
 */
final class AboutController
{
    public function __invoke(): string
    {
        return view('about', [
            'pageTitle' => 'About',
            'pageDescription' => 'ThemeDetectorTool reveals the CMS, theme, theme version, author, and active '
                . 'plugins behind any public website in seconds and without an account.',
            'canonicalUrl' => canonical_url('/about'),
            'ogUrl' => canonical_url('/about'),
            'activeNav' => 'about',
        ], 'layouts.app');
    }
}
