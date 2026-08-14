<?php

declare(strict_types=1);

namespace App\Tests\Unit\Http;

use App\Modules\Http\UrlHostPolicy;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class UrlHostPolicyTest extends TestCase
{
    /**
     * @param (callable(string): list<string>)|null $resolver
     */
    private function policy(?callable $resolver = null): UrlHostPolicy
    {
        return new UrlHostPolicy(
            $resolver ?? static fn (string $host): array => match ($host) {
                'example.com' => ['93.184.216.34'],
                'example.org' => ['2606:4700:4700::1111'],
                'internal.example.com' => ['10.0.0.5'],
                'loopback.example.com' => ['127.0.0.1'],
                'mixed.example.com' => ['93.184.216.34', '10.0.0.5'],
                'noanswer.example.com' => [],
                default => [],
            },
        );
    }

    #[DataProvider('publicUrlProvider')]
    public function test_allows_public_urls(string $url): void
    {
        self::assertTrue($this->policy()->isAllowed($url));
    }

    #[DataProvider('unsafeUrlProvider')]
    public function test_rejects_unsafe_urls(string $url): void
    {
        self::assertFalse($this->policy()->isAllowed($url));
    }

    public function test_rejects_unsupported_schemes(): void
    {
        $policy = $this->policy();

        self::assertFalse($policy->isAllowed('ftp://example.com/'));
        self::assertFalse($policy->isAllowed('file:///etc/passwd'));
        self::assertFalse($policy->isAllowed('gopher://example.com/'));
        self::assertFalse($policy->isAllowed('javascript://example.com/'));
        self::assertFalse($policy->isAllowed('ssh://example.com/'));
        self::assertFalse($policy->isAllowed('data:text/html,hello'));
    }

    public function test_rejects_malformed_urls(): void
    {
        $policy = $this->policy();

        self::assertFalse($policy->isAllowed('http://'));
        self::assertFalse($policy->isAllowed('http:///'));
        self::assertFalse($policy->isAllowed('https://exa mple.com/'));
        self::assertFalse($policy->isAllowed(''));
        self::assertFalse($policy->isAllowed('not a url'));
    }

    public function test_rejects_numeric_only_hostnames(): void
    {
        self::assertFalse($this->policy()->isAllowed('http://123456/'));
        self::assertFalse($this->policy()->isAllowed('http://1.2.3.4.5/'));
    }

    public function test_rejects_hostnames_resolving_to_private_ips(): void
    {
        $policy = $this->policy();

        self::assertFalse($policy->isAllowed('http://internal.example.com/'));
        self::assertFalse($policy->isAllowed('http://loopback.example.com/'));
    }

    public function test_rejects_hostnames_resolving_to_any_private_ip(): void
    {
        self::assertFalse($this->policy()->isAllowed('http://mixed.example.com/'));
    }

    public function test_rejects_hostnames_without_dns_answers(): void
    {
        self::assertFalse($this->policy()->isAllowed('http://noanswer.example.com/'));
        self::assertFalse($this->policy()->isAllowed('http://no-such-host.invalid/'));
    }

    public function test_hostname_matching_is_case_insensitive(): void
    {
        self::assertTrue($this->policy()->isAllowed('HTTPS://EXAMPLE.COM/'));
        self::assertTrue($this->policy()->isAllowed('https://Example.com/'));
    }

    public function test_resolver_result_is_cached_per_host(): void
    {
        $calls = 0;

        $policy = new UrlHostPolicy(static function (string $host) use (&$calls): array {
            $calls++;

            return ['93.184.216.34'];
        });

        self::assertTrue($policy->isAllowed('https://example.com/a'));
        self::assertTrue($policy->isAllowed('https://example.com/b'));
        self::assertTrue($policy->isAllowed('https://example.com/c'));

        self::assertSame(1, $calls);
    }

    public function test_rejects_scope_zones_and_control_characters(): void
    {
        $policy = $this->policy();

        self::assertFalse($policy->isAllowed('http://[fe80::1%25eth0]/'));
        self::assertFalse($policy->isAllowed("https://exa\x00mple.com/"));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function publicUrlProvider(): iterable
    {
        yield 'google dns v4' => ['http://8.8.8.8/'];
        yield 'cloudflare dns v4' => ['http://1.1.1.1/'];
        yield 'public 172.32/12 boundary' => ['http://172.32.0.1/'];
        yield 'public 198.17/15 boundary' => ['http://198.17.0.1/'];
        yield 'top of 223/8' => ['http://223.255.255.254/'];
        yield 'google dns v6' => ['http://[2001:4860:4860::8888]/'];
        yield 'cloudflare dns v6' => ['http://[2606:4700:4700::1111]/'];
        yield 'public mapped v6' => ['http://[::ffff:8.8.8.8]/'];
        yield 'public hostname' => ['https://example.com/'];
        yield 'public v6 hostname' => ['https://example.org/'];
        yield 'public hostname with port' => ['https://example.com:8443/x'];
        yield 'https public hostname' => ['https://example.org/']; // v6-only host
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function unsafeUrlProvider(): iterable
    {
        yield 'loopback' => ['http://127.0.0.1/'];
        yield 'loopback range' => ['http://127.1.2.3/'];
        yield 'loopback short dotted' => ['http://127.1/'];
        yield 'loopback integer' => ['http://2130706433/'];
        yield 'loopback hex' => ['http://0x7f000001/'];
        yield 'loopback hex parts' => ['http://0x7f.0x0.0x0.0x1/'];
        yield 'loopback octal parts' => ['http://0177.0.0.1/'];
        yield 'any address zero' => ['http://0/'];
        yield 'any address 0.0.0.0' => ['http://0.0.0.0/'];
        yield 'private 10/8' => ['http://10.0.0.1/'];
        yield 'private 10/8 top' => ['http://10.255.255.255/'];
        yield 'private 172.16/12 low' => ['http://172.16.0.1/'];
        yield 'private 172.16/12 top' => ['http://172.31.255.255/'];
        yield 'private 192.168/16' => ['http://192.168.0.1/'];
        yield 'private 192.168/16 top' => ['http://192.168.255.255/'];
        yield 'link local 169.254/16' => ['http://169.254.169.254/'];
        yield 'cg nat 100.64/10' => ['http://100.64.0.1/'];
        yield 'cg nat 100.64/10 top' => ['http://100.127.255.255/'];
        yield '192.0.0.0/24' => ['http://192.0.0.1/'];
        yield 'documentation 192.0.2.0/24' => ['http://192.0.2.1/'];
        yield 'benchmark 198.18/15' => ['http://198.18.0.1/'];
        yield 'documentation 198.51.100/24' => ['http://198.51.100.1/'];
        yield 'documentation 203.0.113/24' => ['http://203.0.113.1/'];
        yield 'multicast 224/4' => ['http://224.0.0.1/'];
        yield 'reserved 240/4' => ['http://240.0.0.1/'];
        yield 'broadcast' => ['http://255.255.255.255/'];
        yield 'unspecified v6' => ['http://[::]/'];
        yield 'loopback v6' => ['http://[::1]/'];
        yield 'unique local fc00/7' => ['http://[fc00::1]/'];
        yield 'unique local fd00/7' => ['http://[fd00::1]/'];
        yield 'link local fe80/10' => ['http://[fe80::1]/'];
        yield 'site local fec0/10' => ['http://[fec0::1]/'];
        yield 'documentation 2001:db8/32' => ['http://[2001:db8::1]/'];
        yield 'multicast ff00/8' => ['http://[ff02::1]/'];
        yield 'mapped loopback v6' => ['http://[::ffff:127.0.0.1]/'];
        yield 'mapped private v6' => ['http://[::ffff:10.0.0.1]/'];
        yield 'mapped private v6 192.168' => ['http://[::ffff:192.168.1.1]/'];
        yield 'compatible loopback v6' => ['http://[::7f00:1]/'];
        yield 'private hostname' => ['http://internal.example.com/'];
        yield 'loopback hostname' => ['http://loopback.example.com/'];
        yield 'localhost hostname' => ['http://localhost/'];
        yield 'localhost tld' => ['http://anything.localhost/'];
        yield 'no dns answer' => ['http://noanswer.example.com/'];
    }
}
