<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\Shopify;

use App\Modules\Detection\DetectionContext;

/**
 * Locates Shopify theme object bodies from the HTML carried by a
 * DetectionContext.
 *
 * ShopifyThemeLocator is responsible only for discovering the body of every
 * window.Shopify object literal already present in the HTML inside the
 * detection context. It scans the inline bodies of script blocks for the
 * canonical plain assignment form emitted by Shopify Online Store 2.0 —
 * `window.Shopify = { ... }` — and returns the interior of every matched
 * object literal between its braces.
 *
 * Rules:
 *
 * - Only inline script bodies are inspected; script tags that load an
 *   external source (src attribute) and structured-data blocks
 *   (type="application/json" or type="application/ld+json") are skipped.
 * - Only the canonical plain assignment `window.Shopify = {` qualifies.
 *   The guard idiom `window.Shopify = window.Shopify || { ... }`, which is
 *   not emitted by Shopify Online Store 2.0, is deliberately not matched.
 * - Object bodies are delimited by balanced braces; braces and quotes
 *   inside string literals never affect the balance, so values such as
 *   nested objects and string contents are handled correctly.
 * - A candidate whose braces never balance is malformed and is skipped.
 * - The window.Shopify object is never executed and never fetched: only
 *   the static markup is inspected.
 *
 * Design philosophy:
 *
 * - HTML Discovery Engine: the locator discovers theme evidence that
 *   already exists in the markup and returns the raw object body; it never
 *   invents a theme and never parses JavaScript values.
 * - Single Responsibility Principle: locating Shopify object bodies is the
 *   only concern. It performs no HTTP requests, no value parsing, no
 *   metadata extraction, no confidence calculation, and no Shopify
 *   business rules.
 * - Stateless, deterministic, and side-effect free: given the same
 *   DetectionContext, it always returns the same bodies.
 * - Dependency Injection friendly: it depends only on the immutable
 *   DetectionContext.
 *
 * The class knows nothing about ThemeMetadata or ThemeExtractionResult.
 */
final readonly class ShopifyThemeLocator
{
    /**
     * Locate every window.Shopify object body in the detection context.
     *
     * Inspects the inline bodies of every script block in the HTML inside
     * the given detection context, finds every canonical
     * `window.Shopify = {` assignment, and returns the interior of each
     * matched object literal. Bodies are returned in document order.
     * Returns an empty list when the HTML is empty or contains no matching
     * assignment. The window.Shopify object is never executed and never
     * fetched.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return list<string> The window.Shopify object bodies, in document
     *                      order.
     */
    public function locate(DetectionContext $context): array
    {
        $bodies = [];

        foreach ($this->scriptBodies($context->html()) as $script) {
            $matches = [];

            preg_match_all(
                '/window\.Shopify\s*=\s*\{/',
                $script,
                $matches,
                PREG_OFFSET_CAPTURE,
            );

            foreach ($matches[0] as $occurrence) {
                $body = $this->objectBody($script, $occurrence[1] + strlen($occurrence[0]));

                if ($body === null) {
                    continue;
                }

                $bodies[] = $body;
            }
        }

        return $bodies;
    }

    /**
     * Extract the interior of a balanced object literal starting at a
     * brace.
     *
     * Walks the script from the offset immediately after the opening brace,
     * counting brace depth while skipping string literals so that braces
     * and quotes inside strings never affect the balance. Returns the text
     * between the opening brace and its matching closing brace, or null
     * when the object never balances.
     *
     * @param string $script The script body being scanned.
     * @param int    $offset The offset immediately after the opening brace.
     *
     * @return string|null The object interior, or null when unbalanced.
     */
    private function objectBody(string $script, int $offset): ?string
    {
        $length = strlen($script);
        $depth = 1;
        $quote = null;
        $escaped = false;

        for ($i = $offset; $i < $length; $i++) {
            $char = $script[$i];

            if ($quote !== null) {
                if ($escaped) {
                    $escaped = false;
                } elseif ($char === '\\') {
                    $escaped = true;
                } elseif ($char === $quote) {
                    $quote = null;
                }

                continue;
            }

            if ($char === '"' || $char === "'") {
                $quote = $char;

                continue;
            }

            if ($char === '{') {
                $depth++;

                continue;
            }

            if ($char === '}') {
                $depth--;

                if ($depth === 0) {
                    return substr($script, $offset, $i - $offset);
                }
            }
        }

        return null;
    }

    /**
     * Yield the inline body of every qualifying script block.
     *
     * Scans the HTML for script blocks. Blocks with a src attribute load
     * their body externally and are skipped, as are structured-data blocks
     * (type="application/json" or type="application/ld+json"), which never
     * carry JavaScript assignments.
     *
     * @param string $html The complete HTML source of the target website.
     *
     * @return iterable<string> The inline bodies of the qualifying script
     *                          blocks, in document order.
     */
    private function scriptBodies(string $html): iterable
    {
        if ($html === '') {
            return;
        }

        $matches = [];

        if (preg_match_all('~<script\b([^>]*)>(.*?)</script\s*>~is', $html, $matches, PREG_SET_ORDER) === false) {
            return;
        }

        foreach ($matches as $match) {
            $attributes = $match[1];

            if (preg_match('/\bsrc\s*=/i', $attributes) === 1) {
                continue;
            }

            if (preg_match('/\btype\s*=\s*["\']?application\/(?:json|ld\+json)["\']?/i', $attributes) === 1) {
                continue;
            }

            yield $match[2];
        }
    }
}
