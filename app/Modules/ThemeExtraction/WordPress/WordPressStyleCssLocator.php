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
 * inside the DetectionContext. It never guesses URLs: every result is
 * discovered from an existing <link rel="stylesheet"> reference and then
 * resolved into an absolute URL against the context's final URL.
 *
 * Workflow:
 *
 * DetectionContext
 *   ↓
 * Read HTML
 *   ↓
 * Load DOMDocument
 *   ↓
 * Create DOMXPath
 *   ↓
 * Locate every <link rel="stylesheet">
 *   ↓
 * Inspect href
 *   ↓
 * Find stylesheet belonging to /wp-content/themes/
 *   ↓
 * Return stylesheet URL
 *   ↓
 * Otherwise return null
 *
 * Responsibilities:
 *
 * - Read the HTML body from the given detection context.
 * - Load it into a DOMDocument and inspect every <link rel="stylesheet">.
 * - Select the first href that belongs to /wp-content/themes/ and names a
 *   style.css file.
 * - Resolve the selected href into an absolute URL against the context's
 *   final URL, falling back to the original URL.
 * - Return the stylesheet URL, or null when none can be found.
 *
 * Selection rules:
 *
 * A href is treated as a valid theme stylesheet only when it contains both
 * /wp-content/themes/ and style.css. This naturally excludes wp-includes
 * assets, plugin stylesheets (including Elementor and WooCommerce CSS),
 * block library CSS, Google Fonts, and all other external or unrelated
 * stylesheets, because none of them lives under /wp-content/themes/.
 *
 * Design philosophy:
 *
 * - HTML Discovery Engine: the locator discovers URLs that already exist
 *   in the markup; it never assembles or guesses a URL, never appends
 *   /wp-content/themes/, and never assumes the theme directory name.
 * - Single Responsibility Principle: locating the active theme stylesheet
 *   is the only concern. It performs no HTTP requests, no CSS parsing, no
 *   metadata extraction, no confidence calculation, and no WordPress
 *   business rules.
 * - Stateless, deterministic, and side-effect free: given the same
 *   DetectionContext, it always returns the same result.
 * - Dependency Injection friendly: it depends only on the immutable
 *   DetectionContext and the DOM extension.
 *
 * Future architecture:
 *
 * Future versions may extend this locator to also discover child theme
 * stylesheets, editor-style.css, rtl.css, theme.json, and screenshot.png
 * without changing the public API.
 *
 * The class knows nothing about ThemeMetadata or ThemeExtractionResult.
 */
final readonly class WordPressStyleCssLocator
{
    /**
     * Locate the active WordPress theme stylesheet URL.
     *
     * Inspects the HTML already contained inside the given detection
     * context, selects the first <link rel="stylesheet"> href that belongs
     * to /wp-content/themes/ and names a style.css file, and returns that
     * href resolved into an absolute URL against the context's final URL
     * (falling back to the original URL). Returns null when the HTML is
     * empty, unparseable, or contains no valid theme stylesheet. The
     * stylesheet is never verified, downloaded, or parsed.
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

        return null;
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
     * A href qualifies only when it references a file that both lives
     * under the WordPress themes directory (/wp-content/themes/) and is
     * named style.css. Everything else — plugin stylesheets, wp-includes
     * assets, block library CSS, Google Fonts, and external CSS — is
     * rejected by this rule.
     *
     * @param string $href The raw stylesheet href as found in the markup.
     *
     * @return bool True when the href is an active theme stylesheet.
     */
    private function isThemeStylesheet(string $href): bool
    {
        return str_contains($href, '/wp-content/themes/')
            && str_contains($href, 'style.css');
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
