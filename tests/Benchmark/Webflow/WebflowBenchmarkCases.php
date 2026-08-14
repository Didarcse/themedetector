<?php

declare(strict_types=1);

namespace Tests\Benchmark\Webflow;

use Tests\Benchmark\BenchmarkCase;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;

/**
 * Benchmark cases for Webflow websites.
 *
 * Represents real-world Webflow sites. Every fixture carries the Webflow
 * generator meta tag, Webflow CDN asset URLs, and the window.Webflow
 * JavaScript fingerprint so the detection engines can be measured against
 * a realistic Webflow page. Webflow has no CMS theme concept, so no theme
 * is expected.
 *
 * Design philosophy:
 *
 * - Each case is a self-contained, offline HTML fixture: no HTTP.
 * - Ground truth is explicit: the expected CMS, and empty theme and plugin
 *   sets.
 * - Stateless, deterministic, and side-effect free.
 */
final class WebflowBenchmarkCases implements BenchmarkCaseProvider
{
    /**
     * Return the Webflow benchmark cases.
     *
     * @return list<BenchmarkCase> The Webflow cases.
     */
    public function cases(): array
    {
        return [
            new BenchmarkCase(
                name: 'webflow.site.agency',
                category: 'website',
                url: 'https://www.lumina-design.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Lumina Design Co.</title>' . "\n"
                    . '    <meta name="generator" content="Webflow">' . "\n"
                    . '    <link rel="stylesheet" href="https://assets.website-files.com/61a2b3c4d5e6f7a8b9c0d1e2/css/normalize.css">' . "\n"
                    . '    <script src="https://assets.website-files.com/61a2b3c4d5e6f7a8b9c0d1e2/js/lumina.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="hero wf-section"><h1>Design that moves you</h1></div>' . "\n"
                    . '    <script>window.Webflow = window.Webflow || []; Webflow.push([\'init\', \'ix2\']);</script>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'Webflow',
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'webflow.site.saas',
                category: 'website',
                url: 'https://www.trackr.app',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Trackr — Time tracking</title>' . "\n"
                    . '    <meta name="generator" content="Webflow">' . "\n"
                    . '    <script src="https://cdn.prod.website-files.com/71c2b3c4d5e6f7a8b9c0d1e2/js/trackr.js"></script>' . "\n"
                    . '    <link rel="stylesheet" href="https://cdn.prod.website-files.com/71c2b3c4d5e6f7a8b9c0d1e2/css/trackr.webflow.css">' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="navbar"><h1>Track your time</h1></div>' . "\n"
                    . '    <script>Webflow.require(\'slider\').init();</script>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'Webflow',
                expectedTheme: null,
                expectedPlugins: [],
            ),
        ];
    }

    /**
     * Return the platform this provider covers.
     *
     * @return string The platform name.
     */
    public function platform(): string
    {
        return 'Webflow';
    }
}
