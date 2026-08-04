<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Contracts\ServiceProviderInterface;
use App\Core\Providers\FrameworkServiceProvider;
use App\Modules\Detection\Providers\DetectionServiceProvider;
use App\Modules\Http\Providers\HttpServiceProvider;

/**
 * Composition root for the Kernel Framework.
 *
 * Application is the single composition root responsible for coordinating
 * framework bootstrapping through Service Providers. It owns the
 * dependency injection container, collects service providers, and executes
 * them in registration order during boot.
 *
 * Application never registers individual services directly and has no
 * knowledge of which services exist; only providers know that.
 *
 * Responsibilities:
 *
 * - Own the application container.
 * - Collect service providers.
 * - Execute service providers.
 * - Bootstrap the framework.
 *
 * Design philosophy:
 *
 * - Composition Root: all framework wiring happens here.
 * - Service Provider Pattern: registrations are grouped into cohesive
 *   provider units.
 * - Dependency Injection and Inversion of Control: services are wired
 *   through the container rather than constructed by consumers.
 * - Single Responsibility Principle: framework bootstrap only.
 * - Open/Closed Principle: new modules register new providers without
 *   modifying this class.
 * - The application is stateless except for owned services.
 * - Deterministic: boot produces the same registry on every run.
 */
final class Application
{
    /**
     * The application's dependency injection container.
     *
     * Every framework-level service is registered with this container by
     * the executed service providers during boot().
     *
     * @var Container
     */
    private readonly Container $container;

    /**
     * The collection of registered service providers.
     *
     * Providers are appended in registration order and executed in that
     * same order during boot().
     *
     * @var list<ServiceProviderInterface>
     */
    private array $providers = [];

    /**
     * Whether the framework has already been booted.
     *
     * Guards against boot() running more than once.
     *
     * @var bool
     */
    private bool $booted = false;

    /**
     * Create a new application and its dependency injection container.
     *
     * No services are registered at construction time.
     */
    public function __construct()
    {
        $this->container = new Container();
    }

    /**
     * Return the application's dependency injection container.
     *
     * @return Container The application container.
     */
    public function container(): Container
    {
        return $this->container;
    }

    /**
     * Register a service provider with the application.
     *
     * Appends the provider to the provider collection. The provider is not
     * executed immediately; it runs during boot() in registration order.
     *
     * @param ServiceProviderInterface $provider The service provider to
     *                                           register.
     *
     * @return void
     */
    public function register(ServiceProviderInterface $provider): void
    {
        $this->providers[] = $provider;
    }

    /**
     * Bootstrap the framework.
     *
     * Automatically registers the framework, HTTP, and Detection service
     * providers, then executes every registered provider in registration
     * order. Each provider receives the application container.
     *
     * The method is idempotent: if the application has already booted, it
     * returns immediately.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->booted) {
            return;
        }

        $this->register(new FrameworkServiceProvider());
        $this->register(new HttpServiceProvider());
        $this->register(new DetectionServiceProvider());

        foreach ($this->providers as $provider) {
            $provider->register($this->container);
        }

        $this->booted = true;
    }
}
