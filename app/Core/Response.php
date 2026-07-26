<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Immutable HTTP response representation.
 */
final class Response
{
    private readonly string $content;
    private readonly int $status;
    /** @var array<string, string> */
    private readonly array $headers;

    /** @param array<string, string> $headers */
    public function __construct(
        string $content = '',
        int $status = 200,
        array $headers = [],
    ) {
        $this->content = $content;
        $this->status = $status;
        $this->headers = array_merge(
            ['Content-Type' => 'text/html; charset=UTF-8'],
            $headers,
        );
    }

    /**
     * @param array<mixed>|object $data
     */
    public static function json(array|object $data, int $status = 200): self
    {
        $encoded = json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);

        return new self(
            $encoded,
            $status,
            ['Content-Type' => 'application/json; charset=UTF-8'],
        );
    }

    public function content(): string
    {
        return $this->content;
    }

    public function status(): int
    {
        return $this->status;
    }

    /** @return array<string, string> */
    public function headers(): array
    {
        return $this->headers;
    }

    public function send(): void
    {
        http_response_code($this->status);

        foreach ($this->headers as $name => $value) {
            header("{$name}: {$value}");
        }

        echo $this->content;
    }
}
