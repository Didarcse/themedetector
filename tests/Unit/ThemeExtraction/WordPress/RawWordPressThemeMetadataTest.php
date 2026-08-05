<?php

declare(strict_types=1);

namespace Tests\Unit\ThemeExtraction\WordPress;

use App\Modules\ThemeExtraction\WordPress\RawWordPressThemeMetadata;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Unit tests for the RawWordPressThemeMetadata transport object.
 *
 * Verifies the complete public contract of the class: the constructor
 * stores the supplied fields, the fields() accessor returns them exactly,
 * an empty array is preserved, distinct instances keep separate state, and
 * the object is immutable after construction.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use no mocks and no external dependencies.
 */
final class RawWordPressThemeMetadataTest extends TestCase
{
    /**
     * Verify that the constructor stores the supplied fields.
     */
    public function test_stores_raw_fields(): void
    {
        $fields = ['Theme Name' => 'Twenty Twenty-Five', 'Version' => '1.0'];

        $metadata = new RawWordPressThemeMetadata($fields);

        self::assertSame($fields, $metadata->fields());
    }

    /**
     * Verify that fields() returns exactly the supplied array.
     */
    public function test_returns_same_fields(): void
    {
        $fields = [
            'Theme Name' => 'Twenty Twenty-Five',
            'Version' => '1.0',
            'Author' => 'the WordPress team',
        ];

        $metadata = new RawWordPressThemeMetadata($fields);

        self::assertSame($fields, $metadata->fields());
    }

    /**
     * Verify that an empty array is preserved.
     */
    public function test_returns_empty_array(): void
    {
        $metadata = new RawWordPressThemeMetadata([]);

        self::assertSame([], $metadata->fields());
    }

    /**
     * Verify that two objects keep separate state.
     */
    public function test_multiple_instances_are_independent(): void
    {
        $first = new RawWordPressThemeMetadata(['Theme Name' => 'First']);
        $second = new RawWordPressThemeMetadata(['Theme Name' => 'Second']);

        self::assertSame('First', $first->fields()['Theme Name']);
        self::assertSame('Second', $second->fields()['Theme Name']);

        $second = new RawWordPressThemeMetadata(['Theme Name' => 'Changed']);

        self::assertSame('First', $first->fields()['Theme Name']);
    }

    /**
     * Verify that the object cannot be modified after construction.
     */
    public function test_is_immutable(): void
    {
        $reflection = new ReflectionClass(RawWordPressThemeMetadata::class);

        self::assertTrue($reflection->isReadOnly());

        $metadata = new RawWordPressThemeMetadata(['Version' => '1.0']);

        $fields = $metadata->fields();
        $fields['Version'] = '2.0';

        self::assertSame(['Version' => '1.0'], $metadata->fields());
    }
}
