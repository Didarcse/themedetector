<?php

declare(strict_types=1);

namespace App\Modules\Detection\WordPress\Rules;

use App\Modules\Detection\Contracts\RuleInterface as SharedRuleInterface;

/**
 * Contract for every WordPress detection rule.
 *
 * Each rule inspects the provided HTML source and URL,
 * then returns structured evidence that can be consumed
 * by WordPressDetector and ConfidenceCalculator.
 *
 * Extends the shared RuleInterface to maintain cross-CMS
 * consistency while allowing WordPress-specific refinements.
 */
interface RuleInterface extends SharedRuleInterface
{
}
