<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\Drupal;

use App\Modules\Detection\DetectionContext;
use DOMAttr;
use DOMDocument;
use DOMXPath;

/**
 * Locates the active Drupal theme directory name from the HTML carried by
 * a DetectionContext.
 *
 * DrupalThemeLocator is responsible only for discovering the Drupal theme
 * directory name by inspecting the resource URLs already present in the
 * HTML inside the DetectionContext. Drupal serves theme assets from
 * root-anchored directories under /themes/contrib/{slug}/ for contributed
 * themes and /themes/custom/{slug}/ for custom themes; the directory name
 * after contrib or custom names the theme.
 *
 * Rules:
 *
 * - Only attribute values are inspected — link href, script src, image src
 *   and srcset, source src and srcset, video src and poster, audio src,
 *   preloaded/prefetched and icon link hrefs, and lazy-loaded data-src and
 *   data-bg. Plain text and CSS class names never match.
 * - Only a root-anchored path qualifies: the parsed URL path must start
 *   with /themes/ followed by exactly contrib/ or custom/, a non-empty
 *   theme directory name, and a trailing slash. Bare /themes/, /themes/
 *   with a generic first segment, the singular /theme/{slug}/, and paths
 *   such as /assets/themes/ or /wp-content/themes/ never match.
 * - The theme directory name is URL-decoded and validated: a name that
 *   decodes to a slash, backslash, or question mark is rejected.
 * - Generic directory names (css, js, img, images, assets, media, system,
 *   fonts, font, template, templates) are rejected. A path such as
 *   /themes/custom/css/style.css names a generic directory, not a theme,
 *   and must never be mistaken for one.
 * - Stylesheet links are scanned before every other resource, so a
 *   stylesheet under /themes/contrib/{slug}/ or /themes/custom/{slug}/
 *   wins over a script or image found earlier in the document.
 * - The first qualifying theme directory name wins; the locator never
 *   fetches, verifies, or downloads any asset.
 *
 * Design philosophy:
 *
 * - HTML Discovery Engine: the locator discovers theme evidence that
 *   already exists in the markup and derives the theme directory name from
 *   it; it never invents a theme and never performs HTTP.
 * - Single Responsibility Principle: locating the theme directory name is
 *   the only concern. It performs no HTTP requests, no metadata
 *   extraction, no confidence calculation, and no Drupal business rules.
 * - Stateless, deterministic, and side-effect free: given the same
 *   DetectionContext, it always returns the same result.
 * - Dependency Injection friendly: it depends only on the immutable
 *   DetectionContext and the DOM extension.
 *
 * The class knows nothing about ThemeMetadata or ThemeExtractionResult.
 */
final readonly class DrupalThemeLocator
{
    /**
     * Resource attributes scanned for theme directory names, in discovery
     * priority order.
     *
     * @var list<string>
     */
    private const RESOURCE_QUERIES = [
        '//link[contains(@rel, "stylesheet")]/@href',
        '//link[contains(@rel, "preload") or contains(@rel, "prefetch")]/@href',
        '//link[contains(@rel, "icon")]/@href',
        '//script/@src',
        '//img/@src',
        '//img/@srcset',
        '//source/@src',
        '//source/@srcset',
        '//video/@src',
        '//video/@poster',
        '//audio/@src',
        '//*[@data-src]/@data-src',
        '//*[@data-bg]/@data-bg',
    ];

    /**
     * Generic directory names that never identify a theme.
     *
     * A path such as /themes/custom/css/style.css names a generic
     * directory, not a theme, and is rejected so a generic directory is
     * never reported as a theme name.
     *
     * @var list<string>
     */
    private const GENERIC_SLUGS = [
        'css',
        'js',
        'img',
        'images',
        'assets',
        'media',
        'system',
        'fonts',
        'font',
        'template',
        'templates',
    ];

    /**
     * Locate the active Drupal theme directory name.
     *
     * Inspects the resource attributes of the HTML already contained inside
     * the given detection context and returns the first valid theme
     * directory name found under a root-anchored /themes/contrib/{slug}/ or
     * /themes/custom/{slug}/ path. Stylesheet links are scanned before
     * every other resource. Returns null when the HTML is empty,
     * unparseable, or contains no qualifying theme path. No asset is ever
     * fetched, verified, or downloaded.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return string|null The Drupal theme directory name, or null when
     *                     none can be located.
     */
    public function locate(DetectionContext $context): ?string
    {
        $xpath = $this->createXPath($context->html());

        if ($xpath === null) {
            return null;
        }

        foreach (self::RESOURCE_QUERIES as $query) {
            $nodes = $xpath->query($query);

            if ($nodes === false) {
                continue;
            }

            foreach ($nodes as $node) {
                if (!$node instanceof DOMAttr) {
                    continue;
                }

                foreach ($this->candidateUrls($node) as $url) {
                    $slug = $this->themeSlugFromUrl($url);

                    if ($slug !== null) {
                        return $slug;
                    }
                }
            }
        }

        return null;
    }

    /**
     * Yield every candidate URL an attribute node carries.
     *
     * A srcset attribute holds a comma-separated list of image candidate
     * descriptors; each leading token is yielded as a candidate URL. Every
     * other attribute yields its trimmed value as a single candidate.
     * Empty values are skipped.
     *
     * @param DOMAttr $node The attribute node being inspected.
     *
     * @return iterable<string> The candidate URLs.
     */
    private function candidateUrls(DOMAttr $node): iterable
    {
        $value = trim($node->value);

        if ($value === '') {
            return;
        }

        if (strtolower($node->name) === 'srcset') {
            foreach (explode(',', $value) as $candidate) {
                $parts = preg_split('/\s+/', trim($candidate), 2);

                if ($parts === false || $parts === []) {
                    continue;
                }

                $url = $parts[0];

                if ($url !== '') {
                    yield $url;
                }
            }

            return;
        }

        yield $value;
    }

    /**
     * Extract the theme directory name from a URL string.
     *
     * Returns the directory name immediately following a root-anchored
     * /themes/contrib/ or /themes/custom/ in the URL path, or null when the
     * URL does not live under either. The name is URL-decoded and must
     * survive the following checks: free of slashes, backslashes, and
     * question marks, and not a generic directory name.
     *
     * @param string $url The URL to inspect.
     *
     * @return string|null The theme directory name, or null when the URL
     *                     does not belong to a Drupal theme directory.
     */
    private function themeSlugFromUrl(string $url): ?string
    {
        $path = $this->urlPath($url);

        if ($path === null) {
            return null;
        }

        if (preg_match('~^/themes/(contrib|custom)/([^/?#]+)/~', $path, $matches) !== 1) {
            return null;
        }

        $slug = urldecode($matches[2]);

        if (strpbrk($slug, "/\\?") !== false) {
            return null;
        }

        if (in_array(strtolower($slug), self::GENERIC_SLUGS, true)) {
            return null;
        }

        return $slug;
    }

    /**
     * Return the path component of a URL string.
     *
     * Returns null when the value is empty or cannot be parsed into a
     * structured URL. Root-relative and absolute paths are returned as-is;
     * a bare relative reference such as themes/custom/foo or
     * ../themes/custom/foo yields a path that does not start with /themes/
     * and therefore never matches.
     *
     * @param string $url The URL to parse.
     *
     * @return string|null The path component, or null when unparseable.
     */
    private function urlPath(string $url): ?string
    {
        $trimmed = trim($url);

        if ($trimmed === '') {
            return null;
        }

        $parts = parse_url($trimmed);

        if ($parts === false) {
            return null;
        }

        return $parts['path'] ?? null;
    }

    /**
     * Load the HTML into a DOMXPath instance.
     *
     * Malformed HTML warnings are suppressed while loading, and any libxml
     * error state is cleared afterwards. Returns null when the HTML is
     * empty or cannot be parsed.
     *
     * @param string $html The complete HTML source of the target website.
     *
     * @return DOMXPath|null A DOMXPath over the loaded document, or null
     *                       when parsing fails.
     */
    private function createXPath(string $html): ?DOMXPath
    {
        if ($html === '') {
            return null;
        }

        $document = new DOMDocument();

        $previousErrorHandling = libxml_use_internal_errors(true);

        try {
            $loaded = $document->loadHTML($html);
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previousErrorHandling);
        }

        if (!$loaded) {
            return null;
        }

        return new DOMXPath($document);
    }
}
