<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection\Rules;

/**
 * Shared foundation for every Technology Detection rule.
 *
 * AbstractTechnologyRule provides the reusable HTML asset extraction
 * utilities that technology rules rely on: locating script src
 * attributes, locating linked stylesheet href attributes, normalizing a
 * URL to its basename, and extracting a normalized hostname. Concrete
 * rules own their signal-specific patterns and confidence decisions.
 *
 * Responsibilities:
 *
 * - Extract script src attributes from HTML.
 * - Extract stylesheet link href attributes from HTML.
 * - Normalize asset URLs to their basename and hostname.
 * - Provide the canonical no-match evaluation result.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: asset extraction is centralized
 *   here; each concrete rule owns only its own detection signal.
 * - Open/Closed Principle: new rules reuse the shared utilities without
 *   modifying this class.
 * - Stateless, deterministic, and side-effect free: the helpers return
 *   the same output for the same input.
 *
 * The class performs no detection itself and knows nothing about
 * JavaScript libraries, CDNs, analytics platforms, or other technologies.
 */
abstract readonly class AbstractTechnologyRule implements TechnologyRuleInterface
{
    private const HTML_SCRIPT_SRC_PATTERN = '/<script\b[^>]*\bsrc\s*=\s*["\']([^"\']+)["\']/i';

    private const HTML_LINK_HREF_PATTERN = '/<link\b[^>]*\bhref\s*=\s*["\']([^"\']+)["\']/i';

    /**
     * Extract every script src URL present in the supplied HTML.
     *
     * URLs are returned trimmed, in document order, and de-duplicated by
     * exact string. Malformed attributes (empty values) are discarded.
     *
     * @param string $html The complete HTML source of the target website.
     *
     * @return list<string> The script src URLs, in document order.
     */
    protected function scriptSrcs(string $html): array
    {
        if (preg_match_all(self::HTML_SCRIPT_SRC_PATTERN, $html, $matches) < 1) {
            return [];
        }

        $srcs = [];

        foreach ($matches[1] as $src) {
            $src = trim($src);

            if ($src !== '') {
                $srcs[$src] = true;
            }
        }

        return array_keys($srcs);
    }

    /**
     * Extract every stylesheet link href URL present in the supplied HTML.
     *
     * URLs are returned trimmed, in document order, and de-duplicated by
     * exact string. Malformed attributes (empty values) are discarded.
     *
     * @param string $html The complete HTML source of the target website.
     *
     * @return list<string> The stylesheet href URLs, in document order.
     */
    protected function stylesheetHrefs(string $html): array
    {
        if (preg_match_all(self::HTML_LINK_HREF_PATTERN, $html, $matches) < 1) {
            return [];
        }

        $hrefs = [];

        foreach ($matches[1] as $href) {
            $href = trim($href);

            if ($href !== '') {
                $hrefs[$href] = true;
            }
        }

        return array_keys($hrefs);
    }

    /**
     * Extract the normalized hostname from an asset URL.
     *
     * Absolute (https:// and http://) and protocol-relative (//) URLs are
     * supported. The hostname is lowercased because hostnames are
     * case-insensitive; the port is preserved.
     *
     * @param string $url The asset URL.
     *
     * @return string|null The lowercased hostname, or null when the URL
     *                     carries no recognizable host.
     */
    protected function hostOf(string $url): ?string
    {
        if (preg_match('~^(?:https?:)?//([^/?#]+)~i', $url, $matches) !== 1) {
            return null;
        }

        return strtolower($matches[1]);
    }

    /**
     * Extract the basename of an asset URL.
     *
     * The basename is the final path segment with the query string and
     * fragment removed, for example https://cdn.example.com/vendor/x.js
     * becomes x.js.
     *
     * @param string $url The asset URL.
     *
     * @return string The URL basename.
     */
    protected function basenameOf(string $url): string
    {
        $path = (string) preg_replace('/[?#].*$/', '', $url);
        $path = rtrim($path, '/');

        $slash = strrpos($path, '/');

        if ($slash === false) {
            return $path;
        }

        return substr($path, $slash + 1);
    }

    /**
     * Return the canonical no-match evaluation result.
     *
     * @return array{matched: false, confidence: 0, metadata: array<string, mixed>}
     */
    protected function noMatch(): array
    {
        return [
            'matched' => false,
            'confidence' => 0,
            'metadata' => [],
        ];
    }

    /**
     * Build the normalized evidence metadata array.
     *
     * The signal identifies which evidence matched; assetPath and
     * hostname describe the matched asset when asset evidence fired; and
     * version carries a safely extracted technology version when one was
     * found. Absent values are omitted so that only observed facts enter
     * the metadata.
     *
     * @param string      $signal    The evidence signal identifier.
     * @param string|null $assetPath The matched asset URL, or null when no
     *                               asset evidence was found.
     * @param string|null $hostname  The normalized asset hostname, or null
     *                               when unknown.
     * @param string|null $version   The extracted technology version, or
     *                               null when unknown.
     *
     * @return array<string, mixed> The normalized evidence metadata.
     */
    protected function evidence(
        string $signal,
        ?string $assetPath,
        ?string $hostname,
        ?string $version,
    ): array {
        $metadata = ['signal' => $signal];

        if ($assetPath !== null) {
            $metadata['assetPath'] = $assetPath;
        }

        if ($hostname !== null) {
            $metadata['hostname'] = $hostname;
        }

        if ($version !== null) {
            $metadata['version'] = $version;
        }

        return $metadata;
    }
}
