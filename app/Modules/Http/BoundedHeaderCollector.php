<?php

declare(strict_types=1);

namespace App\Modules\Http;

use InvalidArgumentException;

/**
 * Streaming response-header collector with a hard size ceiling.
 *
 * BoundedHeaderCollector is the write-target for the
 * CURLOPT_HEADERFUNCTION callback of cURL transfers that must never
 * buffer an unbounded response header region. Every received header line
 * is appended to the internal buffer while the running total stays below
 * the configured limit. The moment a line would push the total past the
 * limit, the callback returns a negative value so libcurl aborts the
 * transfer with CURLE_WRITE_ERROR instead of buffering the rest of the
 * headers.
 *
 * The collector deliberately never truncates a header region and
 * continues: an over-limit transfer is failed closed and flagged via
 * exceeded(), and the caller is expected to surface the failure through
 * the existing transport error path. The internal buffer therefore never
 * holds more than the configured limit (plus at most one rejected line
 * that is discarded).
 *
 * Responsibilities:
 *
 * - Track the total number of header bytes received during one transfer.
 * - Append complete header lines to the collected header region while the
 *   limit allows.
 * - Abort the transfer (negative return) and flag exceeded() as soon as
 *   the limit would be crossed.
 * - Expose the safely bounded header region and the exceeded state to the
 *   caller.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is the bounded write-target of a
 *   single transfer's header callback only. It performs no HTTP, no
 *   parsing, and no business logic.
 * - Fail closed: an over-limit header region never reaches the caller, and
 *   no partial content is silently accepted.
 * - Deterministic and stateless apart from the collected transfer state.
 * - Shared by both the primary CurlHttpClient adapter and the legacy
 *   HttpClient fan-out so every outbound path enforces the same ceiling.
 */
final class BoundedHeaderCollector
{
    /**
     * Default maximum response-header size in bytes (64 KiB).
     *
     * Real-world response header regions stay well below this: servers
     * routinely cap individual header lines at a few KiB and the total
     * region at roughly 8-16 KiB. 64 KiB bounds per-request memory while
     * comfortably admitting every legitimate page and redirect hop. It is
     * not a content-quality gate; it is a resource-exhaustion guard.
     */
    public const DEFAULT_MAX_BYTES = 64 * 1024;

    private string $headers = '';

    private int $received = 0;

    private bool $exceeded = false;

    /**
     * Create a bounded header collector for one transfer.
     *
     * @param int $maxBytes The maximum number of header bytes to accept.
     *
     * @throws InvalidArgumentException When the limit is not a positive
     *                                  integer.
     */
    public function __construct(private readonly int $maxBytes)
    {
        if ($maxBytes <= 0) {
            throw new InvalidArgumentException(
                'The maximum response-header size must be a positive integer.'
            );
        }
    }

    /**
     * Accept one header line delivered by the transport.
     *
     * Appends the line and returns its length when the total stays within
     * the limit. Returns -1 without appending when the line would exceed
     * the limit, which makes libcurl abort the transfer.
     *
     * @param string $line The raw header line received so far.
     *
     * @return int The number of bytes accepted, or -1 when the limit is
     *             exceeded.
     */
    public function write(string $line): int
    {
        if ($this->exceeded) {
            return -1;
        }

        $length = strlen($line);

        if ($length > $this->maxBytes - $this->received) {
            $this->exceeded = true;

            return -1;
        }

        $this->headers .= $line;
        $this->received += $length;

        return $length;
    }

    /**
     * Return the collected header bytes, bounded by the configured limit.
     */
    public function headers(): string
    {
        return $this->headers;
    }

    /**
     * Return whether the transfer exceeded the configured limit.
     */
    public function exceeded(): bool
    {
        return $this->exceeded;
    }

    /**
     * Return the configured maximum number of header bytes.
     */
    public function maxBytes(): int
    {
        return $this->maxBytes;
    }
}
