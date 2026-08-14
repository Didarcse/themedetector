<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction;

use App\Core\Container;
use App\Modules\Http\HttpClientInterface;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeExtractor;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeLocator;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeMetadataMapper;
use App\Modules\ThemeExtraction\Shopify\ShopifyThemeParser;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssDownloader;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssLocator;
use App\Modules\ThemeExtraction\WordPress\WordPressStyleCssParser;
use App\Modules\ThemeExtraction\WordPress\WordPressThemeExtractor;
use App\Modules\ThemeExtraction\WordPress\WordPressThemeMetadataMapper;

/**
 * Assembles the production-ready ThemeExtractorRegistry for the Theme
 * Extraction Engine.
 *
 * ThemeExtractorRegistryFactory wires every supported theme extractor into
 * a single ThemeExtractorRegistry, resolving shared collaborators such as
 * the HTTP client from the container. It is the composition point the
 * ThemeExtractionServiceProvider architecture prescribes for introducing
 * extractors without modifying the provider.
 *
 * Responsibilities:
 *
 * - Build every supported theme extractor with its pipeline.
 * - Resolve shared collaborators (HTTP client) from the container.
 * - Return an immutable, fully populated ThemeExtractorRegistry.
 *
 * Design philosophy:
 *
 * - Factory: object creation is centralized and reusable.
 * - Composition Root: extractor wiring happens exclusively here.
 * - Single Responsibility Principle: assembling the registry is the only
 *   concern; it performs no extraction.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class ThemeExtractorRegistryFactory
{
    /**
     * Build the fully populated ThemeExtractorRegistry.
     *
     * @param Container $container The application dependency injection
     *                             container used to resolve the HTTP client
     *                             shared by the theme stylesheet downloader.
     *
     * @return ThemeExtractorRegistry The registry containing every
     *                                supported theme extractor.
     */
    public function create(Container $container): ThemeExtractorRegistry
    {
        $httpClient = $container->get(HttpClientInterface::class);

        return new ThemeExtractorRegistry([
            new WordPressThemeExtractor(
                new WordPressStyleCssLocator(),
                new WordPressStyleCssDownloader($httpClient),
                new WordPressStyleCssParser(),
                new WordPressThemeMetadataMapper(),
            ),
            new ShopifyThemeExtractor(
                new ShopifyThemeLocator(),
                new ShopifyThemeParser(),
                new ShopifyThemeMetadataMapper(),
            ),
        ]);
    }
}
