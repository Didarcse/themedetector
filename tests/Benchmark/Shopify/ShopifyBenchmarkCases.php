<?php

declare(strict_types=1);

namespace Tests\Benchmark\Shopify;

use Tests\Benchmark\BenchmarkCase;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;

/**
 * Benchmark cases for Shopify stores.
 *
 * Represents real-world Shopify storefronts running Online Store 2.0
 * themes. Every fixture carries the canonical Shopify CDN asset URLs, the
 * standard theme asset filenames, and the window.Shopify JavaScript global
 * so the detection engines can be measured against a realistic Shopify
 * page. Shopify store themes are not reported by the CMS detection engine,
 * so no theme is expected.
 *
 * Design philosophy:
 *
 * - Each case is a self-contained, offline HTML fixture: no HTTP.
 * - Ground truth is explicit: the expected CMS, and empty theme and plugin
 *   sets.
 * - Stateless, deterministic, and side-effect free.
 */
final class ShopifyBenchmarkCases implements BenchmarkCaseProvider
{
    /**
     * Return the Shopify benchmark cases.
     *
     * @return list<BenchmarkCase> The Shopify cases.
     */
    public function cases(): array
    {
        return [
            new BenchmarkCase(
                name: 'shopify.store.fashion',
                category: 'storefront',
                url: 'https://www.northwind-store.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Northwind Store</title>' . "\n"
                    . '    <link rel="stylesheet" href="https://cdn.shopify.com/s/files/1/0001/2345/t/12/assets/base.css?v=123">' . "\n"
                    . '    <link rel="stylesheet" href="https://cdn.shopify.com/s/files/1/0001/2345/t/12/assets/theme.css">' . "\n"
                    . '    <script src="https://cdn.shopify.com/s/files/1/0001/2345/t/12/assets/theme.js"></script>' . "\n"
                    . '    <script src="https://cdn.shopify.com/s/files/1/0001/2345/t/12/assets/predictive-search.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <script>window.Shopify = { routes: { root: "/" } };</script>' . "\n"
                    . '    <main><h1>Featured products</h1></main>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'Shopify',
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'shopify.store.electronics',
                category: 'storefront',
                url: 'https://www.voltage-electronics.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Voltage Electronics</title>' . "\n"
                    . '    <link rel="stylesheet" href="https://cdn.shopify.com/s/files/1/0009/8765/t/8/assets/base.css?v=456">' . "\n"
                    . '    <link rel="stylesheet" href="https://cdn.shopify.com/s/files/1/0009/8765/t/8/assets/component-card.css">' . "\n"
                    . '    <script src="https://cdn.shopify.com/s/files/1/0009/8765/t/8/assets/global.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <script>window.Shopify = window.Shopify || { theme: { id: 8 } };</script>' . "\n"
                    . '    <main><h1>Gadgets and more</h1></main>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'Shopify',
                expectedTheme: null,
                expectedPlugins: [],
            ),
        ];
    }
}
