<?php

declare(strict_types=1);

namespace App\Modules\Http;

/**
 * Provides rotating desktop browser User-Agent strings.
 *
 * Used by CurlFactory and HttpClient to reduce request blocking
 * and improve website compatibility.
 */
final class UserAgent
{
    /** @var list<string> */
    private const AGENTS = [
        // Chrome — Windows
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',
        // Chrome — macOS
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',
        // Firefox — Windows
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:130.0) Gecko/20100101 Firefox/130.0',
        // Firefox — Linux
        'Mozilla/5.0 (X11; Linux x86_64; rv:130.0) Gecko/20100101 Firefox/130.0',
        // Edge — Windows
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0',
        // Safari — macOS
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Safari/605.1.15',
    ];

    private function __construct()
    {
    }

    /**
     * Return a random User-Agent string.
     *
     * @return non-empty-string
     */
    public static function random(): string
    {
        return self::AGENTS[array_rand(self::AGENTS)];
    }

    /**
     * Return all available User-Agent strings.
     *
     * @return list<string>
     */
    public static function all(): array
    {
        return self::AGENTS;
    }
}
