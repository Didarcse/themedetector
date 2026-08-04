<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Container;

/**
 * Composition root for the Kernel Framework.
 *
 * Application bootstraps the framework, registers core services, and
 * exposes the dependency injection container. It coordinates framework
 * startup only and performs no business logic.
 *
 * Responsibilities:
 *
 * - Bootstrap the framework.
 * - Register framework-level services.
 * - Expose the dependency injection container.
 *
 * Design philosophy:
 *
 * - Composition Root: all framework wiring happens here.
 * - Single Responsibility Principle: framework bootstrap only.
 * - Dependency Injection and Inversion of Control: services are wired
 *   through the container rather than constructed by consumers.
 * - The application is stateless except for the owned container.
 * - Deterministic: startup produces the same registry on every run.
 */
final class Application
{
    /**
     * The application's dependency injection container.
     *
     * All framework-level services are registered with this container
     * during boot().
     *
     * @var Container
     */
    private Container $container;

    /**
     * Create a new application and its dependency injection container.
     */
    public function __construct()
    {
        $this->container = new Container();
    }

    /**
     * Return the application's dependency injection container.
     */
    public function container(): Container
    {
        return $this->container;
    }

    /**
     * Bootstrap the framework.
     *
     * Registers every framework-level service with the container. The
     * method is idempotent: calling it multiple times does not change the
     * application state.
     *
     * Current registrations:
     *
     * - Container::class bound to the current container instance.
     *
     * @return void
     */
    public function boot(): void
    {
        if (!$this->container->has(Container::class)) {
            $this->container->set(Container::class, $this->container);
        }
    }
}
