<?php

declare(strict_types=1);

namespace App\Tests\Unit\Http;

use App\Modules\Http\HttpClient;
use App\Modules\Http\HttpException;
use App\Modules\Http\UrlHostPolicy;
use PHPUnit\Framework\TestCase;

final class LegacyHttpClientSecurityTest extends TestCase
{
    private function policy(): UrlHostPolicy
    {
        return new UrlHostPolicy(
            static fn (string $host): array => match ($host) {
                'example.com' => ['93.184.216.34'],
                'internal.example.com' => ['10.0.0.5'],
                default => [],
            },
        );
    }

    public function test_default_policy_rejects_loopback_url(): void
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Invalid URL.');

        (new HttpClient())->get('http://127.0.0.1/');
    }

    public function test_injected_policy_rejects_loopback_url(): void
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Invalid URL.');

        (new HttpClient($this->policy()))->get('http://127.0.0.1/');
    }

    public function test_rejects_encoded_loopback_url(): void
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Invalid URL.');

        (new HttpClient($this->policy()))->get('http://2130706433/');
    }

    public function test_rejects_private_ip_url(): void
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Invalid URL.');

        (new HttpClient($this->policy()))->get('http://10.0.0.1/');
    }

    public function test_rejects_private_hostname_url(): void
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Invalid URL.');

        (new HttpClient($this->policy()))->get('http://internal.example.com/');
    }

    public function test_rejects_empty_url(): void
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('URL must not be empty.');

        (new HttpClient($this->policy()))->get('   ');
    }

    public function test_rejects_malformed_url(): void
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Invalid URL.');

        (new HttpClient($this->policy()))->get('not a url');
    }

    public function test_rejects_unsafe_scheme(): void
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Invalid URL.');

        (new HttpClient($this->policy()))->get('ftp://example.com/');
    }
}
