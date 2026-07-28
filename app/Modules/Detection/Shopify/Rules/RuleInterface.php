<?php

declare(strict_types=1);

namespace App\Modules\Detection\Shopify\Rules;

use App\Modules\Detection\Contracts\RuleInterface as SharedRuleInterface;

/**
 * Contract for every Shopify detection rule.
 *
 * Each rule inspects the provided HTML source and URL,
 * then returns structured evidence that can be consumed
 * by ShopifyDetector and ConfidenceCalculator.
 *
 * Extends the shared RuleInterface to maintain cross-CMS
 * consistency while allowing Shopify-specific refinements.
 */
interface RuleInterface extends SharedRuleInterface
{
}
