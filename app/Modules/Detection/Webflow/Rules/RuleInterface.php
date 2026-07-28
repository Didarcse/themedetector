<?php

declare(strict_types=1);

namespace App\Modules\Detection\Webflow\Rules;

use App\Modules\Detection\Contracts\RuleInterface as SharedRuleInterface;

/**
 * Contract for every Webflow detection rule.
 *
 * Extends the shared RuleInterface to maintain cross-CMS
 * consistency while allowing Webflow-specific refinements.
 */
interface RuleInterface extends SharedRuleInterface
{
}
