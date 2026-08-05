<?php

declare(strict_types=1);

namespace Tests\Unit\PluginDetection\WordPress;

use App\Modules\PluginDetection\PluginMetadata;
use App\Modules\PluginDetection\WordPress\PluginMetadataMapper;
use App\Modules\PluginDetection\WordPress\RawPluginMetadata;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the PluginMetadataMapper.
 *
 * Verifies the complete public contract of the mapper: raw plugin
 * metadata is translated into the canonical PluginMetadata value object
 * through a direct, side-effect free mapping. The slug is mapped onto
 * both the name and the slug, the extra array is preserved unchanged, a
 * missing extra array becomes an empty array, an empty slug maps to an
 * empty name and a null slug, the supplied raw metadata is never
 * modified, and the mapping is deterministic.
 *
 * The mapper is a pure translation layer: it performs no validation, no
 * normalization, no detection, no parsing, and no business logic.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use a real PluginMetadataMapper, a real RawPluginMetadata, and a
 * real PluginMetadata. No mocks, no fixtures, no filesystem, and no HTTP.
 */
final class PluginMetadataMapperTest extends TestCase
{
    /**
     * Map raw plugin metadata with a real mapper instance.
     *
     * @param RawPluginMetadata $raw The raw plugin metadata.
     *
     * @return PluginMetadata The resulting normalized plugin metadata.
     */
    private function map(RawPluginMetadata $raw): PluginMetadata
    {
        return (new PluginMetadataMapper())->map($raw);
    }

    /**
     * Build a raw plugin metadata instance.
     *
     * @param string               $slug       The detected plugin slug.
     * @param int                  $confidence The rule-provided confidence
     *                                         score.
     * @param array<string, mixed> $extra      Additional raw metadata.
     *
     * @return RawPluginMetadata The raw plugin metadata.
     */
    private function raw(string $slug, int $confidence = 0, array $extra = []): RawPluginMetadata
    {
        return new RawPluginMetadata(
            slug: $slug,
            confidence: $confidence,
            extra: $extra,
        );
    }

    /**
     * Verify that the mapping returns a PluginMetadata instance.
     */
    public function test_returns_plugin_metadata_instance(): void
    {
        $metadata = $this->map($this->raw('contact-form-7'));

        self::assertInstanceOf(PluginMetadata::class, $metadata);
    }

    /**
     * Verify that the plugin slug is mapped onto PluginMetadata::slug().
     */
    public function test_maps_slug_to_plugin_slug(): void
    {
        $metadata = $this->map($this->raw('contact-form-7'));

        self::assertSame('contact-form-7', $metadata->slug());
    }

    /**
     * Verify that the plugin slug is mapped onto PluginMetadata::name().
     */
    public function test_maps_slug_to_plugin_name(): void
    {
        $metadata = $this->map($this->raw('woocommerce'));

        self::assertSame('woocommerce', $metadata->name());
    }

    /**
     * Verify that the extra metadata is preserved unchanged.
     */
    public function test_preserves_extra_metadata(): void
    {
        $extra = [
            'source' => 'plugin-path',
            'path' => '/wp-content/plugins/woocommerce/',
            'markers' => ['woocommerce.php'],
        ];

        $metadata = $this->map($this->raw('woocommerce', extra: $extra));

        self::assertSame($extra, $metadata->extra());
    }

    /**
     * Verify that missing extra metadata becomes an empty array.
     */
    public function test_missing_extra_metadata_becomes_empty_array(): void
    {
        $metadata = $this->map($this->raw('contact-form-7'));

        self::assertSame([], $metadata->extra());
    }

    /**
     * Verify that an empty slug maps to an empty name and a null slug.
     */
    public function test_empty_slug_maps_to_empty_name_and_null_slug(): void
    {
        $metadata = $this->map($this->raw(''));

        self::assertSame('', $metadata->name());
        self::assertNull($metadata->slug());
    }

    /**
     * Verify that the raw plugin metadata is never modified.
     *
     * The mapper copies values onto a fresh PluginMetadata value object and
     * leaves the supplied RawPluginMetadata untouched.
     */
    public function test_does_not_modify_raw_plugin_metadata(): void
    {
        $raw = $this->raw('contact-form-7', confidence: 30, extra: ['source' => 'plugin-path']);

        $mapped = $this->map($raw);

        self::assertInstanceOf(PluginMetadata::class, $mapped);
        self::assertNotSame($raw, $mapped);
        self::assertSame('contact-form-7', $raw->slug());
        self::assertSame(30, $raw->confidence());
        self::assertSame(['source' => 'plugin-path'], $raw->extra());
    }

    /**
     * Verify that the mapping is deterministic.
     *
     * Repeated mapping of the same raw metadata always produces the same
     * PluginMetadata values.
     */
    public function test_mapping_is_deterministic(): void
    {
        $raw = $this->raw('contact-form-7', confidence: 30, extra: ['source' => 'plugin-path']);

        $first = $this->map($raw);
        $second = $this->map($raw);

        self::assertSame($first->name(), $second->name());
        self::assertSame($first->slug(), $second->slug());
        self::assertSame($first->extra(), $second->extra());
    }
}
