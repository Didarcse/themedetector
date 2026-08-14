<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\Drupal;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\Drupal\Rules\HtmlSignatureRule;
use App\Modules\Detection\Drupal\Rules\MetaGeneratorRule;
use App\Modules\Detection\Drupal\Rules\ScriptFingerprintRule;

/**
 * Gates Drupal theme extraction on Drupal-specific CMS evidence.
 *
 * DrupalContextGate answers a single boolean question: does the HTML
 * carried by the DetectionContext contain reliable Drupal-specific
 * evidence? It is the CMS-context gate that keeps Drupal theme extraction
 * honest: a theme path under /themes/contrib/ or /themes/custom/ only
 * names a Drupal theme when the page is demonstrably built with Drupal.
 *
 * The gate reuses the three strongest rules of the production Drupal
 * detection engine — MetaGeneratorRule, ScriptFingerprintRule, and
 * HtmlSignatureRule — as collaborators rather than duplicating their
 * detection logic. Passing requires at least one of the three to match:
 *
 * - The generator meta tag names Drupal (MetaGeneratorRule, weight 35).
 * - A well-known Drupal JavaScript fingerprint is present
 *   (ScriptFingerprintRule, weight 25), such as window.Drupal,
 *   drupalSettings, Drupal.settings, Drupal.behaviors, or Drupal.once.
 * - A well-known Drupal HTML signature is present (HtmlSignatureRule,
 *   weight 15), such as data-drupal-selector, drupal-settings-json,
 *   js-drupal-dialog, or toolbar-bar.
 *
 * The AssetPathRule and ApiEndpointRule are deliberately excluded: their
 * signals — /core/, /modules/, /themes/ asset paths and /jsonapi/, /node/,
 * /entity/, /user/login endpoints — are generic CMS-agnostic paths that
 * appear on non-Drupal pages and are too permissive to gate an extraction
 * on. This is an explicit conservatism trade-off: the gate prefers to miss
 * an extractable Drupal theme over reporting a theme on a page that is not
 * Drupal.
 *
 * Design philosophy:
 *
 * - Reuse over duplication: the gate composes existing production rules
 *   instead of re-implementing Drupal detection, keeping a single source
 *   of truth for each detection signal.
 * - Conservative gating: only the strongest, Drupal-specific signals gate
 *   extraction; generic paths never do.
 * - Single Responsibility Principle: the gate answers one boolean question
 *   and performs no locating, no mapping, and no extraction.
 * - Stateless, deterministic, and side-effect free: given the same
 *   DetectionContext, it always returns the same answer.
 */
final readonly class DrupalContextGate
{
    /**
     * Create a new DrupalContextGate.
     *
     * @param MetaGeneratorRule      $metaGeneratorRule     Detects Drupal via
     *                                                      the generator meta
     *                                                      tag.
     * @param ScriptFingerprintRule  $scriptFingerprintRule Detects Drupal via
     *                                                      well-known
     *                                                      JavaScript
     *                                                      fingerprints.
     * @param HtmlSignatureRule      $htmlSignatureRule     Detects Drupal via
     *                                                      well-known HTML
     *                                                      signatures.
     */
    public function __construct(
        private MetaGeneratorRule $metaGeneratorRule,
        private ScriptFingerprintRule $scriptFingerprintRule,
        private HtmlSignatureRule $htmlSignatureRule,
    ) {
    }

    /**
     * Return whether the context carries reliable Drupal-specific evidence.
     *
     * The context passes when at least one of the three strongest Drupal
     * detection rules matches the HTML: the generator meta tag names
     * Drupal, a well-known Drupal JavaScript fingerprint is present, or a
     * well-known Drupal HTML signature is present. The URL handed to each
     * rule is the context's final URL, falling back to the original URL
     * when the final URL is empty. The context is never modified.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return bool True when reliable Drupal-specific evidence is present.
     */
    public function passes(DetectionContext $context): bool
    {
        $url = $context->finalUrl() !== '' ? $context->finalUrl() : $context->originalUrl();
        $html = $context->html();

        if ($this->metaGeneratorRule->evaluate($html, $url)['matched']) {
            return true;
        }

        if ($this->scriptFingerprintRule->evaluate($html, $url)['matched']) {
            return true;
        }

        return $this->htmlSignatureRule->evaluate($html, $url)['matched'];
    }
}
