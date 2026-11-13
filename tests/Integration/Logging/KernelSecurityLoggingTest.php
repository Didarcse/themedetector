<?php

declare(strict_types=1);

namespace Tests\Integration\Logging;

use App\Core\Container;
use App\Core\Dispatcher;
use App\Core\ExceptionHandler;
use App\Core\Kernel;
use App\Core\Request;
use App\Core\Response;
use App\Core\Router;
use App\Logging\ContextRedactor;
use App\Logging\SecurityEventLogger;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Tests\Support\InMemoryLogger;

final class KernelSecurityLoggingTest extends TestCase
{
    public function test_request_id_header_matches_the_logged_404_event(): void
    {
        $memory = new InMemoryLogger();
        $kernel = $this->kernel($memory);
        $request = new Request('GET', '/missing');

        $response = $kernel->handle($request);

        self::assertSame(404, $response->status());
        self::assertSame($request->requestId(), $response->headers()['X-Request-ID']);

        $record = $memory->recordsFor(SecurityEventLogger::HTTP_NOT_FOUND)[0];
        $context = $record['context'];

        self::assertSame($request->requestId(), $context['request_id']);
        self::assertSame('GET', $context['method']);
        self::assertArrayNotHasKey('path', $context);
        self::assertSame(404, $context['status']);
    }

    public function test_unhandled_exceptions_are_generic_and_logged_without_messages(): void
    {
        $memory = new InMemoryLogger();
        $kernel = $this->kernel($memory);
        $request = new Request('GET', '/boom');

        $response = $kernel->handle($request);

        self::assertSame(500, $response->status());
        self::assertSame('Internal Server Error', $response->content());
        self::assertSame($request->requestId(), $response->headers()['X-Request-ID']);

        $records = $memory->recordsFor(SecurityEventLogger::APP_EXCEPTION);

        self::assertCount(1, $records);

        $context = $records[0]['context'];

        self::assertSame($request->requestId(), $context['request_id']);
        self::assertSame(500, $context['status']);
        self::assertSame(RuntimeException::class, $context['exception_class']);
        self::assertSame(basename(__FILE__), $context['exception_file']);
        self::assertArrayHasKey('exception_line', $context);
        self::assertStringNotContainsString(
            'super-secret-detail',
            json_encode($records[0], JSON_THROW_ON_ERROR),
        );
        self::assertStringNotContainsString(
            'app/Core',
            json_encode($records[0], JSON_THROW_ON_ERROR),
        );
    }

    public function test_request_context_is_cleared_after_each_response(): void
    {
        $memory = new InMemoryLogger();
        $eventLogger = new SecurityEventLogger($memory, new ContextRedactor());
        $kernel = $this->kernel($memory, $eventLogger);
        $request = new Request('GET', '/missing');

        $kernel->handle($request);

        $eventLogger->notFound();

        $records = $memory->recordsFor(SecurityEventLogger::HTTP_NOT_FOUND);

        self::assertCount(2, $records);
        self::assertSame($request->requestId(), $records[0]['context']['request_id']);
        self::assertArrayNotHasKey('request_id', $records[1]['context']);
        self::assertArrayNotHasKey('method', $records[1]['context']);
        self::assertArrayNotHasKey('path', $records[1]['context']);
    }

    public function test_each_request_gets_its_own_context(): void
    {
        $memory = new InMemoryLogger();
        $kernel = $this->kernel($memory);
        $first = new Request('GET', '/missing');
        $second = new Request('GET', '/missing');

        $kernel->handle($first);
        $kernel->handle($second);

        $records = $memory->recordsFor(SecurityEventLogger::HTTP_NOT_FOUND);

        self::assertCount(2, $records);
        self::assertSame($first->requestId(), $records[0]['context']['request_id']);
        self::assertSame($second->requestId(), $records[1]['context']['request_id']);
        self::assertNotSame($first->requestId(), $second->requestId());
    }

    private function kernel(
        InMemoryLogger $memory,
        ?SecurityEventLogger $eventLogger = null,
    ): Kernel {
        $router = new Router();
        $router->get('/boom', static function (): Response {
            throw new RuntimeException('super-secret-detail');
        });

        return new Kernel(
            $router,
            new Dispatcher(new Container()),
            new ExceptionHandler(),
            $eventLogger ?? new SecurityEventLogger($memory, new ContextRedactor()),
        );
    }
}
