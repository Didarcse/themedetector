<?php

declare(strict_types=1);

namespace App\Modules\Detection;

use App\Core\Container;
use App\Modules\Detection\Drupal\ConfidenceCalculator as DrupalConfidenceCalculator;
use App\Modules\Detection\Drupal\DrupalDetector;
use App\Modules\Detection\Drupal\Rules\ApiEndpointRule as DrupalApiEndpointRule;
use App\Modules\Detection\Drupal\Rules\AssetPathRule as DrupalAssetPathRule;
use App\Modules\Detection\Drupal\Rules\HtmlSignatureRule as DrupalHtmlSignatureRule;
use App\Modules\Detection\Drupal\Rules\MetaGeneratorRule as DrupalMetaGeneratorRule;
use App\Modules\Detection\Drupal\Rules\ScriptFingerprintRule as DrupalScriptFingerprintRule;
use App\Modules\Detection\Ghost\ConfidenceCalculator as GhostConfidenceCalculator;
use App\Modules\Detection\Ghost\GhostDetector;
use App\Modules\Detection\Ghost\Rules\ApiEndpointRule as GhostApiEndpointRule;
use App\Modules\Detection\Ghost\Rules\AssetPathRule as GhostAssetPathRule;
use App\Modules\Detection\Ghost\Rules\HtmlSignatureRule as GhostHtmlSignatureRule;
use App\Modules\Detection\Ghost\Rules\MetaGeneratorRule as GhostMetaGeneratorRule;
use App\Modules\Detection\Ghost\Rules\ScriptFingerprintRule as GhostScriptFingerprintRule;
use App\Modules\Detection\Joomla\ConfidenceCalculator as JoomlaConfidenceCalculator;
use App\Modules\Detection\Joomla\JoomlaDetector;
use App\Modules\Detection\Joomla\Rules\ApiEndpointRule as JoomlaApiEndpointRule;
use App\Modules\Detection\Joomla\Rules\AssetPathRule as JoomlaAssetPathRule;
use App\Modules\Detection\Joomla\Rules\HtmlSignatureRule as JoomlaHtmlSignatureRule;
use App\Modules\Detection\Joomla\Rules\MetaGeneratorRule as JoomlaMetaGeneratorRule;
use App\Modules\Detection\Joomla\Rules\ScriptFingerprintRule as JoomlaScriptFingerprintRule;
use App\Modules\Detection\Shopify\ConfidenceCalculator as ShopifyConfidenceCalculator;
use App\Modules\Detection\Shopify\Rules\CartEndpointRule;
use App\Modules\Detection\Shopify\Rules\CDNRule;
use App\Modules\Detection\Shopify\Rules\GlobalJsRule as ShopifyGlobalJsRule;
use App\Modules\Detection\Shopify\Rules\MetaGeneratorRule as ShopifyMetaGeneratorRule;
use App\Modules\Detection\Shopify\Rules\ShopifyAssetsRule;
use App\Modules\Detection\Shopify\Rules\ThemeAssetsRule;
use App\Modules\Detection\Shopify\ShopifyDetector;
use App\Modules\Detection\Squarespace\ConfidenceCalculator as SquarespaceConfidenceCalculator;
use App\Modules\Detection\Squarespace\Rules\AssetPathRule as SquarespaceAssetPathRule;
use App\Modules\Detection\Squarespace\Rules\CommerceRule;
use App\Modules\Detection\Squarespace\Rules\DataAttributesRule as SquarespaceDataAttributesRule;
use App\Modules\Detection\Squarespace\Rules\MetaGeneratorRule as SquarespaceMetaGeneratorRule;
use App\Modules\Detection\Squarespace\Rules\StaticJsRule;
use App\Modules\Detection\Squarespace\SquarespaceDetector;
use App\Modules\Detection\TYPO3\ConfidenceCalculator as Typo3ConfidenceCalculator;
use App\Modules\Detection\TYPO3\Rules\ApiEndpointRule as Typo3ApiEndpointRule;
use App\Modules\Detection\TYPO3\Rules\AssetPathRule as Typo3AssetPathRule;
use App\Modules\Detection\TYPO3\Rules\HtmlSignatureRule as Typo3HtmlSignatureRule;
use App\Modules\Detection\TYPO3\Rules\MetaGeneratorRule as Typo3MetaGeneratorRule;
use App\Modules\Detection\TYPO3\Rules\ScriptFingerprintRule as Typo3ScriptFingerprintRule;
use App\Modules\Detection\TYPO3\TYPO3Detector;
use App\Modules\Detection\Webflow\ConfidenceCalculator as WebflowConfidenceCalculator;
use App\Modules\Detection\Webflow\Rules\AssetPathRule as WebflowAssetPathRule;
use App\Modules\Detection\Webflow\Rules\DataAttributesRule as WebflowDataAttributesRule;
use App\Modules\Detection\Webflow\Rules\GlobalJsRule as WebflowGlobalJsRule;
use App\Modules\Detection\Webflow\Rules\MetaGeneratorRule as WebflowMetaGeneratorRule;
use App\Modules\Detection\Webflow\Rules\WebflowBadgeRule;
use App\Modules\Detection\Webflow\WebflowDetector;
use App\Modules\Detection\Wix\ConfidenceCalculator as WixConfidenceCalculator;
use App\Modules\Detection\Wix\Rules\AssetPathRule as WixAssetPathRule;
use App\Modules\Detection\Wix\Rules\GlobalJsRule as WixGlobalJsRule;
use App\Modules\Detection\Wix\Rules\MetaGeneratorRule as WixMetaGeneratorRule;
use App\Modules\Detection\Wix\Rules\ThunderboltRule;
use App\Modules\Detection\Wix\Rules\ViewerModelRule;
use App\Modules\Detection\Wix\WixDetector;
use App\Modules\Detection\WordPress\ConfidenceCalculator as WordPressConfidenceCalculator;
use App\Modules\Detection\WordPress\Parsers\StyleCssParser;
use App\Modules\Detection\WordPress\Rules\GeneratorRule;
use App\Modules\Detection\WordPress\Rules\ThemePathRule;
use App\Modules\Detection\WordPress\Rules\ThemeStyleRule;
use App\Modules\Detection\WordPress\Rules\WPJsonRule;
use App\Modules\Detection\WordPress\Rules\XmlRpcRule;
use App\Modules\Detection\WordPress\WordPressDetector;
use App\Modules\Http\HttpClient;

/**
 * Assembles the production-ready DetectorRegistry for the Detection Engine.
 *
 * DetectorRegistryFactory wires every supported CMS detector into a single
 * DetectorRegistry, resolving shared collaborators such as the concrete
 * HTTP client from the container. It is the composition point the
 * DetectionServiceProvider architecture prescribes for introducing
 * detectors without modifying the provider.
 *
 * Responsibilities:
 *
 * - Build every supported platform detector with its rules.
 * - Resolve shared collaborators (HTTP client, parsers) from the container.
 * - Return an immutable, fully populated DetectorRegistry.
 *
 * Design philosophy:
 *
 * - Factory: object creation is centralized and reusable.
 * - Composition Root: platform wiring happens exclusively here.
 * - Single Responsibility Principle: assembling the registry is the only
 *   concern; it performs no detection.
 * - Stateless, deterministic, and side-effect free.
 */
final readonly class DetectorRegistryFactory
{
    /**
     * Build the fully populated DetectorRegistry.
     *
     * @param Container $container The application dependency injection
     *                             container used to resolve the concrete
     *                             HTTP client shared by network-probing
     *                             rules.
     *
     * @return DetectorRegistry The registry containing every supported
     *                          platform detector.
     */
    public function create(Container $container): DetectorRegistry
    {
        $httpClient = $container->get(HttpClient::class);

        return new DetectorRegistry([
            $this->wordPressDetector($httpClient),
            $this->shopifyDetector($httpClient),
            $this->joomlaDetector(),
            $this->drupalDetector(),
            $this->ghostDetector(),
            $this->squarespaceDetector(),
            $this->typo3Detector(),
            $this->webflowDetector(),
            $this->wixDetector(),
        ]);
    }

    private function wordPressDetector(HttpClient $httpClient): WordPressDetector
    {
        return new WordPressDetector(
            [
                new GeneratorRule(),
                new ThemePathRule(),
                new ThemeStyleRule($httpClient, new StyleCssParser()),
                new WPJsonRule($httpClient),
                new XmlRpcRule($httpClient),
            ],
            new WordPressConfidenceCalculator(),
        );
    }

    private function shopifyDetector(HttpClient $httpClient): ShopifyDetector
    {
        return new ShopifyDetector(
            [
                new CartEndpointRule($httpClient),
                new CDNRule(),
                new ShopifyGlobalJsRule(),
                new ShopifyMetaGeneratorRule(),
                new ShopifyAssetsRule(),
                new ThemeAssetsRule(),
            ],
            new ShopifyConfidenceCalculator(),
        );
    }

    private function joomlaDetector(): JoomlaDetector
    {
        return new JoomlaDetector(
            [
                new JoomlaApiEndpointRule(),
                new JoomlaAssetPathRule(),
                new JoomlaHtmlSignatureRule(),
                new JoomlaMetaGeneratorRule(),
                new JoomlaScriptFingerprintRule(),
            ],
            new JoomlaConfidenceCalculator(),
        );
    }

    private function drupalDetector(): DrupalDetector
    {
        return new DrupalDetector(
            [
                new DrupalApiEndpointRule(),
                new DrupalAssetPathRule(),
                new DrupalHtmlSignatureRule(),
                new DrupalMetaGeneratorRule(),
                new DrupalScriptFingerprintRule(),
            ],
            new DrupalConfidenceCalculator(),
        );
    }

    private function ghostDetector(): GhostDetector
    {
        return new GhostDetector(
            [
                new GhostApiEndpointRule(),
                new GhostAssetPathRule(),
                new GhostHtmlSignatureRule(),
                new GhostMetaGeneratorRule(),
                new GhostScriptFingerprintRule(),
            ],
            new GhostConfidenceCalculator(),
        );
    }

    private function squarespaceDetector(): SquarespaceDetector
    {
        return new SquarespaceDetector(
            [
                new SquarespaceAssetPathRule(),
                new CommerceRule(),
                new SquarespaceDataAttributesRule(),
                new SquarespaceMetaGeneratorRule(),
                new StaticJsRule(),
            ],
            new SquarespaceConfidenceCalculator(),
        );
    }

    private function typo3Detector(): TYPO3Detector
    {
        return new TYPO3Detector(
            [
                new Typo3ApiEndpointRule(),
                new Typo3AssetPathRule(),
                new Typo3HtmlSignatureRule(),
                new Typo3MetaGeneratorRule(),
                new Typo3ScriptFingerprintRule(),
            ],
            new Typo3ConfidenceCalculator(),
        );
    }

    private function webflowDetector(): WebflowDetector
    {
        return new WebflowDetector(
            [
                new WebflowAssetPathRule(),
                new WebflowDataAttributesRule(),
                new WebflowGlobalJsRule(),
                new WebflowMetaGeneratorRule(),
                new WebflowBadgeRule(),
            ],
            new WebflowConfidenceCalculator(),
        );
    }

    private function wixDetector(): WixDetector
    {
        return new WixDetector(
            [
                new WixAssetPathRule(),
                new WixGlobalJsRule(),
                new WixMetaGeneratorRule(),
                new ThunderboltRule(),
                new ViewerModelRule(),
            ],
            new WixConfidenceCalculator(),
        );
    }
}
