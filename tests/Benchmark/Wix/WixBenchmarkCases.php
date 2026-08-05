<?php

declare(strict_types=1);

namespace Tests\Benchmark\Wix;

use Tests\Benchmark\BenchmarkCase;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;

/**
 * Benchmark cases for Wix websites.
 *
 * Represents real-world Wix sites built on the Wix editor. Every fixture
 * carries the Wix generator meta tag, Wix/Parastorage asset URLs, and the
 * Thunderbolt runtime fingerprints so the detection engines can be
 * measured against a realistic Wix page. Wix has no CMS theme concept, so
 * no theme is expected.
 *
 * Design philosophy:
 *
 * - Each case is a self-contained, offline HTML fixture: no HTTP.
 * - Ground truth is explicit: the expected CMS, and empty theme and plugin
 *   sets.
 * - Stateless, deterministic, and side-effect free.
 */
final class WixBenchmarkCases implements BenchmarkCaseProvider
{
    /**
     * Return the Wix benchmark cases.
     *
     * @return list<BenchmarkCase> The Wix cases.
     */
    public function cases(): array
    {
        return [
            new BenchmarkCase(
                name: 'wix.site.spa',
                category: 'website',
                url: 'https://www.bellaspa.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Bella Spa</title>' . "\n"
                    . '    <meta name="generator" content="Wix.com Website Builder">' . "\n"
                    . '    <link rel="stylesheet" href="https://static.wixstatic.com/media/61a2b3c4d5e6f7a8b9c0d1e2.css">' . "\n"
                    . '    <script src="https://static.parastorage.com/services/third-party/script.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <script>window.viewerModel = {"siteId":"61a2b3c4d5e6f7a8b9c0d1e2"};</script>' . "\n"
                    . '    <div id="PAGES_CONTAINER"><h1>Welcome to Bella Spa</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'Wix',
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'wix.site.restaurant',
                category: 'website',
                url: 'https://www.olive-express.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Olive Express</title>' . "\n"
                    . '    <meta name="generator" content="Wix">' . "\n"
                    . '    <script src="https://static.wixstatic.com/media/71c2b3c4d5e6f7a8b9c0d1e2.bundle.js"></script>' . "\n"
                    . '    <link rel="stylesheet" href="https://siteassets.parastorage.com/71c2b3c4d5e6f7a8b9c0d1e2/page.css">' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <script>window.__INITIAL_STATE__ = {"apps": {}}; window.clientSideRender = true;</script>' . "\n"
                    . '    <div id="SITE_ROOT"><h1>Fresh food, fast</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'Wix',
                expectedTheme: null,
                expectedPlugins: [],
            ),
        ];
    }
}
