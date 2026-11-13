<?php

declare(strict_types=1);

namespace Tests\Unit\Core;

use App\Core\Request;
use PHPUnit\Framework\TestCase;

final class RequestCorrelationTest extends TestCase
{
    public function test_request_id_is_stable_lowercase_hex(): void
    {
        $request = new Request('GET', '/');

        self::assertMatchesRegularExpression('/^[0-9a-f]{32}$/', $request->requestId());
        self::assertSame($request->requestId(), $request->requestId());
    }

    public function test_request_ids_are_unique_per_request(): void
    {
        self::assertNotSame(
            (new Request('GET', '/'))->requestId(),
            (new Request('GET', '/'))->requestId(),
        );
    }

    public function test_client_supplied_request_id_is_ignored(): void
    {
        $request = new Request('GET', '/', server: [
            'HTTP_X_REQUEST_ID' => 'client-controlled-id',
        ]);

        self::assertNotSame('client-controlled-id', $request->requestId());
        self::assertMatchesRegularExpression('/^[0-9a-f]{32}$/', $request->requestId());
    }
}
