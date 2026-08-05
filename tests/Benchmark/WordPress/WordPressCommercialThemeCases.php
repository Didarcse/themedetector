<?php

declare(strict_types=1);

namespace Tests\Benchmark\WordPress;

use Tests\Benchmark\BenchmarkCase;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;

/**
 * Benchmark cases for commercial WordPress themes.
 *
 * Represents websites running paid/premium themes (Divi, Avada, BeTheme).
 * Every fixture carries a WordPress generator meta tag, the commercial
 * theme asset path, and a plugin asset path so the detection engines can
 * be measured against a realistic commercial WordPress page.
 *
 * Design philosophy:
 *
 * - Each case is a self-contained, offline HTML fixture: no HTTP.
 * - Ground truth is explicit: the expected CMS, theme, and plugin set.
 * - Stateless, deterministic, and side-effect free.
 */
final class WordPressCommercialThemeCases implements BenchmarkCaseProvider
{
    /**
     * Return the commercial-theme benchmark cases.
     *
     * @return list<BenchmarkCase> The commercial-theme cases.
     */
    public function cases(): array
    {
        return [
            new BenchmarkCase(
                name: 'wordpress.commercial-theme.divi',
                category: 'commercial-theme',
                url: 'https://www.buildtogether.net',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Build Together</title>' . "\n"
                    . '    <meta name="generator" content="WordPress 6.7.1">' . "\n"
                    . '    <link rel="stylesheet" href="https://www.buildtogether.net/wp-content/themes/Divi/style.css">' . "\n"
                    . '    <script src="https://www.buildtogether.net/wp-content/plugins/contact-form-7/includes/js/index.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="et_pb_section"><h1>We build together</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'WordPress',
                expectedTheme: 'Divi',
                expectedPlugins: ['contact-form-7'],
            ),
            new BenchmarkCase(
                name: 'wordpress.commercial-theme.avada',
                category: 'commercial-theme',
                url: 'https://www.ledgercorp.io',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Ledger Corp</title>' . "\n"
                    . '    <meta name="generator" content="WordPress 6.6.2">' . "\n"
                    . '    <link rel="stylesheet" href="https://www.ledgercorp.io/wp-content/themes/Avada/assets/css/style.min.css">' . "\n"
                    . '    <script src="https://www.ledgercorp.io/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="fusion-fullwidth"><h1>Accounting made simple</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'WordPress',
                expectedTheme: 'Avada',
                expectedPlugins: ['woocommerce'],
            ),
            new BenchmarkCase(
                name: 'wordpress.commercial-theme.betheme',
                category: 'commercial-theme',
                url: 'https://www.braveagency.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Brave Agency</title>' . "\n"
                    . '    <meta name="generator" content="WordPress 6.5.5">' . "\n"
                    . '    <link rel="stylesheet" href="https://www.braveagency.com/wp-content/themes/betheme/css/style.css">' . "\n"
                    . '    <script src="https://www.braveagency.com/wp-content/plugins/wordpress-seo/js/dist/yoast.min.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="section_wrapper"><h1>Brave ideas live here</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'WordPress',
                expectedTheme: 'BeTheme',
                expectedPlugins: ['wordpress-seo'],
            ),
        ];
    }
}
