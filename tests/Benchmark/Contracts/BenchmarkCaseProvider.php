<?php

declare(strict_types=1);

namespace Tests\Benchmark\Contracts;

use Tests\Benchmark\BenchmarkCase;

/**
 * Provides a collection of benchmark cases for one platform or category.
 *
 * BenchmarkCaseProvider is the composition contract of the Detection
 * Benchmark Suite. A provider owns the benchmark cases for a platform
 * (WordPress, Shopify, Webflow, Wix) or for a specific category within a
 * platform (popular themes, default themes, commercial themes) and exposes
 * them as a deterministic list.
 *
 * Responsibilities:
 *
 * - Provide the benchmark cases for its platform or category.
 * - Nothing else.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: case provision only. A provider
 *   performs no detection, no scoring, no parsing, and no HTTP.
 * - Stateless, deterministic, and side-effect free: given the same
 *   provider, cases() always returns the same cases in the same order.
 * - Open/Closed Principle: new platforms and categories are introduced by
 *   new providers without modifying the BenchmarkRunner.
 *
 * Future Compatibility:
 *
 * - The suite grows by adding providers, never by changing the runner or
 *   the report model.
 */
interface BenchmarkCaseProvider
{
    /**
     * Return the benchmark cases owned by this provider.
     *
     * Cases are returned in a stable, deterministic order.
     *
     * @return list<BenchmarkCase> The provided benchmark cases.
     */
    public function cases(): array;
}
