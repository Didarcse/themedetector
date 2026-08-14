<?php

declare(strict_types=1);

namespace Tests\Benchmark\Squarespace;

use Tests\Benchmark\BenchmarkCase;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;

/**
 * Benchmark cases for Squarespace websites.
 *
 * Represents real-world Squarespace sites. Every fixture carries evidence
 * the production Squarespace detection rules actually recognise: the
 * generator meta tag, Squarespace asset hostnames, the Squarespace.load
 * JavaScript fingerprint, and Squarespace-specific data attributes.
 * Negative cases carry generic YUI/Y.use markup and a generic
 * data-section-id attribute, which must never be mistaken for Squarespace
 * evidence.
 *
 * Design philosophy:
 *
 * - Each case is a self-contained, offline HTML fixture: no HTTP.
 * - Ground truth is explicit: the expected CMS, and empty theme and plugin
 *   sets.
 * - Stateless, deterministic, and side-effect free.
 */
final class SquarespaceBenchmarkCases implements BenchmarkCaseProvider
{
    /**
     * Return the Squarespace benchmark cases.
     *
     * @return list<BenchmarkCase> The Squarespace cases.
     */
    public function cases(): array
    {
        return [
            new BenchmarkCase(
                name: 'squarespace.site.photography',
                category: 'squarespace-site',
                url: 'https://www.cinder-blank.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Cinder Blank</title>' . "\n"
                    . '    <meta name="generator" content="Squarespace 7.1">' . "\n"
                    . '    <link rel="stylesheet" href="https://static1.'
                    . 'squarespace.com/static/61a2b3c4/62c.css">' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <section data-animation-role="header-element">' . "\n"
                    . '        <h1>Portfolio</h1>' . "\n"
                    . '    </section>' . "\n"
                    . '    <script>' . "\n"
                    . '        Squarespace.load(window);' . "\n"
                    . '    </script>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'Squarespace',
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'squarespace.site.retail',
                category: 'squarespace-site',
                url: 'https://www.kestrel-supply.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Kestrel Supply</title>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <main>' . "\n"
                    . '        <img src="https://images.squarespace-cdn.com/'
                    . 'content/v1/5f2/items/chair.jpg" alt="Chair">' . "\n"
                    . '        <div class="sqs-commerce" data-current-styles="{}">' . "\n"
                    . '            <h2>Shop the collection</h2>' . "\n"
                    . '        </div>' . "\n"
                    . '    </main>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'Squarespace',
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'squarespace.negative.generic-yui',
                category: 'negative',
                url: 'https://www.loom-and-line.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Loom and Line</title>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <section data-section-id="hero-1">' . "\n"
                    . '        <h1>Handwoven textiles</h1>' . "\n"
                    . '    </section>' . "\n"
                    . '    <script>' . "\n"
                    . '        YUI().use(\'node-base\', function (Y) { '
                    . 'Y.all(\'.section\').addClass(\'ready\'); });' . "\n"
                    . '    </script>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: null,
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'squarespace.negative.generic-squarespace-class',
                category: 'negative',
                url: 'https://www.foxglove-studio.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Foxglove Studio</title>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="squarespace-layout">' . "\n"
                    . '        <h1>Design studio</h1>' . "\n"
                    . '        <p>Brand, print, and web.</p>' . "\n"
                    . '    </div>' . "\n"
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
        return 'Squarespace';
    }
}
