<?php

declare(strict_types=1);

namespace Tests\Unit\Core;

use App\Core\Container;
use App\Core\Exceptions\ServiceNotFoundException;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the Kernel Framework dependency injection container.
 *
 * Verifies the complete public contract of Container: registration of
 * object instances and factory callables, lazy resolution, singleton
 * caching, identifier probing, and exception behaviour.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Fast, deterministic, and independent.
 * - No external dependencies beyond the container itself.
 * - Each test verifies exactly one behaviour.
 */
final class ContainerTest extends TestCase
{
    public function test_registers_object_instance(): void
    {
        $container = new Container();
        $service = new DummyService();

        $container->set('service', $service);

        self::assertSame($service, $container->get('service'));
    }

    public function test_registers_factory(): void
    {
        $container = new Container();

        $container->set(
            'service',
            fn (Container $container): object => new DummyService(),
        );

        self::assertInstanceOf(DummyService::class, $container->get('service'));
    }

    public function test_factory_is_lazy(): void
    {
        $container = new Container();
        $invocations = 0;

        $container->set('service', function (Container $container) use (&$invocations): object {
            $invocations++;

            return new DummyService();
        });

        self::assertSame(0, $invocations);

        $container->get('service');

        self::assertSame(1, $invocations);
    }

    public function test_factory_executes_only_once(): void
    {
        $container = new Container();
        $invocations = 0;

        $container->set('service', function (Container $container) use (&$invocations): object {
            $invocations++;

            return new DummyService();
        });

        $container->get('service');
        $container->get('service');
        $container->get('service');

        self::assertSame(1, $invocations);
    }

    public function test_returns_same_singleton_instance(): void
    {
        $container = new Container();

        $container->set(
            'service',
            fn (Container $container): object => new DummyService(),
        );

        $first = $container->get('service');
        $second = $container->get('service');

        self::assertSame($first, $second);
    }

    public function test_has_returns_true_for_registered_service(): void
    {
        $container = new Container();

        $container->set('service', new DummyService());

        self::assertTrue($container->has('service'));
    }

    public function test_has_returns_false_for_unknown_service(): void
    {
        $container = new Container();

        self::assertFalse($container->has('unknown.service'));
    }

    public function test_get_throws_service_not_found_exception(): void
    {
        $container = new Container();

        $this->expectException(ServiceNotFoundException::class);
        $this->expectExceptionMessage('Service "unknown.service" is not registered.');

        $container->get('unknown.service');
    }

    public function test_factory_receives_container(): void
    {
        $container = new Container();
        $captured = null;

        $container->set('service', function (Container $passed) use (&$captured): object {
            $captured = $passed;

            return new DummyService();
        });

        $container->get('service');

        self::assertSame($container, $captured);
    }

    public function test_object_registration_is_returned_directly(): void
    {
        $container = new Container();
        $service = new DummyService();

        $container->set('service', $service);

        $resolved = $container->get('service');

        self::assertSame($service, $resolved);
        self::assertSame($service, $container->get('service'));
    }

    public function test_reregistering_service_replaces_previous_instance(): void
    {
        $container = new Container();
        $first = new DummyService();
        $second = new AnotherDummyService();

        $container->set('service', $first);
        $container->set('service', $second);

        $resolved = $container->get('service');

        self::assertSame($second, $resolved);
        self::assertInstanceOf(AnotherDummyService::class, $resolved);
    }

    public function test_reregistering_factory_discards_cached_instance(): void
    {
        $container = new Container();
        $first = new DummyService();

        $container->set('service', fn (Container $container): object => $first);

        self::assertSame($first, $container->get('service'));

        $container->set(
            'service',
            fn (Container $container): object => new AnotherDummyService(),
        );

        $resolved = $container->get('service');

        self::assertNotSame($first, $resolved);
        self::assertInstanceOf(AnotherDummyService::class, $resolved);
    }

    public function test_multiple_services_can_be_registered(): void
    {
        $container = new Container();

        $container->set('first', new DummyService());
        $container->set(
            'second',
            fn (Container $container): object => new AnotherDummyService(),
        );
        $container->set(
            'third',
            fn (Container $container): object => new DummyService(),
        );

        self::assertInstanceOf(DummyService::class, $container->get('first'));
        self::assertInstanceOf(AnotherDummyService::class, $container->get('second'));
        self::assertInstanceOf(DummyService::class, $container->get('third'));
    }
}

/**
 * Minimal service fixture used to exercise the container contract.
 */
final class DummyService
{
}

/**
 * Secondary service fixture used to verify replacement behaviour.
 */
final class AnotherDummyService
{
}
