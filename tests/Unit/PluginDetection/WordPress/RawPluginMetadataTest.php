<?php

declare(strict_types=1);

namespace Tests\Unit\PluginDetection\WordPress;

use App\Modules\PluginDetection\WordPress\RawPluginMetadata;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Unit tests for the RawPluginMetadata transport object.
 *
 * Verifies the complete public contract of the class: the constructor
 * stores the supplied slug, confidence score, and extra metadata; the
 * typed getters return them exactly; an empty extra array is preserved;
 * distinct instances keep separate state; and the object is immutable
 * after construction.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use no mocks and no external dependencies.
 */
final class RawPluginMetadataTest extends TestCase
{
    /**
     * Verify that the constructor stores the supplied slug.
     */
    public function test_stores_slug(): void
    {
        $metadata = new RawPluginMetadata(slug: 'contact-form-7');

        self::assertSame('contact-form-7', $metadata->slug());
    }

    /**
     * Verify that the constructor stores the supplied confidence score.
     */
    public function test_stores_confidence(): void
    {
        $metadata = new RawPluginMetadata(slug: 'contact-form-7', confidence: 30);

        self::assertSame(30, $metadata->confidence());
    }

    /**
     * Verify that the constructor stores the supplied extra metadata.
     */
    public function test_stores_extra_metadata(): void
    {
        $extra = [
            'plugins' => ['contact-form-7', 'woocommerce'],
            'source' => 'plugin-path',
            'matches' => 2,
        ];

        $metadata = new RawPluginMetadata(slug: 'contact-form-7', extra: $extra);

        self::assertSame($extra, $metadata->extra());
    }

    /**
     * Verify that slug() returns exactly the supplied slug.
     */
    public function test_returns_supplied_slug(): void
    {
        $metadata = new RawPluginMetadata(slug: 'woocommerce');

        self::assertSame('woocommerce', $metadata->slug());
    }

    /**
     * Verify that confidence() returns exactly the supplied confidence
     * score.
     */
    public function test_returns_supplied_confidence(): void
    {
        $metadata = new RawPluginMetadata(slug: 'woocommerce', confidence: 30);

        self::assertSame(30, $metadata->confidence());
    }

    /**
     * Verify that extra() returns exactly the supplied metadata.
     */
    public function test_returns_extra_metadata_unchanged(): void
    {
        $extra = [
            'plugins' => ['akismet', 'jetpack'],
            'nested' => ['key' => 'value'],
            'active' => true,
        ];

        $metadata = new RawPluginMetadata(slug: 'akismet', extra: $extra);

        self::assertSame($extra, $metadata->extra());
    }

    /**
     * Verify that an empty extra array is preserved.
     */
    public function test_returns_empty_extra_array(): void
    {
        $metadata = new RawPluginMetadata(slug: 'akismet');

        self::assertSame([], $metadata->extra());
    }

    /**
     * Verify that two objects keep separate state.
     */
    public function test_multiple_instances_are_independent(): void
    {
        $first = new RawPluginMetadata(slug: 'first-plugin', confidence: 10);
        $second = new RawPluginMetadata(slug: 'second-plugin', confidence: 30);

        self::assertSame('first-plugin', $first->slug());
        self::assertSame(10, $first->confidence());
        self::assertSame('second-plugin', $second->slug());
        self::assertSame(30, $second->confidence());

        $second = new RawPluginMetadata(slug: 'changed-plugin', confidence: 50);

        self::assertSame('first-plugin', $first->slug());
        self::assertSame(10, $first->confidence());
    }

    /**
     * Verify that the object cannot be modified after construction.
     */
    public function test_is_immutable(): void
    {
        $reflection = new ReflectionClass(RawPluginMetadata::class);

        self::assertTrue($reflection->isReadOnly());

        $metadata = new RawPluginMetadata(
            slug: 'contact-form-7',
            extra: ['plugins' => ['contact-form-7']],
        );

        $extra = $metadata->extra();
        $extra['plugins'] = ['contact-form-7', 'woocommerce'];

        self::assertSame(['plugins' => ['contact-form-7']], $metadata->extra());
    }
}
