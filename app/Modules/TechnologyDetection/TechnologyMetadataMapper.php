<?php

declare(strict_types=1);

namespace App\Modules\TechnologyDetection;

use App\Modules\TechnologyDetection\Rules\TechnologyRuleInterface;

/**
 * Maps raw technology rule evidence to a normalized TechnologyMetadata.
 *
 * TechnologyMetadataMapper is the canonical mapping step of the
 * Technology Detection Engine. It combines the static technology identity
 * exposed by a TechnologyRuleInterface implementation with the runtime
 * evidence returned by that rule's evaluate() call, and produces a single
 * immutable TechnologyMetadata value.
 *
 * Responsibilities:
 *
 * - Carry the rule's static identity fields into the metadata.
 * - Promote a safely extracted version from the evidence into the
 *   first-class version property.
 * - Keep the remaining evidence in the category-specific extra payload.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: mapping raw evidence to normalized
 *   metadata is the only concern. It performs no detection, no parsing,
 *   and no confidence calculation.
 * - Deterministic: the same rule and evidence always map to the same
 *   metadata.
 * - Stateless and side-effect free.
 *
 * Future Compatibility:
 *
 * - Evidence keys introduced by future rules flow into extra()
 *   automatically; only the version key is treated as first-class.
 */
final readonly class TechnologyMetadataMapper
{
    /**
     * Map rule evidence to a normalized TechnologyMetadata value.
     *
     * The identity values returned by the rule's technology() are carried
     * into the result unchanged. When the evidence carries a non-empty
     * version string it becomes the first-class version; every other
     * evidence entry, including the signal, asset path, and hostname, is
     * preserved in the extra payload.
     *
     * @param TechnologyRuleInterface $rule     The rule that produced the
     *                                          evidence.
     * @param array<string, mixed>    $evidence The raw evidence returned
     *                                          by the rule's evaluate().
     *
     * @return TechnologyMetadata The normalized technology metadata.
     */
    public function map(TechnologyRuleInterface $rule, array $evidence): TechnologyMetadata
    {
        $identity = $rule->technology();

        $version = $identity->version();

        if (is_string($evidence['version'] ?? null) && $evidence['version'] !== '') {
            $version = $evidence['version'];
        }

        $extra = $evidence;
        unset($extra['version']);

        return new TechnologyMetadata(
            name: $identity->name(),
            slug: $identity->slug(),
            category: $identity->category(),
            version: $version,
            vendor: $identity->vendor(),
            vendorUrl: $identity->vendorUrl(),
            description: $identity->description(),
            documentationUrl: $identity->documentationUrl(),
            license: $identity->license(),
            tags: $identity->tags(),
            extra: $extra,
        );
    }
}
