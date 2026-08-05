<?php

declare(strict_types=1);

namespace Tests\Benchmark\WordPress;

use Tests\Benchmark\BenchmarkCase;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;

/**
 * Benchmark cases for popular WordPress plugins.
 *
 * Represents real-world websites dominated by one widely installed plugin
 * (Contact Form 7, WooCommerce, Yoast SEO). Every fixture carries a
 * WordPress generator meta tag, a theme asset path, and the plugin asset
 * path so the plugin detection engine can be measured against the exact
 * slug expected.
 *
 * Design philosophy:
 *
 * - Each case is a self-contained, offline HTML fixture: no HTTP.
 * - Ground truth is explicit: the expected CMS, theme, and plugin set.
 * - Stateless, deterministic, and side-effect free.
 */
final class WordPressPopularPluginCases implements BenchmarkCaseProvider
{
    /**
     * Return the popular-plugin benchmark cases.
     *
     * @return list<BenchmarkCase> The popular-plugin cases.
     */
    public function cases(): array
    {
        return [
            new BenchmarkCase(
                name: 'wordpress.popular-plugin.contact-form-7',
                category: 'popular-plugin',
                url: 'https://www.example.org',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Example Organization</title>' . "\n"
                    . '    <meta name="generator" content="WordPress 6.5.5">' . "\n"
                    . '    <link rel="stylesheet" href="https://www.example.org/wp-content/themes/oceanwp/assets/css/style.min.css">' . "\n"
                    . '    <script src="https://www.example.org/wp-content/plugins/contact-form-7/includes/js/index.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="entry-content"><p>Contact us today.</p></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'WordPress',
                expectedTheme: 'OceanWP',
                expectedPlugins: ['contact-form-7'],
            ),
            new BenchmarkCase(
                name: 'wordpress.popular-plugin.woocommerce',
                category: 'popular-plugin',
                url: 'https://www.shopstore.dev',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Shop Store</title>' . "\n"
                    . '    <meta name="generator" content="WordPress 6.6.0">' . "\n"
                    . '    <link rel="stylesheet" href="https://www.shopstore.dev/wp-content/themes/storefront/assets/css/woocommerce/woocommerce.css">' . "\n"
                    . '    <script src="https://www.shopstore.dev/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="site-content"><h1>Everything you need</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'WordPress',
                expectedTheme: 'Storefront',
                expectedPlugins: ['woocommerce'],
            ),
            new BenchmarkCase(
                name: 'wordpress.popular-plugin.yoast-seo',
                category: 'popular-plugin',
                url: 'https://www.readme.io',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Read Me Blog</title>' . "\n"
                    . '    <meta name="generator" content="WordPress 6.7.1">' . "\n"
                    . '    <link rel="stylesheet" href="https://www.readme.io/wp-content/themes/twentytwentyfour/style.css">' . "\n"
                    . '    <script src="https://www.readme.io/wp-content/plugins/wordpress-seo/js/dist/yoast.min.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="entry-content"><h1>A blog about reading</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'WordPress',
                expectedTheme: 'Twenty Twenty-Four',
                expectedPlugins: ['wordpress-seo'],
            ),
        ];
    }
}
