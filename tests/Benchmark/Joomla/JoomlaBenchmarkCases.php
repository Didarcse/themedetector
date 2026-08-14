<?php

declare(strict_types=1);

namespace Tests\Benchmark\Joomla;

use Tests\Benchmark\BenchmarkCase;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;

/**
 * Benchmark cases for Joomla websites.
 *
 * Represents real-world Joomla sites. Every fixture carries evidence the
 * production Joomla detection rules actually recognise: the generator meta
 * tag, qualified /media/ asset paths, Joomla HTML signatures, and the
 * window.Joomla JavaScript globals. Negative cases carry realistic generic
 * markup whose paths and text must never be mistaken for Joomla evidence.
 * Joomla themes are not reported by the CMS detection engine, so no theme
 * is expected.
 *
 * Design philosophy:
 *
 * - Each case is a self-contained, offline HTML fixture: no HTTP.
 * - Ground truth is explicit: the expected CMS, and empty theme and plugin
 *   sets.
 * - Stateless, deterministic, and side-effect free.
 */
final class JoomlaBenchmarkCases implements BenchmarkCaseProvider
{
    /**
     * Return the Joomla benchmark cases.
     *
     * @return list<BenchmarkCase> The Joomla cases.
     */
    public function cases(): array
    {
        return [
            new BenchmarkCase(
                name: 'joomla.site.resort',
                category: 'joomla-site',
                url: 'https://www.aquaterrace-resort.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Aqua Terrace Resort</title>' . "\n"
                    . '    <meta name="generator" content="Joomla! - Open Source '
                    . 'Content Management - Version 5.1.0">' . "\n"
                    . '    <script src="/media/system/js/core.js"></script>' . "\n"
                    . '    <script src="/media/system/js/mootools-core.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <main>' . "\n"
                    . '        <form action="/index.php?option=com_content&view=article" method="post">' . "\n"
                    . '            <input type="hidden" name="option" value="com_content">' . "\n"
                    . '        </form>' . "\n"
                    . '    </main>' . "\n"
                    . '    <script>' . "\n"
                    . '        window.Joomla = window.Joomla || {};' . "\n"
                    . '        Joomla.getOptions(\'system.paths\');' . "\n"
                    . '    </script>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'Joomla',
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'joomla.site.membership',
                category: 'joomla-site',
                url: 'https://www.evergreen-harvest.org',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Evergreen Harvest</title>' . "\n"
                    . '    <link rel="stylesheet" href="/media/com_home/assets/home.css">' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="joomla-toolbar-button">' . "\n"
                    . '        <button type="button">Publish</button>' . "\n"
                    . '    </div>' . "\n"
                    . '    <main><h1>Membership</h1><p>Join the harvest network.</p></main>' . "\n"
                    . '    <script>' . "\n"
                    . '        Joomla.submitbutton(\'contact.apply\');' . "\n"
                    . '    </script>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'Joomla',
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'joomla.negative.generic-api-templates',
                category: 'negative',
                url: 'https://www.foundation-corp.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Foundation Corp</title>' . "\n"
                    . '    <link rel="stylesheet" href="/templates/main.css">' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <header><h1>Foundation Corp</h1></header>' . "\n"
                    . '    <main><p>We build enterprise software.</p></main>' . "\n"
                    . '    <script src="/api/v1/widget.js"></script>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: null,
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'joomla.negative.generic-media-prefix',
                category: 'negative',
                url: 'https://www.urban-gardens.net',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Urban Gardens</title>' . "\n"
                    . '    <meta name="generator" content="Eleventy">' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <img src="/media/img/logo.png" alt="Urban Gardens logo">' . "\n"
                    . '    <main><h1>Plants for small spaces</h1></main>' . "\n"
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
        return 'Joomla';
    }
}
