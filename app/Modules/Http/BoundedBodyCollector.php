<?php

declare(strict_types=1);

namespace App\Modules\Http;

use InvalidArgumentException;

/**
 * Streaming response-body collector with a hard size ceiling.
 *
 * BoundedBodyCollector is the write-target for cURL transfers that must
 * never buffer an unbounded response body. It is designed to be used as a
 * CURLOPT_WRITEFUNCTION callback: every received chunk is appended to the
 * internal buffer while a running total stays below the configured limit.
 * The moment a chunk would push the total past the limit, the callback
 * returns a negative value so libcurl aborts the transfer with
 * CURLE_WRITE_ERROR instead of buffering the rest of the body.
 *
 * The collector deliberately never truncates a response and continues: an
 * over-limit transfer is failed closed and flagged via exceeded(), and the
 * caller is expected to surface the failure through the existing transport
 * error path. The internal buffer therefore never holds more than the
 * configured limit (plus at most one rejected chunk that is discarded).
 *
 * Responsibilities:
 *
 * - Track the total number of body bytes received during one transfer.
 * - Append received chunks to the collected body while the limit allows.
 * - Abort the transfer (negative return) and flag exceeded() as soon as
 *   the limit would be crossed.
 * - Expose the safely bounded body and the exceeded state to the caller.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is the bounded write-target of a
 *   single transfer only. It performs no HTTP, no parsing, and no business
 *   logic.
 * - Fail closed: an over-limit response never reaches the caller, and no
 *   partial content is silently accepted.
 * - Deterministic and stateless apart from the collected transfer state.
 * - Shared by both the primary CurlHttpClient adapter and the legacy
 *   HttpClient fan-out so every outbound path enforces the same ceiling.
 */
final class BoundedBodyCollector
{
    /**
     * Default maximum response-body size in bytes (5 MiB).
     *
     * The limit safely covers every real consumer: ordinary HTML pages
     * used for detection (typically a few hundred KB), stylesheets fetched
     * for theme extraction (usually under 100 KB), and small JSON/probe
     * responses. 5 MiB bounds per-request memory while comfortably
     * admitting legitimate public pages, and stays well inside a standard
     * 128 MB PHP memory limit even with several in-flight requests. It is
     * not a content-quality gate; it is a resource-exhaustion guard.
     */
    public const DEFAULT_MAX_BYTES = 5 * 1024 * 1024;

    private string $body = '';

    private int $received = 0;

    private bool $exceeded = false;

    /**
     * Create a bounded body collector for one transfer.
     *
     * @param int $maxBytes The maximum number of body bytes to accept.
     *
     * @throws InvalidArgumentException When the limit is not a positive
     *                                  integer.
     */
    public function __construct(private readonly int $maxBytes)
    {
        if ($maxBytes <= 0) {
            throw new InvalidArgumentException(
                'The maximum response-body size must be a positive integer.'
            );
        }
    }

    /**
     * Accept one body chunk delivered by the transport.
     *
     * Appends the chunk and returns its length when the total stays within
     * the limit. Returns -1 without appending when the chunk would exceed
     * the limit, which makes libcurl abort the transfer.
     *
     * @param string $chunk The body bytes received so far.
     *
     * @return int The number of bytes accepted, or -1 when the limit is
     *             exceeded.
     */
    public function write(string $chunk): int
    {
        if ($this->exceeded) {
            return -1;
        }

        $length = strlen($chunk);

        if ($length > $this->maxBytes - $this->received) {
            $this->exceeded = true;

            return -1;
        }

        $this->body .= $chunk;
        $this->received += $length;

        return $length;
    }

    /**
     * Return the collected body, bounded by the configured limit.
     */
    public function body(): string
    {
        return $this->body;
    }

    /**
     * Return whether the transfer exceeded the configured limit.
     */
    public function exceeded(): bool
    {
        return $this->exceeded;
    }

    /**
     * Return the configured maximum number of body bytes.
     */
    public function maxBytes(): int
    {
        return $this->maxBytes;
    }
}
