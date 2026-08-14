<?php

declare(strict_types=1);

namespace Tests\Benchmark\Drupal;

use Tests\Benchmark\BenchmarkCase;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;

/**
 * Benchmark cases for Drupal websites.
 *
 * Represents real-world Drupal sites. Every fixture carries evidence the
 * production Drupal detection rules actually recognise: the generator meta
 * tag, /core/ and /themes/ asset paths, Drupal HTML signatures, and the
 * drupalSettings/Drupal.behaviors JavaScript fingerprints. Negative cases
 * carry generic CMS-agnostic paths such as /node/, /entity/, and
 * /user/login, which must never be mistaken for Drupal evidence.
 * Drupal themes are not reported by the CMS detection engine; the theme
 * extraction engine reports the theme directory name located from a
 * root-anchored /themes/contrib/{slug}/ or /themes/custom/{slug}/ path.
 * The newsroom case carries such a path and expects the theme newsroom,
 * while every other case carries no theme evidence and expects no theme.
 *
 * Design philosophy:
 *
 * - Each case is a self-contained, offline HTML fixture: no HTTP.
 * - Ground truth is explicit: the expected CMS, theme, and empty plugin
 *   sets.
 * - Stateless, deterministic, and side-effect free.
 */
final class DrupalBenchmarkCases implements BenchmarkCaseProvider
{
    /**
     * Return the Drupal benchmark cases.
     *
     * @return list<BenchmarkCase> The Drupal cases.
     */
    public function cases(): array
    {
        return [
            new BenchmarkCase(
                name: 'drupal.site.municipal',
                category: 'drupal-site',
                url: 'https://www.northgate-municipality.gov',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Northgate Municipality</title>' . "\n"
                    . '    <meta name="generator" content="Drupal 11 (https://www.drupal.org)">' . "\n"
                    . '    <script src="/core/misc/drupal.js"></script>' . "\n"
                    . '    <script src="/core/misc/drupalSettingsLoader.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div data-drupal-selector="edit-submit">' . "\n"
                    . '        <a href="/node/1">Read more</a>' . "\n"
                    . '    </div>' . "\n"
                    . '    <script>' . "\n"
                    . '        window.drupalSettings = {path: {baseUrl: \'/\'}};' . "\n"
                    . '    </script>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'Drupal',
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'drupal.site.newsroom',
                category: 'drupal-site',
                url: 'https://www.freshpicks-news.org',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Fresh Picks Newsroom</title>' . "\n"
                    . '    <link rel="stylesheet" href="/themes/custom/newsroom/css/main.css">' . "\n"
                    . '    <link rel="alternate" type="application/json" href="/jsonapi/node/article">' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <main><h1>Local stories</h1><p>Fresh, independent reporting.</p></main>' . "\n"
                    . '    <script>' . "\n"
                    . '        (function (Drupal) {' . "\n"
                    . '            Drupal.behaviors.newsroom = { attach: function () {} };' . "\n"
                    . '        }(window.Drupal));' . "\n"
                    . '    </script>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'Drupal',
                expectedTheme: 'newsroom',
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'drupal.negative.generic-paths',
                category: 'negative',
                url: 'https://www.collaborate-hub.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Collaborate Hub</title>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <nav>' . "\n"
                    . '        <a href="/user/login">Sign in</a>' . "\n"
                    . '        <a href="/node/1">Item</a>' . "\n"
                    . '        <a href="/entity/42">Entity</a>' . "\n"
                    . '    </nav>' . "\n"
                    . '    <main><h1>Work together</h1></main>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: null,
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'drupal.negative.generic-core-path',
                category: 'negative',
                url: 'https://www.buildkit.app',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>BuildKit</title>' . "\n"
                    . '    <link rel="stylesheet" href="/core/framework/base.css">' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <main><h1>Ship faster</h1><p>A lightweight app builder.</p></main>' . "\n"
                    . '    <script src="/assets/app.js"></script>' . "\n"
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
        return 'Drupal';
    }
}
