<?php

declare(strict_types=1);

namespace Tests\Unit\Core;

use App\Core\Application;
use App\Core\Container;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the Kernel Framework Application composition root.
 *
 * Verifies the complete public contract of Application: creation of the
 * owned container, access to the same container instance, framework
 * bootstrapping, and idempotent boot behaviour.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Fast, deterministic, and independent.
 * - No external dependencies beyond the application itself.
 * - Each test verifies exactly one behaviour.
 */
final class ApplicationTest extends TestCase
{
    public function test_creates_container_on_construction(): void
    {
        $application = new Application();

        self::assertInstanceOf(Container::class, $application->container());
    }

    public function test_container_returns_same_instance(): void
    {
        $application = new Application();

        self::assertSame($application->container(), $application->container());
    }

    public function test_boot_registers_container_service(): void
    {
        $application = new Application();

        $application->boot();

        $resolved = $application->container()->get(Container::class);

        self::assertSame($application->container(), $resolved);
    }

    public function test_boot_is_idempotent(): void
    {
        $application = new Application();

        $application->boot();
        $application->boot();
        $application->boot();

        $resolved = $application->container()->get(Container::class);

        self::assertSame($application->container(), $resolved);
    }

    public function test_container_can_resolve_itself_after_boot(): void
    {
        $application = new Application();

        $application->boot();

        $resolved = $application->container()->get(Container::class);

        self::assertSame($application->container(), $resolved);
    }

    public function test_new_application_creates_new_container(): void
    {
        $first = new Application();
        $second = new Application();

        self::assertNotSame($first->container(), $second->container());
    }
}
