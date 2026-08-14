<?php

declare(strict_types=1);

namespace App\Modules\ThemeExtraction\Joomla;

use App\Modules\Detection\DetectionContext;
use App\Modules\Detection\Joomla\Rules\MetaGeneratorRule;
use App\Modules\Detection\Joomla\Rules\ScriptFingerprintRule;

/**
 * Gates Joomla theme extraction on Joomla-specific CMS evidence.
 *
 * JoomlaContextGate answers a single boolean question: does the HTML
 * carried by the DetectionContext contain reliable Joomla-specific evidence?
 * It is the CMS-context gate that keeps Joomla template extraction honest:
 * a template directory path under /templates/ only names a Joomla template
 * when the page is demonstrably built with Joomla.
 *
 * The gate reuses the two strongest rules of the production Joomla
 * detection engine — MetaGeneratorRule and ScriptFingerprintRule — as
 * collaborators rather than duplicating their detection logic. Passing
 * requires at least one of the two to match:
 *
 * - The generator meta tag names Joomla (MetaGeneratorRule, weight 35).
 * - A well-known Joomla JavaScript fingerprint is present
 *   (ScriptFingerprintRule, weight 25), such as window.Joomla,
 *   Joomla.getOptions, Joomla.submitbutton, or Joomla.JText.
 *
 * The weaker Joomla rules (AssetPathRule, HtmlSignatureRule, and
 * ApiEndpointRule) are deliberately excluded: their signals — /media/
 * asset paths, option=com_ forms, and Joomla API endpoints — are far more
 * likely to appear on non-Joomla pages and are too permissive to gate an
 * extraction on. This is an explicit conservatism trade-off: the gate
 * prefers to miss an extractable Joomla template over reporting a template
 * on a page that is not Joomla.
 *
 * Design philosophy:
 *
 * - Reuse over duplication: the gate composes existing production rules
 *   instead of re-implementing Joomla detection, keeping a single source
 *   of truth for each detection signal.
 * - Conservative gating: only the strongest, Joomla-specific signals gate
 *   extraction.
 * - Single Responsibility Principle: the gate answers one boolean question
 *   and performs no locating, no mapping, and no extraction.
 * - Stateless, deterministic, and side-effect free: given the same
 *   DetectionContext, it always returns the same answer.
 */
final readonly class JoomlaContextGate
{
    /**
     * Create a new JoomlaContextGate.
     *
     * @param MetaGeneratorRule       $metaGeneratorRule      Detects Joomla
     *                                                         via the generator
     *                                                         meta tag.
     * @param ScriptFingerprintRule   $scriptFingerprintRule  Detects Joomla
     *                                                         via well-known
     *                                                         JavaScript
     *                                                         fingerprints.
     */
    public function __construct(
        private MetaGeneratorRule $metaGeneratorRule,
        private ScriptFingerprintRule $scriptFingerprintRule,
    ) {
    }

    /**
     * Return whether the context carries reliable Joomla-specific evidence.
     *
     * The context passes when at least one of the two strongest Joomla
     * detection rules matches the HTML: the generator meta tag names
     * Joomla, or a well-known Joomla JavaScript fingerprint is present.
     * The URL handed to each rule is the context's final URL, falling back
     * to the original URL when the final URL is empty. The context is never
     * modified.
     *
     * @param DetectionContext $context The immutable detection context
     *                                  containing the HTTP response data.
     *
     * @return bool True when reliable Joomla-specific evidence is present.
     */
    public function passes(DetectionContext $context): bool
    {
        $url = $context->finalUrl() !== '' ? $context->finalUrl() : $context->originalUrl();
        $html = $context->html();

        if ($this->metaGeneratorRule->evaluate($html, $url)['matched']) {
            return true;
        }

        return $this->scriptFingerprintRule->evaluate($html, $url)['matched'];
    }
}
