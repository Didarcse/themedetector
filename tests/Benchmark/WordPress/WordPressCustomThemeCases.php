<?php

declare(strict_types=1);

namespace Tests\Benchmark\WordPress;

use Tests\Benchmark\BenchmarkCase;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;

/**
 * Benchmark cases for custom WordPress themes.
 *
 * Represents websites running bespoke, agency-built themes identified only
 * by a custom theme directory slug (my-agency-theme, my-blog-theme,
 * my-portfolio-theme). Every fixture carries a WordPress generator meta
 * tag, the custom theme asset path, and a plugin asset path.
 *
 * Design philosophy:
 *
 * - Each case is a self-contained, offline HTML fixture: no HTTP.
 * - Ground truth is explicit: the expected CMS, theme, and plugin set.
 * - Stateless, deterministic, and side-effect free.
 */
final class WordPressCustomThemeCases implements BenchmarkCaseProvider
{
    /**
     * Return the custom-theme benchmark cases.
     *
     * @return list<BenchmarkCase> The custom-theme cases.
     */
    public function cases(): array
    {
        return [
            new BenchmarkCase(
                name: 'wordpress.custom-theme.agency',
                category: 'custom-theme',
                url: 'https://www.blueprint.studio',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Blueprint Studio</title>' . "\n"
                    . '    <meta name="generator" content="WordPress 6.7.1">' . "\n"
                    . '    <link rel="stylesheet" href="https://www.blueprint.studio/wp-content/themes/my-agency-theme/assets/css/main.css">' . "\n"
                    . '    <script src="https://www.blueprint.studio/wp-content/plugins/contact-form-7/includes/js/index.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="page-wrap"><h1>Design that matters</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'WordPress',
                expectedTheme: 'My Agency Theme',
                expectedPlugins: ['contact-form-7'],
            ),
            new BenchmarkCase(
                name: 'wordpress.custom-theme.blog',
                category: 'custom-theme',
                url: 'https://www.dailyramblings.blog',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Daily Ramblings</title>' . "\n"
                    . '    <meta name="generator" content="WordPress 6.6.2">' . "\n"
                    . '    <link rel="stylesheet" href="https://www.dailyramblings.blog/wp-content/themes/my-blog-theme/style.css">' . "\n"
                    . '    <script src="https://www.dailyramblings.blog/wp-content/plugins/akismet/_inc/akismet.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="content"><h1>Random thoughts</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'WordPress',
                expectedTheme: 'My Blog Theme',
                expectedPlugins: ['akismet'],
            ),
            new BenchmarkCase(
                name: 'wordpress.custom-theme.portfolio',
                category: 'custom-theme',
                url: 'https://www.galleryofwork.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Gallery of Work</title>' . "\n"
                    . '    <meta name="generator" content="WordPress 6.5.5">' . "\n"
                    . '    <link rel="stylesheet" href="https://www.galleryofwork.com/wp-content/themes/my-portfolio-theme/assets/css/app.css">' . "\n"
                    . '    <script src="https://www.galleryofwork.com/wp-content/plugins/wordpress-seo/js/dist/yoast.min.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="portfolio"><h1>Selected works</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'WordPress',
                expectedTheme: 'My Portfolio Theme',
                expectedPlugins: ['wordpress-seo'],
            ),
        ];
    }
}
