<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\WordPress;

use App\Modules\Detection\DetectionContext;
use DOMDocument;
use DOMElement;
use DOMXPath;

/**
 * Locates the active WordPress theme stylesheet URL from the HTML carried
 * by a DetectionContext.
 *
 * WordPressStyleCssLocator is responsible only for inspecting the HTML
 * already contained inside the DetectionContext, finding the stylesheet
 * reference that belongs to the WordPress themes directory
 * (/wp-content/themes/), and returning its URL. It performs no HTTP
 * requests, verifies nothing about the located stylesheet, and parses no
 * CSS metadata.
 *
 * Workflow:
 *
 * DetectionContext
 *   ↓
 * Read HTML
 *   ↓
 * Inspect <link rel="stylesheet">
 *   ↓
 * Locate stylesheet URL that belongs to /wp-content/themes/
 *   ↓
 * Return stylesheet URL
 *
 * Responsibilities:
 *
 * - Read the HTML body from the given detection context.
 * - Inspect the <link rel="stylesheet"> references contained in it.
 * - Locate the first stylesheet URL that belongs to /wp-content/themes/.
 * - Return the stylesheet URL, or null when none can be found.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: inspecting the HTML and locating the
 *   active theme stylesheet is the only concern. It performs no HTTP
 *   requests, no CSS parsing, no theme metadata extraction, no theme
 *   validation, and no URL resolution.
 * - Dependency Injection friendly: it depends solely on the immutable
 *   DetectionContext and needs no collaborators or infrastructure.
 * - Stateless, deterministic, and side-effect free: given the same
 *   DetectionContext, it always returns the same result.
 * - The HTML is parsed with DOMDocument and DOMXPath rather than heavy
 *   regular expressions.
 *
 * Future responsibilities — child theme detection, theme metadata
 * extraction, HTTP requests, CDN resolution, and theme validation — are
 * explicitly out of scope for this class.
 */
final readonly class WordPressStyleCssLocator
{
    /**
     * Locate the active WordPress theme stylesheet URL.
     *
     * Inspects the HTML already contained inside the given detection
     * context, selects the first <link rel="stylesheet"> reference whose
     * href belongs to /wp-content/themes/, and returns that href as-is.
     * The stylesheet is never verified, downloaded, or parsed.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return string|null The located WordPress theme stylesheet URL, or
     *                     null when the HTML is empty, unparseable, or
     *                     contains no matching stylesheet reference.
     */
    public function locate(DetectionContext $context): ?string
    {
        $html = $context->html();

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

        $nodes = (new DOMXPath($document))
            ->query('//link[@rel="stylesheet"][contains(@href, "/wp-content/themes/")]');

        if ($nodes === false) {
            return null;
        }

        foreach ($nodes as $node) {
            if (!$node instanceof DOMElement) {
                continue;
            }

            $href = $node->getAttribute('href');

            if ($href === '') {
                continue;
            }

            return $href;
        }

        return null;
    }
}
