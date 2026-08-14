<?php

declare(strict_types=1);

namespace Tests\Benchmark\Ghost;

use Tests\Benchmark\BenchmarkCase;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;

/**
 * Benchmark cases for Ghost publications.
 *
 * Represents real-world Ghost blogs and magazines. Every fixture carries
 * evidence the production Ghost detection rules actually recognise: the
 * generator meta tag, /assets/built/ asset paths, Ghost HTML signatures,
 * the Ghost content API endpoint, and the window.Ghost/ghost.init
 * JavaScript fingerprints. Negative cases carry a bare /ghost/ path and
 * the bare word "Ghost", which must never be mistaken for Ghost evidence.
 *
 * Design philosophy:
 *
 * - Each case is a self-contained, offline HTML fixture: no HTTP.
 * - Ground truth is explicit: the expected CMS, and empty theme and plugin
 *   sets.
 * - Stateless, deterministic, and side-effect free.
 */
final class GhostBenchmarkCases implements BenchmarkCaseProvider
{
    /**
     * Return the Ghost benchmark cases.
     *
     * @return list<BenchmarkCase> The Ghost cases.
     */
    public function cases(): array
    {
        return [
            new BenchmarkCase(
                name: 'ghost.site.cookbook',
                category: 'ghost-site',
                url: 'https://www.heartwood-cookbook.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Heartwood Cookbook</title>' . "\n"
                    . '    <meta name="generator" content="Ghost 5.100">' . "\n"
                    . '    <link rel="stylesheet" href="/assets/built/screen.css">' . "\n"
                    . '    <script src="/assets/built/source.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="site">' . "\n"
                    . '        <div class="ghost-head">' . "\n"
                    . '            <article class="kg-card kg-width-wide">' . "\n"
                    . '                <p>Seasonal recipes from the forest.</p>' . "\n"
                    . '            </article>' . "\n"
                    . '        </div>' . "\n"
                    . '    </div>' . "\n"
                    . '    <script>' . "\n"
                    . '        window.Ghost = {};' . "\n"
                    . '    </script>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'Ghost',
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'ghost.site.photography',
                category: 'ghost-site',
                url: 'https://www.midnight-shutter.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Midnight Shutter</title>' . "\n"
                    . '    <link rel="stylesheet" href="/assets/built/screen.css">' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <main><h1>Photography after dark</h1></main>' . "\n"
                    . '    <script>' . "\n"
                    . '        const contentApi = \'/ghost/api/content/posts/?key=abc123\';' . "\n"
                    . '        ghost.init({});' . "\n"
                    . '    </script>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'Ghost',
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'ghost.negative.generic-ghost-path',
                category: 'negative',
                url: 'https://www.olde-cellar-blog.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Olde Cellar Blog</title>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <main>' . "\n"
                    . '        <h1>Welcome to our spooky corner</h1>' . "\n"
                    . '        <p>Ever seen a real ghost? We share stories '
                    . 'about the ghost of Olde Cellar Hall.</p>' . "\n"
                    . '        <a href="/ghost/tales">Ghost tales archive</a>' . "\n"
                    . '    </main>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: null,
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'ghost.negative.generic-assets-path',
                category: 'negative',
                url: 'https://www.harbour-lights.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Harbour Lights</title>' . "\n"
                    . '    <link rel="stylesheet" href="/assets/screen.css">' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <main><h1>Lighthouse keeper notes</h1></main>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: null,
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
        return 'Ghost';
    }
}
