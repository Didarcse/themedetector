<?php

declare(strict_types=1);

namespace Tests\Unit\Logging;

use App\Core\Request;
use App\Logging\ContextRedactor;
use App\Logging\LoggerInterface;
use App\Logging\LogLevel;
use App\Logging\SecurityEventLogger;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Tests\Support\InMemoryLogger;

final class SecurityEventLoggerTest extends TestCase
{
    private ?string $errorLog = null;

    private string $previousErrorLog = '';

    protected function setUp(): void
    {
        $previousErrorLog = ini_get('error_log');
        $this->previousErrorLog = is_string($previousErrorLog) ? $previousErrorLog : '';

        $errorLog = tempnam(sys_get_temp_dir(), 'td-error-log-');

        if ($errorLog === false) {
            self::fail('Could not create a temporary error log.');
        }

        $this->errorLog = $errorLog;
        ini_set('error_log', $errorLog);
    }

    protected function tearDown(): void
    {
        ini_set('error_log', $this->previousErrorLog);

        if ($this->errorLog !== null) {
            @unlink($this->errorLog);
            $this->errorLog = null;
        }
    }

    public function test_events_use_the_approved_names_and_severities(): void
    {
        $memory = new InMemoryLogger();
        $logger = new SecurityEventLogger($memory, new ContextRedactor());

        $logger->csrfRejected();
        $logger->sessionFailed('session_start_failed');
        $logger->apiAuthRejected('missing_api_key', false);
        $logger->apiRequestRejected(415, 'unsupported_media_type');
        $logger->apiRateLimitDenied('anonymous', 10, 0, 60);
        $logger->apiWorkloadRejected(10);
        $logger->webRateLimitDenied(10, 60);
        $logger->ssrfBlocked('http://127.0.0.1/');
        $logger->httpRequestFailed('https://example.com/', 'transport_failure');
        $logger->detectionEngineDegraded('technology');
        $logger->notFound();
        $logger->appException(new RuntimeException('secret exception message'));

        $expected = [
            [SecurityEventLogger::CSRF_REJECTED, LogLevel::WARNING],
            [SecurityEventLogger::SESSION_FAILED, LogLevel::ERROR],
            [SecurityEventLogger::API_AUTH_REJECTED, LogLevel::WARNING],
            [SecurityEventLogger::API_REQUEST_REJECTED, LogLevel::WARNING],
            [SecurityEventLogger::API_RATE_LIMIT_DENIED, LogLevel::WARNING],
            [SecurityEventLogger::API_WORKLOAD_REJECTED, LogLevel::WARNING],
            [SecurityEventLogger::WEB_RATE_LIMIT_DENIED, LogLevel::WARNING],
            [SecurityEventLogger::HTTP_SSRF_BLOCKED, LogLevel::WARNING],
            [SecurityEventLogger::HTTP_REQUEST_FAILED, LogLevel::ERROR],
            [SecurityEventLogger::DETECTION_ENGINE_DEGRADED, LogLevel::WARNING],
            [SecurityEventLogger::HTTP_NOT_FOUND, LogLevel::INFO],
            [SecurityEventLogger::APP_EXCEPTION, LogLevel::ERROR],
        ];

        $records = $memory->records();

        self::assertCount(count($expected), $records);

        foreach ($expected as $index => [$event, $level]) {
            self::assertSame($event, $records[$index]['event']);
            self::assertSame($level, $records[$index]['level']);
        }
    }

    public function test_request_metadata_is_added_and_context_is_redacted(): void
    {
        $memory = new InMemoryLogger();
        $logger = new SecurityEventLogger(
            $memory,
            new ContextRedactor('test-hash-key'),
        );
        $request = new Request('POST', '/api/v1/detect', server: [
            'REMOTE_ADDR' => '198.51.100.7',
        ]);
        $logger->setRequest($request);

        $logger->httpRequestFailed(
            'https://example.com/path?token=secret#fragment',
            'transport_failure',
        );

        $record = $memory->recordsFor(SecurityEventLogger::HTTP_REQUEST_FAILED)[0];
        $context = $record['context'];

        self::assertSame($request->requestId(), $context['request_id']);
        self::assertSame('POST', $context['method']);
        self::assertSame('/api/v1/detect', $context['path']);
        self::assertSame('example.com', $context['target_host']);
        self::assertSame(hash('sha256', 'https://example.com'), $context['target_hash']);
        self::assertSame(
            'hmac-sha256:' . hash_hmac('sha256', '198.51.100.7', 'test-hash-key'),
            $context['client'],
        );
        self::assertArrayNotHasKey('target_url', $context);
        self::assertStringNotContainsString('secret', json_encode($context, JSON_THROW_ON_ERROR));
    }

    public function test_exception_messages_and_traces_are_never_logged(): void
    {
        $memory = new InMemoryLogger();
        $logger = new SecurityEventLogger($memory, new ContextRedactor());

        $logger->appException(new RuntimeException('super-secret-detail'));

        $record = $memory->recordsFor(SecurityEventLogger::APP_EXCEPTION)[0];
        $encoded = json_encode($record['context'], JSON_THROW_ON_ERROR);

        self::assertStringNotContainsString('super-secret-detail', $encoded);
        self::assertArrayNotHasKey('exception_message', $record['context']);
        self::assertArrayNotHasKey('trace', $record['context']);

        $exceptionFile = $record['context']['exception_file'];

        self::assertIsString($exceptionFile);
        self::assertSame(basename(__FILE__), $exceptionFile);
        self::assertStringNotContainsString('/', $exceptionFile);
        self::assertStringNotContainsString('\\', $exceptionFile);
    }

    public function test_unsupported_events_are_not_written(): void
    {
        $memory = new InMemoryLogger();
        $logger = new SecurityEventLogger($memory, new ContextRedactor());

        $logger->log('security.unknown', ['reason' => 'test']);

        self::assertSame([], $memory->records());
    }

    public function test_logger_failures_never_escape(): void
    {
        $failing = new class implements LoggerInterface {
            public function log(LogLevel $level, string $event, array $context = []): void
            {
                throw new RuntimeException('logger failed');
            }
        };
        $logger = new SecurityEventLogger($failing, new ContextRedactor());

        $logger->csrfRejected();

        $errorLog = $this->errorLog;
        self::assertIsString($errorLog);

        $contents = file_get_contents($errorLog);
        self::assertIsString($contents);
        self::assertStringContainsString('ThemeDetectorTool security logging failure.', $contents);
    }
}
