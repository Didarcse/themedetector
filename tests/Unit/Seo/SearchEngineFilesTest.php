<?php

declare(strict_types=1);

namespace Tests\Unit\Seo;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use SimpleXMLElement;

/**
 * Verifies the search-engine files shipped in the public document root.
 *
 * These files must advertise only the canonical production origin and must
 * never leak local development domains into production SEO metadata.
 */
final class SearchEngineFilesTest extends TestCase
{
    private const PRODUCTION_ORIGIN = 'https://themedetectortool.com';

    private const FORBIDDEN = [
        'themedetector.test',
        'localhost',
        '127.0.0.1',
        'github.com',
    ];

    public function test_robots_txt_is_present(): void
    {
        $this->assertFileExists($this->path('public/robots.txt'));
        $this->assertFileIsReadable($this->path('public/robots.txt'));
    }

    public function test_robots_txt_allows_crawling_and_declares_production_sitemap(): void
    {
        $content = (string) file_get_contents($this->path('public/robots.txt'));

        $this->assertStringContainsString('User-agent: *', $content);
        $this->assertStringContainsString('Allow: /', $content);
        $this->assertStringContainsString('Sitemap: ' . self::PRODUCTION_ORIGIN . '/sitemap.xml', $content);
    }

    public function test_robots_txt_never_references_local_or_github_domains(): void
    {
        $content = (string) file_get_contents($this->path('public/robots.txt'));

        foreach (self::FORBIDDEN as $needle) {
            $this->assertStringNotContainsString($needle, $content);
        }
    }

    public function test_sitemap_is_present_and_valid_xml(): void
    {
        $this->assertFileExists($this->path('public/sitemap.xml'));
        $this->assertStringStartsWith(
            '<?xml',
            (string) file_get_contents($this->path('public/sitemap.xml')),
        );

        $this->assertInstanceOf(SimpleXMLElement::class, $this->sitemapXml());
    }

    public function test_sitemap_lists_homepage_and_about_with_production_urls(): void
    {
        $xml = $this->sitemapXml();

        $locations = [];
        foreach ($xml->url as $url) {
            $locations[] = (string) $url->loc;
        }

        $this->assertSame(
            [
                self::PRODUCTION_ORIGIN . '/',
                self::PRODUCTION_ORIGIN . '/about',
            ],
            $locations,
        );
    }

    public function test_sitemap_never_references_local_or_github_domains(): void
    {
        $content = (string) file_get_contents($this->path('public/sitemap.xml'));

        foreach (self::FORBIDDEN as $needle) {
            $this->assertStringNotContainsString($needle, $content);
        }
    }

    private function path(string $relative): string
    {
        return dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . $relative;
    }

    private function sitemapXml(): SimpleXMLElement
    {
        $xml = simplexml_load_string(
            (string) file_get_contents($this->path('public/sitemap.xml')),
        );

        if ($xml === false) {
            throw new RuntimeException('sitemap.xml is not valid XML.');
        }

        return $xml;
    }
}
