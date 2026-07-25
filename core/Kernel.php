<?php

declare(strict_types=1);

namespace Core;

/**
 * Handles the application lifecycle.
 */
final class Kernel
{
    public function __construct(
        private readonly Application $application,
    ) {}

    public function application(): Application
    {
        return $this->application;
    }

    public function handle(): Response
    {
        return new Response(
            content: 'Kernel Framework v1 Ready',
            status: 200,
        );
    }
}
