<?php

declare(strict_types=1);

namespace Tests\Benchmark;

/**
 * Immutable definition of a single benchmark scenario.
 *
 * BenchmarkCase is the unit of evaluation of the Detection Benchmark
 * Suite. It carries everything the BenchmarkRunner needs to exercise the
 * detection engine against a representative website: the target URL, the
 * offline HTML fixture that stands in for a real HTTP response, and the
 * ground-truth expectations the engine is measured against.
 *
 * Responsibilities:
 *
 * - Carry the target website URL and the offline HTML fixture.
 * - Carry the expected CMS, theme, and plugin ground truth.
 * - Nothing else.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - No HTTP: the fixture HTML is embedded at construction time; the
 *   benchmark never performs network requests.
 * - Ground truth is explicit and typed, so accuracy metrics are always
 *   evaluated against a deterministic expectation.
 * - Single Responsibility Principle: it stores case data only and performs
 *   no detection, no parsing, and no scoring.
 * - Stateless, deterministic, and side-effect free.
 *
 * Future Compatibility:
 *
 * - Optional fields (headers, status code, response time) may be added to
 *   represent richer HTTP fixtures without changing the public contract.
 * - New platforms add benchmark cases without modifying this object.
 */
final readonly class BenchmarkCase
{
    /**
     * @param string               $name              The unique, stable case
     *                                                identifier.
     * @param string               $category          The case category, for
     *                                                example 'popular-theme',
     *                                                'default-theme', or
     *                                                'popular-plugin'.
     * @param string               $url               The target website URL.
     * @param string               $html              The offline HTML fixture
     *                                                standing in for the HTTP
     *                                                response body.
     * @param string|null          $expectedTechnology The expected CMS
     *                                                technology, or null when
     *                                                no CMS is expected
     *                                                (negative case).
     * @param string|null          $expectedTheme      The expected theme name,
     *                                                or null when no theme is
     *                                                expected.
     * @param list<string>         $expectedPlugins    The expected plugin
     *                                                slugs, empty when no
     *                                                plugin is expected.
     * @param array<string, string> $responses         The offline HTTP
     *                                                fixture responses keyed
     *                                                by absolute URL, seeded
     *                                                into the harness HTTP
     *                                                client for this case.
     */
    public function __construct(
        private string $name,
        private string $category,
        private string $url,
        private string $html,
        private ?string $expectedTechnology = null,
        private ?string $expectedTheme = null,
        private array $expectedPlugins = [],
        private array $responses = [],
    ) {
    }

    /**
     * Return the unique case identifier.
     *
     * @return string The stable case identifier.
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Return the case category.
     *
     * @return string The case category.
     */
    public function category(): string
    {
        return $this->category;
    }

    /**
     * Return the target website URL.
     *
     * @return string The target website URL.
     */
    public function url(): string
    {
        return $this->url;
    }

    /**
     * Return the offline HTML fixture.
     *
     * @return string The HTML fixture standing in for the response body.
     */
    public function html(): string
    {
        return $this->html;
    }

    /**
     * Return the expected CMS technology.
     *
     * @return string|null The expected CMS, or null when no CMS is expected.
     */
    public function expectedTechnology(): ?string
    {
        return $this->expectedTechnology;
    }

    /**
     * Return the expected theme name.
     *
     * @return string|null The expected theme, or null when no theme is
     *                     expected.
     */
    public function expectedTheme(): ?string
    {
        return $this->expectedTheme;
    }

    /**
     * Return the expected plugin slugs.
     *
     * @return list<string> The expected plugin slugs, empty when none are
     *                      expected.
     */
    public function expectedPlugins(): array
    {
        return $this->expectedPlugins;
    }

    /**
     * Return the offline HTTP fixture responses for this case.
     *
     * @return array<string, string> The response bodies keyed by absolute
     *                               request URL.
     */
    public function responses(): array
    {
        return $this->responses;
    }
}
