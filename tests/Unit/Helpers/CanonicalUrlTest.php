<?php

declare(strict_types=1);

namespace Tests\Unit\Helpers;

use PHPUnit\Framework\TestCase;

/**
 * Verifies the canonical URL helper for SEO metadata.
 *
 * The helper is the single source of truth for the canonical production
 * origin and must always produce absolute https URLs under that origin,
 * never local development domains.
 */
final class CanonicalUrlTest extends TestCase
{
    public function test_default_path_is_the_homepage(): void
    {
        $this->assertSame('https://themedetectortool.com/', canonical_url());
    }

    public function test_leading_slash_path_builds_absolute_url(): void
    {
        $this->assertSame('https://themedetectortool.com/about', canonical_url('/about'));
    }

    public function test_path_without_leading_slash_is_normalized(): void
    {
        $this->assertSame('https://themedetectortool.com/about', canonical_url('about'));
    }

    public function test_nested_path_is_built_under_the_production_origin(): void
    {
        $this->assertSame(
            'https://themedetectortool.com/docs/getting-started',
            canonical_url('/docs/getting-started'),
        );
    }
}
