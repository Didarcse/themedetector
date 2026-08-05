<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Exceptions\ServiceNotFoundException;

/**
 * Lightweight dependency injection container for the Kernel Framework.
 *
 * The container registers, resolves, and caches application services under
 * string identifiers. It centralizes object creation and dependency
 * management while keeping the framework loosely coupled, and performs no
 * business logic itself.
 *
 * Services are registered with either a pre-built object instance or a lazy
 * factory callable. Factories are executed at most once, on first access,
 * and the resulting instance is cached for the lifetime of the container.
 *
 * Responsibilities:
 *
 * - Register services under a string identifier.
 * - Resolve registered services lazily on demand.
 * - Cache resolved instances as singletons.
 *
 * Design philosophy:
 *
 * - Dependency Injection: services receive their collaborators through the
 *   container rather than constructing them directly.
 * - Inversion of Control: the container owns creation and lifetime; the
 *   rest of the application only requests services.
 * - Single Responsibility Principle: the container only registers and
 *   resolves services. It contains no application logic.
 * - Lazy resolution: factory callables run only when a service is first
 *   requested.
 * - Singleton lifetime: each service resolves to exactly one instance.
 * - The container is stateless except for the service registry itself.
 * - Deterministic: resolution depends solely on the service registry.
 */
final class Container
{
    /**
     * Registered service factories.
     *
     * Each entry is a lazy factory callable, invoked with the container as
     * its only argument the first time the service is resolved.
     *
     * @var array<string, callable(Container): object>
     */
    private array $definitions = [];

    /**
     * Cached singleton instances.
     *
     * Each entry is a fully resolved service instance, cached so that every
     * subsequent resolution returns the exact same object.
     *
     * @var array<string, object>
     */
    private array $instances = [];

    /**
     * Register a service under the given identifier.
     *
     * An object definition is cached immediately as an already-resolved
     * singleton. A callable definition acts as a lazy factory invoked with
     * the container as its only argument on first resolution.
     * Re-registering an identifier replaces the previous definition and any
     * cached instance.
     *
     * @param string          $id         The service identifier.
     * @param callable|object $definition The factory callable or pre-built
     *                                    service instance.
     */
    public function set(string $id, callable|object $definition): void
    {
        if (is_callable($definition)) {
            $this->definitions[$id] = $definition;
            unset($this->instances[$id]);

            return;
        }

        $this->instances[$id] = $definition;
        unset($this->definitions[$id]);
    }

    /**
     * Determine whether a service has been registered.
     *
     * Returns true only for identifiers registered via set(); unknown
     * identifiers are never resolved automatically.
     *
     * @param string $id The service identifier.
     */
    public function has(string $id): bool
    {
        return isset($this->definitions[$id]) || isset($this->instances[$id]);
    }

    /**
     * Resolve a service and return its cached instance.
     *
     * A cached singleton is returned immediately. Otherwise the registered
     * factory is invoked with the container as its only argument. Factories
     * are executed at most once; every call returns the exact same object
     * instance.
     *
     * @template T of object
     *
     * @param class-string<T>|string $id The service identifier.
     *
     * @return ($id is class-string<T> ? T : object) The resolved singleton
     *                                              instance.
     *
     * @throws ServiceNotFoundException When no service has been registered
     *                                  under the given identifier.
     */
    public function get(string $id): object
    {
        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }

        $definition = $this->definitions[$id] ?? null;

        if ($definition === null) {
            throw new ServiceNotFoundException(sprintf('Service "%s" is not registered.', $id));
        }

        return $this->instances[$id] = $definition($this);
    }

    /**
     * Resolve a service and return its cached instance.
     *
     * Framework-facing resolution entry point. Resolves a registered
     * service exactly like get(): a cached singleton is returned
     * immediately, otherwise the registered factory is invoked with the
     * container as its only argument and the instance is cached. Services
     * not registered via set() are never resolved automatically.
     *
     * @template T of object
     *
     * @param class-string<T>|string $id The service identifier.
     *
     * @return ($id is class-string<T> ? T : object) The resolved singleton
     *                                              instance.
     *
     * @throws ServiceNotFoundException When no service has been registered
     *                                  under the given identifier.
     */
    public function make(string $id): object
    {
        return $this->get($id);
    }
}
