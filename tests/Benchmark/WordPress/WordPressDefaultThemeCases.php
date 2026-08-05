<?php

declare(strict_types=1);

namespace Tests\Benchmark\WordPress;

use Tests\Benchmark\BenchmarkCase;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;

/**
 * Benchmark cases for default WordPress themes.
 *
 * Represents out-of-the-box WordPress installations running a bundled
 * default theme (Twenty Twenty-Five, Twenty Twenty-Four, Twenty
 * Seventeen). A fresh default install typically ships without plugins, so
 * every fixture carries a generator meta tag and a theme asset path but no
 * plugin asset path.
 *
 * Design philosophy:
 *
 * - Each case is a self-contained, offline HTML fixture: no HTTP.
 * - Ground truth is explicit: the expected CMS, theme, and empty plugin
 *   set.
 * - Stateless, deterministic, and side-effect free.
 */
final class WordPressDefaultThemeCases implements BenchmarkCaseProvider
{
    /**
     * Return the default-theme benchmark cases.
     *
     * @return list<BenchmarkCase> The default-theme cases.
     */
    public function cases(): array
    {
        return [
            new BenchmarkCase(
                name: 'wordpress.default-theme.twenty-twenty-five',
                category: 'default-theme',
                url: 'https://www.plainblog.net',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Plain Blog</title>' . "\n"
                    . '    <meta name="generator" content="WordPress 6.7.1">' . "\n"
                    . '    <link rel="stylesheet" href="https://www.plainblog.net/wp-content/themes/twentytwentyfive/assets/css/style.css">' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="wp-site-blocks"><h1>Hello world</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'WordPress',
                expectedTheme: 'Twenty Twenty-Five',
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'wordpress.default-theme.twenty-twenty-four',
                category: 'default-theme',
                url: 'https://www.personalnotes.me',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Personal Notes</title>' . "\n"
                    . '    <meta name="generator" content="WordPress 6.6.2">' . "\n"
                    . '    <link rel="stylesheet" href="https://www.personalnotes.me/wp-content/themes/twentytwentyfour/assets/css/style.css">' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="wp-site-blocks"><h1>My notes</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'WordPress',
                expectedTheme: 'Twenty Twenty-Four',
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'wordpress.default-theme.twenty-seventeen',
                category: 'default-theme',
                url: 'https://www.oldschool.wp',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Old School</title>' . "\n"
                    . '    <meta name="generator" content="WordPress 5.9.3">' . "\n"
                    . '    <link rel="stylesheet" href="https://www.oldschool.wp/wp-content/themes/twentyseventeen/style.css">' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="site-content"><h1>Retro thoughts</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'WordPress',
                expectedTheme: 'Twenty Seventeen',
                expectedPlugins: [],
            ),
        ];
    }
}
