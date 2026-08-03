<?php

declare(strict_types=1);

namespace App\Modules\Detection\WordPress\Rules;

use App\Modules\Detection\WordPress\Parsers\StyleCssParser;
use App\Modules\Http\HttpClient;
use App\Modules\Http\HttpException;

/**
 * Downloads the active WordPress theme's style.css and extracts metadata.
 *
 * Searches HTML for a wp-content/themes reference, constructs the
 * style.css URL, fetches it via HttpClient, and delegates parsing
 * to StyleCssParser.
 */
final class ThemeStyleRule implements RuleInterface
{
    private const THEME_PATH_PATTERN = '/\/wp-content\/themes\/([^\/?"\'\s>]+)/i';

    public function __construct(
        private readonly HttpClient $httpClient,
        private readonly StyleCssParser $styleCssParser,
    ) {
    }

    /**
     * Evaluate the HTML for a WordPress theme and extract its metadata.
     *
     * @param string $html The complete HTML source of the target website.
     * @param string $url  The original website URL.
     *
     * @return array{
     *     matched: bool,
     *     confidence: int,
     *     metadata: array<string, mixed>
     * }
     */
    public function evaluate(string $html, string $url): array
    {
        $themeSlug = $this->extractThemeSlug($html);

        if ($themeSlug === null) {
            return $this->noMatch();
        }

        $styleCssUrl = $this->buildStyleCssUrl($url, $themeSlug);

        $css = $this->downloadStyleCss($styleCssUrl);

        if ($css === null) {
            return $this->noMatch();
        }

        $metadata = $this->styleCssParser->parse($css);

        if ($metadata['theme_name'] === null) {
            return $this->noMatch();
        }

        return [
            'matched' => true,
            'confidence' => 50,
            'metadata' => [
                'theme_name' => $metadata['theme_name'],
                'theme_uri' => $metadata['theme_uri'],
                'version' => $metadata['version'],
                'author' => $metadata['author'],
                'author_uri' => $metadata['author_uri'],
                'style_css_url' => $styleCssUrl,
            ],
        ];
    }

    private function extractThemeSlug(string $html): ?string
    {
        if (preg_match(self::THEME_PATH_PATTERN, $html, $matches) !== 1) {
            return null;
        }

        $slug = strtolower(trim($matches[1]));

        return $slug !== '' ? $slug : null;
    }

    private function buildStyleCssUrl(string $url, string $slug): string
    {
        $parts = parse_url($url);

        $scheme = isset($parts['scheme']) ? $parts['scheme'] : 'https';
        $host = $parts['host'] ?? '';

        return $scheme . '://' . $host . '/wp-content/themes/' . $slug . '/style.css';
    }

    private function downloadStyleCss(string $url): ?string
    {
        try {
            $response = $this->httpClient->get($url);

            if ($response->statusCode() < 200 || $response->statusCode() >= 300) {
                return null;
            }

            return $response->body();
        } catch (HttpException) {
            return null;
        }
    }

    /**
     * @return array{matched: false, confidence: 0, metadata: array}
     */
    private function noMatch(): array
    {
        return [
            'matched' => false,
            'confidence' => 0,
            'metadata' => [],
        ];
    }
}
