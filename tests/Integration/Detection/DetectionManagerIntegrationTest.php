<?php

declare(strict_types=1);

namespace Tests\Integration\Detection;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\DetectionManager;
use App\Modules\Detection\DetectorRegistry;
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
use App\Modules\Detection\TYPO3\ConfidenceCalculator as TYPO3ConfidenceCalculator;
use App\Modules\Detection\TYPO3\Rules\ApiEndpointRule as TYPO3ApiEndpointRule;
use App\Modules\Detection\TYPO3\Rules\AssetPathRule as TYPO3AssetPathRule;
use App\Modules\Detection\TYPO3\Rules\HtmlSignatureRule as TYPO3HtmlSignatureRule;
use App\Modules\Detection\TYPO3\Rules\MetaGeneratorRule as TYPO3MetaGeneratorRule;
use App\Modules\Detection\TYPO3\Rules\ScriptFingerprintRule as TYPO3ScriptFingerprintRule;
use App\Modules\Detection\TYPO3\TYPO3Detector;
use App\Modules\Detection\WordPress\ConfidenceCalculator as WordPressConfidenceCalculator;
use App\Modules\Detection\WordPress\Rules\GeneratorRule;
use App\Modules\Detection\WordPress\Rules\ThemePathRule;
use App\Modules\Detection\WordPress\WordPressDetector;
use PHPUnit\Framework\TestCase;

final class DetectionManagerIntegrationTest extends TestCase
{
    private const URL = 'https://example.com';

    private const FIXTURE_DIRECTORY = __DIR__ . '/../../Fixtures/Detection';

    private function createContext(string $fixture): DetectionContext
    {
        $html = file_get_contents(self::FIXTURE_DIRECTORY . '/' . $fixture . '.html');

        return new DetectionContext(
            originalUrl: self::URL,
            finalUrl: self::URL,
            html: $html === false ? '' : $html,
            statusCode: 200,
        );
    }

    private function createManager(): DetectionManager
    {
        return new DetectionManager(
            new DetectorRegistry([
                new WordPressDetector(
                    [
                        new GeneratorRule(),
                        new ThemePathRule(),
                    ],
                    new WordPressConfidenceCalculator(),
                ),
                new JoomlaDetector(
                    [
                        new JoomlaMetaGeneratorRule(),
                        new JoomlaAssetPathRule(),
                        new JoomlaScriptFingerprintRule(),
                        new JoomlaHtmlSignatureRule(),
                        new JoomlaApiEndpointRule(),
                    ],
                    new JoomlaConfidenceCalculator(),
                ),
                new DrupalDetector(
                    [
                        new DrupalMetaGeneratorRule(),
                        new DrupalAssetPathRule(),
                        new DrupalScriptFingerprintRule(),
                        new DrupalHtmlSignatureRule(),
                        new DrupalApiEndpointRule(),
                    ],
                    new DrupalConfidenceCalculator(),
                ),
                new GhostDetector(
                    [
                        new GhostMetaGeneratorRule(),
                        new GhostAssetPathRule(),
                        new GhostScriptFingerprintRule(),
                        new GhostHtmlSignatureRule(),
                        new GhostApiEndpointRule(),
                    ],
                    new GhostConfidenceCalculator(),
                ),
                new TYPO3Detector(
                    [
                        new TYPO3MetaGeneratorRule(),
                        new TYPO3AssetPathRule(),
                        new TYPO3ScriptFingerprintRule(),
                        new TYPO3HtmlSignatureRule(),
                        new TYPO3ApiEndpointRule(),
                    ],
                    new TYPO3ConfidenceCalculator(),
                ),
            ]),
        );
    }

    public function test_detects_wordpress_fixture(): void
    {
        $result = $this->createManager()->detect($this->createContext('wordpress-basic'));

        self::assertTrue($result->isDetected());
        self::assertSame('WordPress', $result->technology());
        self::assertGreaterThan(0, $result->confidence());
    }

    public function test_detects_joomla_fixture(): void
    {
        $result = $this->createManager()->detect($this->createContext('joomla-basic'));

        self::assertTrue($result->isDetected());
        self::assertSame('Joomla', $result->technology());
        self::assertGreaterThan(0, $result->confidence());
    }

    public function test_detects_drupal_fixture(): void
    {
        $result = $this->createManager()->detect($this->createContext('drupal-basic'));

        self::assertTrue($result->isDetected());
        self::assertSame('Drupal', $result->technology());
        self::assertGreaterThan(0, $result->confidence());
    }

    public function test_detects_ghost_fixture(): void
    {
        $result = $this->createManager()->detect($this->createContext('ghost-default'));

        self::assertTrue($result->isDetected());
        self::assertSame('Ghost', $result->technology());
        self::assertGreaterThan(0, $result->confidence());
    }

    public function test_detects_typo3_fixture(): void
    {
        $result = $this->createManager()->detect($this->createContext('typo3-basic'));

        self::assertTrue($result->isDetected());
        self::assertSame('TYPO3', $result->technology());
        self::assertGreaterThan(0, $result->confidence());
    }
}
