<?php

declare(strict_types=1);

namespace Tests\Unit\TechnologyDetection;

use App\Modules\TechnologyDetection\Rules\JQueryRule;
use App\Modules\TechnologyDetection\TechnologyMetadataMapper;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the TechnologyMetadataMapper.
 *
 * Verifies the rule evidence to TechnologyMetadata mapping contract: the
 * rule's static identity is carried over, a non-empty string version in
 * the evidence is promoted to the first-class version property (and
 * removed from the extra payload), and an absent or empty version leaves
 * the version property null.
 */
final class TechnologyMetadataMapperTest extends TestCase
{
    private const URL = 'https://example.com';

    /**
     * Verify that the rule identity is carried over and that a version in
     * the evidence is promoted to the first-class version property.
     */
    public function test_maps_identity_and_promotes_version(): void
    {
        $html = '<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>';
        $rule = new JQueryRule();
        $evaluation = $rule->evaluate($html, self::URL);
        self::assertTrue($evaluation['matched']);

        $metadata = (new TechnologyMetadataMapper())->map($rule, $evaluation['metadata']);

        self::assertSame('jQuery', $metadata->name());
        self::assertSame('jquery', $metadata->slug());
        self::assertSame('JavaScript Library', $metadata->category());
        self::assertSame('3.7.1', $metadata->version());
        self::assertSame('script-src', $metadata->extra()['signal']);
        self::assertSame('code.jquery.com', $metadata->extra()['hostname']);
        self::assertArrayNotHasKey('version', $metadata->extra());
    }

    /**
     * Verify that an empty string version is treated as absent and is
     * kept out of the extra payload.
     */
    public function test_does_not_promote_empty_string_version(): void
    {
        $rule = new JQueryRule();
        $metadata = [
            'signal' => 'inline-global',
            'version' => '',
        ];

        $metadata = (new TechnologyMetadataMapper())->map($rule, $metadata);

        self::assertNull($metadata->version());
        self::assertArrayNotHasKey('version', $metadata->extra());
    }

    /**
     * Verify that evidence without a version leaves the version property
     * null and keeps every evidence key in the extra payload.
     */
    public function test_keeps_version_null_when_evidence_has_none(): void
    {
        $rule = new JQueryRule();
        $metadata = [
            'signal' => 'inline-global',
        ];

        $metadata = (new TechnologyMetadataMapper())->map($rule, $metadata);

        self::assertNull($metadata->version());
        self::assertSame(['signal' => 'inline-global'], $metadata->extra());
    }

    /**
     * Verify that a version extracted from the asset path is reflected in
     * the evidence passed to the mapper.
     */
    public function test_extracts_version_from_asset_path(): void
    {
        $html = '<script src="https://unpkg.com/jquery@3.7.1/dist/jquery.min.js"></script>';
        $rule = new JQueryRule();

        $evidence = $rule->evaluate($html, self::URL);

        self::assertTrue($evidence['matched']);
        self::assertSame('3.7.1', $evidence['metadata']['version']);
    }
}
