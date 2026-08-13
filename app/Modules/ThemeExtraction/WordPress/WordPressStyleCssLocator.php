<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\WordPress;

use App\Modules\Detection\DetectionContext;
use DOMAttr;
use DOMDocument;
use DOMXPath;

/**
 * Locates the active WordPress theme stylesheet URL from the HTML carried
 * by a DetectionContext.
 *
 * WordPressStyleCssLocator is responsible only for discovering the active
 * WordPress theme stylesheet by inspecting the HTML already available
 * inside the DetectionContext. Every result is resolved into an absolute
 * URL against the context's final URL (falling back to the original URL).
 *
 * The locator applies a cascade of discovery strategies in priority order.
 * The first strategy that yields a theme directory name wins; when a
 * strategy produces a theme directory name rather than a complete
 * stylesheet URL, the canonical /wp-content/themes/{slug}/style.css URL is
 * assembled from that name. A strategy never triggers when a higher-priority
 * strategy has already located the stylesheet.
 *
 * Strategy priorities:
 *
 * 1. Direct stylesheet link: an existing <link rel="stylesheet"> whose href
 *    lives under /wp-content/themes/ and names the canonical style.css
 *    file at the theme directory root. The href is returned exactly as
 *    found. Stylesheets deeper inside the theme directory (for example
 *    dist/style.css or assets/css/style.css) are build or component
 *    artifacts and are deliberately skipped here; they fall through to the
 *    theme CSS asset strategy instead.
 * 2. Theme directory asset paths: any resource URL (script, image, source,
 *    video, audio, preloaded/prefetched link, icon, lazy-loaded data-src or
 *    data-bg) living under /wp-content/themes/{slug}/. The slug names the
 *    active theme directory.
 * 3. Theme CSS asset inspection: a <link rel="stylesheet"> whose href lives
 *    in a subdirectory of /wp-content/themes/{slug}/ (for example
 *    assets/css/main.css). A stylesheet file directly inside the theme
 *    directory root is not treated as a theme asset.
 * 4. theme.json / block theme reference: a URL containing
 *    /wp-content/themes/{slug}/theme.json, the marker of a block theme.
 * 5. HTML fingerprint: a body class of wp-theme-{slug} or
 *    wp-child-theme-{slug}, emitted by WordPress itself on every page.
 * 6. Known commercial theme fingerprints: a small, curated map of
 *    distinctive HTML markers that uniquely identify a well-known
 *    commercial theme.
 *
 * Design philosophy:
 *
 * - HTML Discovery Engine: the locator discovers theme evidence that
 *   already exists in the markup and derives the theme directory name from
 *   it; it never invents a theme and never parses CSS or performs HTTP.
 * - Multi-strategy fallback: strategies are tried strictly in priority
 *   order, so a direct stylesheet link always wins over inferred evidence.
 * - Single Responsibility Principle: locating the active theme stylesheet
 *   is the only concern. It performs no HTTP requests, no CSS parsing, no
 *   metadata extraction, no confidence calculation, and no WordPress
 *   business rules.
 * - Stateless, deterministic, and side-effect free: given the same
 *   DetectionContext, it always returns the same result.
 * - Dependency Injection friendly: it depends only on the immutable
 *   DetectionContext and the DOM extension.
 *
 * The class knows nothing about ThemeMetadata or ThemeExtractionResult.
 */
final readonly class WordPressStyleCssLocator
{
    /**
     * Locate the active WordPress theme stylesheet URL.
     *
     * Inspects the HTML already contained inside the given detection
     * context using the strategy cascade described on the class. The direct
     * stylesheet link strategy is tried first: the first <link
     * rel="stylesheet"> href that lives under /wp-content/themes/ and names
     * the canonical style.css file at the theme directory root is returned
     * resolved into an absolute URL. When no direct stylesheet link exists,
     * the remaining strategies infer the theme directory name from the
     * HTML and assemble the canonical /wp-content/themes/{slug}/style.css
     * URL. Returns null when the HTML is empty, unparseable, or contains
     * no theme evidence at all. The stylesheet is never verified,
     * downloaded, or parsed.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return string|null The absolute active WordPress theme stylesheet
     *                     URL, or null when none can be located.
     */
    public function locate(DetectionContext $context): ?string
    {
        $xpath = $this->createXPath($context->html());

        if ($xpath === null) {
            return null;
        }

        foreach ($this->stylesheetLinks($xpath) as $href) {
            if (!$this->isThemeStylesheet($href)) {
                continue;
            }

            return $this->normalizeUrl($href, $context);
        }

        $themeSlug = $this->discoverThemeSlug($xpath);

        if ($themeSlug === null) {
            return null;
        }

        return $this->styleCssUrlForSlug($themeSlug, $context);
    }

    /**
     * Discover the active theme directory name from the HTML.
     *
     * Applies the fallback strategies in priority order: theme directory
     * asset paths, theme CSS asset inspection, theme.json references, HTML
     * fingerprints, and known commercial theme fingerprints. The first
     * strategy that identifies a theme directory name wins.
     *
     * @param DOMXPath $xpath The DOMXPath over the loaded document.
     *
     * @return string|null The discovered theme directory name, or null when
     *                     no strategy identifies one.
     */
    private function discoverThemeSlug(DOMXPath $xpath): ?string
    {
        $themeSlug = $this->slugFromThemeDirectoryPaths($xpath);

        if ($themeSlug !== null) {
            return $themeSlug;
        }

        $themeSlug = $this->slugFromThemeCssAsset($xpath);

        if ($themeSlug !== null) {
            return $themeSlug;
        }

        $themeSlug = $this->slugFromThemeJsonReference($xpath);

        if ($themeSlug !== null) {
            return $themeSlug;
        }

        $themeSlug = $this->slugFromHtmlFingerprint($xpath);

        if ($themeSlug !== null) {
            return $themeSlug;
        }

        return $this->slugFromCommercialFingerprint($xpath);
    }

    /**
     * Discover the theme directory name from theme directory asset paths.
     *
     * Inspects every resource URL in the document that lives under
     * /wp-content/themes/{slug}/ and returns the first theme directory name
     * found. Resources inspected are script src, image src and srcset,
     * source src and srcset, video src and poster, audio src, preloaded and
     * prefetched link hrefs, icon link hrefs, and lazy-loaded data-src and
     * data-bg attributes.
     *
     * @param DOMXPath $xpath The DOMXPath over the loaded document.
     *
     * @return string|null The first theme directory name found, or null
     *                     when no theme asset path exists.
     */
    private function slugFromThemeDirectoryPaths(DOMXPath $xpath): ?string
    {
        $resourceLinks = [
            '//script/@src',
            '//img/@src',
            '//img/@srcset',
            '//source/@src',
            '//source/@srcset',
            '//video/@src',
            '//video/@poster',
            '//audio/@src',
            '//link[contains(@rel, "preload") or contains(@rel, "prefetch")]/@href',
            '//link[contains(@rel, "icon")]/@href',
            '//*[@data-src]/@data-src',
            '//*[@data-bg]/@data-bg',
        ];

        foreach ($resourceLinks as $query) {
            $nodes = $xpath->query($query);

            if ($nodes === false) {
                continue;
            }

            foreach ($nodes as $node) {
                if (!$node instanceof DOMAttr) {
                    continue;
                }

                $themeSlug = $this->themeSlugFromUrl($node->value);

                if ($themeSlug !== null) {
                    return $themeSlug;
                }
            }
        }

        return null;
    }

    /**
     * Discover the theme directory name from theme CSS asset inspection.
     *
     * Inspects every stylesheet href that lives in a subdirectory of the
     * theme directory, such as assets/css/main.css, and returns the theme
     * directory name it belongs to. Stylesheets directly inside the theme
     * directory root are not treated as theme assets and are ignored.
     *
     * @param DOMXPath $xpath The DOMXPath over the loaded document.
     *
     * @return string|null The theme directory name of the first matching
     *                     CSS asset, or null when none exists.
     */
    private function slugFromThemeCssAsset(DOMXPath $xpath): ?string
    {
        foreach ($this->stylesheetLinks($xpath) as $href) {
            $themeSlug = $this->themeSlugFromUrl($href);

            if ($themeSlug === null) {
                continue;
            }

            if ($this->isThemeSubdirectoryAsset($href, $themeSlug)) {
                return $themeSlug;
            }
        }

        return null;
    }

    /**
     * Discover the theme directory name from a theme.json reference.
     *
     * Scans every attribute value in the document for a URL containing
     * /wp-content/themes/{slug}/theme.json, the marker of a block theme,
     * and returns the first theme directory name found.
     *
     * @param DOMXPath $xpath The DOMXPath over the loaded document.
     *
     * @return string|null The theme directory name of the first theme.json
     *                     reference, or null when none exists.
     */
    private function slugFromThemeJsonReference(DOMXPath $xpath): ?string
    {
        $nodes = $xpath->query('//@*');

        if ($nodes === false) {
            return null;
        }

        foreach ($nodes as $node) {
            if (!$node instanceof DOMAttr) {
                continue;
            }

            if (str_contains($node->value, '/theme.json')) {
                $themeSlug = $this->themeSlugFromUrl($node->value);

                if ($themeSlug !== null) {
                    return $themeSlug;
                }
            }
        }

        return null;
    }

    /**
     * Discover the theme directory name from an HTML fingerprint.
     *
     * Inspects the body class attribute for the wp-theme-{slug} and
     * wp-child-theme-{slug} classes emitted by WordPress itself and returns
     * the first theme directory name found. The active theme class
     * (wp-theme-) takes precedence over the child theme class
     * (wp-child-theme-).
     *
     * @param DOMXPath $xpath The DOMXPath over the loaded document.
     *
     * @return string|null The first theme directory name found, or null
     *                     when no theme fingerprint exists.
     */
    private function slugFromHtmlFingerprint(DOMXPath $xpath): ?string
    {
        $nodes = $xpath->query('//body/@class');

        if ($nodes === false) {
            return null;
        }

        foreach ($nodes as $node) {
            if (!$node instanceof DOMAttr) {
                continue;
            }

            $classes = preg_split('/\s+/', trim($node->value));

            if ($classes === false) {
                continue;
            }

            foreach ($classes as $class) {
                if (str_starts_with($class, 'wp-theme-')) {
                    return substr($class, strlen('wp-theme-'));
                }
            }

            foreach ($classes as $class) {
                if (str_starts_with($class, 'wp-child-theme-')) {
                    return substr($class, strlen('wp-child-theme-'));
                }
            }
        }

        return null;
    }

    /**
     * Discover the theme directory name from a known commercial fingerprint.
     *
     * Applies a small, curated map of distinctive body classes that
     * uniquely identify well-known commercial themes and returns the first
     * matching theme directory name.
     *
     * @param DOMXPath $xpath The DOMXPath over the loaded document.
     *
     * @return string|null The matching theme directory name, or null when
     *                     no fingerprint matches.
     */
    private function slugFromCommercialFingerprint(DOMXPath $xpath): ?string
    {
        $nodes = $xpath->query('//body/@class');

        if ($nodes === false) {
            return null;
        }

        $commercialFingerprints = [
            'hello-elementor' => 'hello-elementor',
            'et-divi' => 'divi',
            'fusion-body' => 'avada',
            'x-navbar' => 'x',
            'xpro-' => 'xpro',
        ];

        foreach ($nodes as $node) {
            if (!$node instanceof DOMAttr) {
                continue;
            }

            foreach ($commercialFingerprints as $fingerprint => $themeSlug) {
                if (str_contains($node->value, $fingerprint)) {
                    return $themeSlug;
                }
            }
        }

        return null;
    }

    /**
     * Extract the theme directory name from a URL string.
     *
     * Returns the directory name immediately following /wp-content/themes/
     * in the given URL, or null when the URL does not live under
     * /wp-content/themes/. A valid theme directory name consists of
     * alphanumeric characters, hyphens, underscores, and dots.
     *
     * @param string $url The URL to inspect.
     *
     * @return string|null The theme directory name, or null when the URL
     *                     does not belong to a theme directory.
     */
    private function themeSlugFromUrl(string $url): ?string
    {
        if (preg_match('~wp-content/themes/([a-zA-Z0-9][a-zA-Z0-9_.\-]*)/~', $url, $matches) !== 1) {
            return null;
        }

        return $matches[1];
    }

    /**
     * Return whether a stylesheet href is a theme subdirectory asset.
     *
     * A stylesheet is treated as a theme subdirectory asset only when it
     * lives in a subdirectory of the theme directory, meaning the path
     * following /wp-content/themes/{slug}/ contains another directory
     * separator. A stylesheet named directly inside the theme directory
     * root is not considered a theme CSS asset.
     *
     * @param string $href      The stylesheet href to inspect.
     * @param string $themeSlug The theme directory name.
     *
     * @return bool True when the href is a theme subdirectory asset.
     */
    private function isThemeSubdirectoryAsset(string $href, string $themeSlug): bool
    {
        $marker = 'wp-content/themes/' . $themeSlug . '/';

        $markerPos = strpos($href, $marker);

        if ($markerPos === false) {
            return false;
        }

        return str_contains(substr($href, $markerPos + strlen($marker)), '/');
    }

    /**
     * Assemble the canonical style.css URL for a theme directory name.
     *
     * @param string            $themeSlug The theme directory name.
     * @param DetectionContext  $context   The immutable detection context
     *                                     used as the resolution base.
     *
     * @return string The canonical absolute style.css URL for the theme.
     */
    private function styleCssUrlForSlug(string $themeSlug, DetectionContext $context): string
    {
        return $this->normalizeUrl('/wp-content/themes/' . $themeSlug . '/style.css', $context);
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

    /**
     * Yield the href of every <link rel="stylesheet"> in the document.
     *
     * Attribute values are trimmed, and empty or missing hrefs are
     * skipped. The hrefs are yielded exactly as found in the markup.
     *
     * @param DOMXPath $xpath The DOMXPath over the loaded document.
     *
     * @return iterable<int, string> The stylesheet hrefs found in the
     *                               document.
     */
    private function stylesheetLinks(DOMXPath $xpath): iterable
    {
        $nodes = $xpath->query('//link[@rel="stylesheet"]/@href');

        if ($nodes === false) {
            return;
        }

        foreach ($nodes as $node) {
            if (!$node instanceof DOMAttr) {
                continue;
            }

            $href = trim($node->value);

            if ($href === '') {
                continue;
            }

            yield $href;
        }
    }

    /**
     * Return whether the given href belongs to an active theme stylesheet.
     *
     * A href qualifies only when it references the canonical theme
     * stylesheet: a file that both lives under the WordPress themes
     * directory (/wp-content/themes/) and is named style.css directly at
     * the theme directory root. A stylesheet named style.css deeper inside
     * the theme directory (such as dist/style.css or
     * assets/css/style.css) is a build or component artifact and is
     * rejected by this rule; it carries no theme header and must not be
     * mistaken for the active theme stylesheet. Everything else — plugin
     * stylesheets, wp-includes assets, block library CSS, Google Fonts,
     * and external CSS — is also rejected. A trailing query string or
     * fragment is tolerated.
     *
     * @param string $href The raw stylesheet href as found in the markup.
     *
     * @return bool True when the href is the canonical active theme
     *              stylesheet.
     */
    private function isThemeStylesheet(string $href): bool
    {
        $themeSlug = $this->themeSlugFromUrl($href);

        if ($themeSlug === null) {
            return false;
        }

        $marker = 'wp-content/themes/' . $themeSlug . '/';

        $markerPos = strpos($href, $marker);

        if ($markerPos === false) {
            return false;
        }

        $relativePath = substr($href, $markerPos + strlen($marker));

        return preg_match('~^style\.css($|[?#])~', $relativePath) === 1;
    }

    /**
     * Resolve a stylesheet href into an absolute URL.
     *
     * Absolute URLs are preserved unchanged. Protocol-relative references
     * receive the base scheme. All other relative references — including
     * root-relative /wp-content/themes/... and ../wp-content/themes/...
     * — are resolved against the context's final URL, falling back to the
     * original URL when the final URL is unavailable.
     *
     * @param string            $href    The stylesheet href to resolve.
     * @param DetectionContext  $context The immutable detection context
     *                                   used as the resolution base.
     *
     * @return string The absolute stylesheet URL.
     */
    private function normalizeUrl(string $href, DetectionContext $context): string
    {
        if (str_contains($href, '://')) {
            return $href;
        }

        $baseUrl = $context->finalUrl();

        if ($baseUrl === '') {
            $baseUrl = $context->originalUrl();
        }

        return $this->resolveUrl($baseUrl, $href);
    }

    /**
     * Resolve a relative reference against a base URL.
     *
     * Protocol-relative references are prefixed with the base scheme, and
     * root-relative references are joined to the base origin. All other
     * relative references are joined to the base directory path with any
     * dot segments (./ and ../) removed.
     *
     * @param string $baseUrl The absolute base URL.
     * @param string $href    The relative reference to resolve.
     *
     * @return string The resolved absolute URL.
     */
    private function resolveUrl(string $baseUrl, string $href): string
    {
        $parts = parse_url($baseUrl);

        if ($parts === false) {
            return $href;
        }

        $scheme = strtolower((string) ($parts['scheme'] ?? 'https'));
        $host = (string) ($parts['host'] ?? '');
        $port = isset($parts['port']) ? ':' . $parts['port'] : '';

        $origin = $scheme . '://' . $host . $port;

        if (str_starts_with($href, '//')) {
            return $scheme . ':' . $href;
        }

        if (str_starts_with($href, '/')) {
            return $origin . $href;
        }

        $path = (string) ($parts['path'] ?? '');
        $slashPos = strrpos($path, '/');
        $directory = $slashPos === false ? '/' : substr($path, 0, $slashPos + 1);

        return $origin . $this->removeDotSegments($directory . $href);
    }

    /**
     * Remove every dot segment (./ and ../) from a path.
     *
     * A leading or trailing slash is preserved as found. Parent
     * references that would rise above the root are dropped.
     *
     * @param string $path The path to normalize.
     *
     * @return string The path with all dot segments removed.
     */
    private function removeDotSegments(string $path): string
    {
        $segments = [];
        $leadingSlash = str_starts_with($path, '/');
        $trailingSlash = str_ends_with($path, '/');

        foreach (explode('/', $path) as $segment) {
            if ($segment === '' || $segment === '.') {
                continue;
            }

            if ($segment === '..') {
                array_pop($segments);
                continue;
            }

            $segments[] = $segment;
        }

        return ($leadingSlash ? '/' : '')
            . implode('/', $segments)
            . ($trailingSlash ? '/' : '');
    }
}
