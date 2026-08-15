<?php

declare(strict_types=1);

namespace Tests\Integration\Services;

use App\Core\Container;
use App\Modules\TechnologyDetection\Analytics\AnalyticsDetector;
use App\Modules\TechnologyDetection\Cdn\CdnDetector;
use App\Modules\TechnologyDetection\JavaScriptLibrary\JavaScriptLibraryDetector;
use App\Modules\TechnologyDetection\TechnologyDetector;
use App\Modules\TechnologyDetection\TechnologyDetectionManager;
use App\Modules\TechnologyDetection\TechnologyRegistry;
use App\Modules\TechnologyDetection\TechnologyRegistryFactory;
use PHPUnit\Framework\TestCase;

/**
 * Integration tests for the Technology Detection Engine DI wiring.
 *
 * Mirrors the bindings registered by the production composition root so
 * the container resolves exactly one deterministic registry containing
 * every supported category detector in registration order.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable wiring only.
 * - Deterministic: detectors are asserted in registration order.
 */
final class TechnologyDetectionWiringTest extends TestCase
{
    public function test_wiring_resolves_a_single_registry_with_all_detectors(): void
    {
        $container = $this->container();

        $registry = $container->get(TechnologyRegistry::class);

        $detectors = $registry->all();
        self::assertCount(3, $detectors);
        self::assertInstanceOf(JavaScriptLibraryDetector::class, $detectors[0]);
        self::assertInstanceOf(CdnDetector::class, $detectors[1]);
        self::assertInstanceOf(AnalyticsDetector::class, $detectors[2]);
    }

    public function test_wiring_resolves_the_manager_and_facade(): void
    {
        $container = $this->container();

        self::assertInstanceOf(
            TechnologyDetectionManager::class,
            $container->get(TechnologyDetectionManager::class),
        );
        self::assertInstanceOf(
            TechnologyDetector::class,
            $container->get(TechnologyDetector::class),
        );
    }

    public function test_wiring_resolves_singleton_instances(): void
    {
        $container = $this->container();

        self::assertSame(
            $container->get(TechnologyRegistry::class),
            $container->get(TechnologyRegistry::class),
        );
        self::assertSame(
            $container->get(TechnologyDetector::class),
            $container->get(TechnologyDetector::class),
        );
    }

    private function container(): Container
    {
        $container = new Container();

        $container->set(
            TechnologyRegistry::class,
            static fn (Container $container): TechnologyRegistry =>
                (new TechnologyRegistryFactory())->create($container),
        );

        $container->set(
            TechnologyDetectionManager::class,
            static fn (Container $container): TechnologyDetectionManager => new TechnologyDetectionManager(
                $container->get(TechnologyRegistry::class),
            ),
        );

        $container->set(
            TechnologyDetector::class,
            static fn (Container $container): TechnologyDetector => new TechnologyDetector(
                $container->get(TechnologyDetectionManager::class),
            ),
        );

        return $container;
    }
}
