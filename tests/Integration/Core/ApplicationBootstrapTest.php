<?php

declare(strict_types=1);

namespace Tests\Integration\Core;

use App\Core\Application;
use App\Core\Container;
use App\Modules\Detection\DetectionContextFactory;
use App\Modules\Detection\DetectionManager;
use App\Modules\Detection\DetectorRegistry;
use App\Modules\Detection\WebsiteDetector;
use App\Modules\Http\HttpClientInterface;
use PHPUnit\Framework\TestCase;

/**
 * Integration tests for the Kernel Framework bootstrap process.
 *
 * Verifies that Application correctly coordinates service providers and
 * exposes the expected services through the dependency injection
 * container after boot().
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Integration: verifies collaboration between Application and its
 *   service providers.
 * - Fast, deterministic, and independent.
 * - Each test verifies exactly one behaviour.
 */
final class ApplicationBootstrapTest extends TestCase
{
    public function test_boot_registers_container(): void
    {
        $application = new Application();

        $application->boot();

        $resolved = $application->container()->get(Container::class);

        self::assertSame($application->container(), $resolved);
    }

    public function test_boot_registers_http_client(): void
    {
        $application = new Application();

        $application->boot();

        $resolved = $application->container()->get(HttpClientInterface::class);

        self::assertInstanceOf(HttpClientInterface::class, $resolved);
    }

    public function test_boot_registers_detection_manager(): void
    {
        $application = new Application();

        $application->boot();

        $resolved = $application->container()->get(DetectionManager::class);

        self::assertInstanceOf(DetectionManager::class, $resolved);
    }

    public function test_boot_registers_detector_registry(): void
    {
        $application = new Application();

        $application->boot();

        $resolved = $application->container()->get(DetectorRegistry::class);

        self::assertInstanceOf(DetectorRegistry::class, $resolved);
    }

    public function test_boot_is_idempotent(): void
    {
        $application = new Application();

        $application->boot();
        $application->boot();
        $application->boot();

        $container = $application->container();

        self::assertSame(
            $container->get(Container::class),
            $container->get(Container::class),
        );
        self::assertSame(
            $container->get(HttpClientInterface::class),
            $container->get(HttpClientInterface::class),
        );
        self::assertSame(
            $container->get(DetectionManager::class),
            $container->get(DetectionManager::class),
        );
    }

    public function test_application_container_is_singleton(): void
    {
        $application = new Application();

        $application->boot();

        $container = $application->container();

        self::assertSame($container->get(Container::class), $container->get(Container::class));
    }

    public function test_http_client_is_singleton(): void
    {
        $application = new Application();

        $application->boot();

        $container = $application->container();

        self::assertSame(
            $container->get(HttpClientInterface::class),
            $container->get(HttpClientInterface::class),
        );
    }

    public function test_detection_manager_is_singleton(): void
    {
        $application = new Application();

        $application->boot();

        $container = $application->container();

        self::assertSame(
            $container->get(DetectionManager::class),
            $container->get(DetectionManager::class),
        );
    }

    public function test_boot_registers_detection_context_factory(): void
    {
        $application = new Application();

        $application->boot();

        $resolved = $application->container()->get(DetectionContextFactory::class);

        self::assertInstanceOf(DetectionContextFactory::class, $resolved);
    }

    public function test_boot_registers_website_detector(): void
    {
        $application = new Application();

        $application->boot();

        $resolved = $application->container()->get(WebsiteDetector::class);

        self::assertInstanceOf(WebsiteDetector::class, $resolved);
    }

    public function test_detection_context_factory_is_singleton(): void
    {
        $application = new Application();

        $application->boot();

        $container = $application->container();

        self::assertSame(
            $container->get(DetectionContextFactory::class),
            $container->get(DetectionContextFactory::class),
        );
    }

    public function test_website_detector_is_singleton(): void
    {
        $application = new Application();

        $application->boot();

        $container = $application->container();

        self::assertSame(
            $container->get(WebsiteDetector::class),
            $container->get(WebsiteDetector::class),
        );
    }
}
