<?php

declare(strict_types=1);

namespace App\Modules\PluginDetection\WordPress;

use App\Modules\PluginDetection\PluginMetadata;

/**
 * Converts RawPluginMetadata into the PluginMetadata domain object.
 *
 * PluginMetadataMapper is the metadata translation layer between the raw
 * plugin detection pipeline and the normalized domain model. It is
 * responsible only for translating the raw plugin metadata into the
 * canonical, CMS-agnostic PluginMetadata value object. It applies a
 * direct translation and nothing else: no value inference, no name
 * normalization, no version validation, and no business logic.
 *
 * Mapping:
 *
 * RawPluginMetadata
 *   ↓
 * slug
 *   ↓
 * PluginMetadata::slug
 *   ↓
 * PluginMetadata::name
 *   ↓
 * extra
 *   ↓
 * PluginMetadata::extra
 *
 * Responsibilities:
 *
 * - Translate the raw plugin metadata into a PluginMetadata value object.
 * - Map the plugin slug.
 * - Populate PluginMetadata using the available raw metadata.
 * - Preserve all platform-specific metadata inside extra().
 * - Treat missing metadata as null.
 * - Nothing else.
 *
 * Mapping rules:
 *
 * - The slug is mapped directly onto PluginMetadata::slug and
 *   PluginMetadata::name without inference or normalization.
 * - The extra array is preserved unchanged inside PluginMetadata::extra.
 * - The mapper never infers values, never normalizes plugin names, never
 *   validates versions, never splits tags, and never modifies the
 *   supplied metadata.
 *
 * Design philosophy:
 *
 * - Mapper: it translates data between two representations and nothing
 *   more.
 * - Single Responsibility Principle: translating raw metadata is the only
 *   concern. It performs no detection, no parsing, no validation, no
 *   confidence calculation, and no WordPress business rules.
 * - Immutable Mapping: the supplied RawPluginMetadata is never modified,
 *   and the produced PluginMetadata is a fresh, immutable value object.
 * - Stateless, deterministic, and side-effect free: given the same raw
 *   metadata, it always produces the same PluginMetadata.
 * - Dependency Injection friendly: it needs no collaborators and depends
 *   only on the RawPluginMetadata it receives.
 *
 * Future Compatibility:
 *
 * - Future metadata fields — version, author, description, license, tags,
 *   PHP requirements, CMS requirements, and other platform-specific
 *   metadata — may be mapped without changing the responsibility of this
 *   class.
 *
 * The class creates no PluginDetectionResult and knows nothing about the
 * detection workflow that surrounds it.
 */
final readonly class PluginMetadataMapper
{
    /**
     * Map the raw metadata to a PluginMetadata value object.
     *
     * The plugin slug becomes the plugin name and, when present, the
     * plugin slug; an empty slug is treated as missing and maps to null
     * for the nullable slug property. The additional raw metadata is
     * preserved unchanged inside the extra() array.
     *
     * @param RawPluginMetadata $raw The raw plugin metadata.
     *
     * @return PluginMetadata The normalized PluginMetadata value object.
     */
    public function map(RawPluginMetadata $raw): PluginMetadata
    {
        $slug = $raw->slug();

        return new PluginMetadata(
            name: $slug,
            slug: $slug !== '' ? $slug : null,
            extra: $raw->extra(),
        );
    }
}
