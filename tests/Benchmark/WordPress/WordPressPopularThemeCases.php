<?php

declare(strict_types=1);

namespace Tests\Benchmark\WordPress;

use Tests\Benchmark\BenchmarkCase;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;

/**
 * Benchmark cases for popular WordPress themes.
 *
 * Represents real-world websites running popular free themes (Astra,
 * GeneratePress, Kadence). Every fixture carries a WordPress generator meta
 * tag, a theme asset path, and a plugin asset path so the detection
 * engines can be measured against a realistic, complete WordPress page.
 *
 * Design philosophy:
 *
 * - Each case is a self-contained, offline HTML fixture: no HTTP.
 * - Ground truth is explicit: the expected CMS, theme, and plugin set.
 * - Stateless, deterministic, and side-effect free.
 */
final class WordPressPopularThemeCases implements BenchmarkCaseProvider
{
    /**
     * Return the popular-theme benchmark cases.
     *
     * @return list<BenchmarkCase> The popular-theme cases.
     */
    public function cases(): array
    {
        return [
            new BenchmarkCase(
                name: 'wordpress.popular-theme.astra',
                category: 'popular-theme',
                url: 'https://www.acme-agency.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Acme Digital Agency</title>' . "\n"
                    . '    <meta name="generator" content="WordPress 6.7.1">' . "\n"
                    . '    <link rel="stylesheet" href="https://www.acme-agency.com/wp-content/themes/astra/assets/css/main.min.css">' . "\n"
                    . '    <script src="https://www.acme-agency.com/wp-content/plugins/contact-form-7/includes/js/index.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="ast-container"><h1>Building better brands</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'WordPress',
                expectedTheme: 'Astra',
                expectedPlugins: ['contact-form-7'],
            ),
            new BenchmarkCase(
                name: 'wordpress.popular-theme.generatepress',
                category: 'popular-theme',
                url: 'https://www.fresh-look.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Fresh Look Studio</title>' . "\n"
                    . '    <meta name="generator" content="WordPress 6.6.2">' . "\n"
                    . '    <link rel="stylesheet" href="https://www.fresh-look.com/wp-content/themes/generatepress/assets/css/all.min.css">' . "\n"
                    . '    <script src="https://www.fresh-look.com/wp-content/plugins/woocommerce/assets/js/frontend/cart.min.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="site grid-container"><h1>Fresh styles every week</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'WordPress',
                expectedTheme: 'GeneratePress',
                expectedPlugins: ['woocommerce'],
            ),
            new BenchmarkCase(
                name: 'wordpress.popular-theme.kadence',
                category: 'popular-theme',
                url: 'https://www.northcreek.io',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>North Creek Consulting</title>' . "\n"
                    . '    <meta name="generator" content="WordPress 6.7.0">' . "\n"
                    . '    <link rel="stylesheet" href="https://www.northcreek.io/wp-content/themes/kadence/assets/css/kadence-content.min.css">' . "\n"
                    . '    <script src="https://www.northcreek.io/wp-content/plugins/akismet/_inc/akismet.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <div class="entry-content"><h1>Strategy that moves companies</h1></div>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'WordPress',
                expectedTheme: 'Kadence',
                expectedPlugins: ['akismet'],
            ),
        ];
    }
}
