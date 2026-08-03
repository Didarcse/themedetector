<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

/**
 * Lightweight dependency injection container for the Kernel Framework.
 *
 * The container is responsible for constructing and resolving application
 * services. It centralizes object creation and dependency management while
 * performing no business logic.
 *
 * Services are registered by identifier with a factory callable or a
 * pre-built object, resolved lazily on first access, and cached so that
 * every subsequent access returns the same singleton instance.
 *
 * Responsibilities:
 *
 * - Register services under a string identifier.
 * - Resolve registered services on demand.
 * - Return singleton instances.
 *
 * Design philosophy:
 *
 * - Dependency Injection and Inversion of Control: services never
 *   construct their collaborators; the container wires them.
 * - Single Responsibility Principle: the container registers and resolves
 *   services only. It contains no application logic.
 * - Lazy service resolution: factories run only when a service is first
 *   requested.
 * - Singleton service lifetime: each service is resolved once and reused.
 * - The container is stateless except for the service registry itself.
 */
final class Container
{
    /** @var array<string, callable> */
    private array $definitions = [];

    /** @var array<string, object> */
    private array $instances = [];

    /** @var array<string, true> */
    private array $resolving = [];

    /**
     * Register a service under the given identifier.
     *
     * When the definition is a callable it acts as a lazy factory invoked
     * with the container as its only argument on first resolution. When
     * the definition is an object it is registered directly and returned
     * as-is. Re-registering an identifier replaces the previous
     * definition.
     *
     * @param string        $id         The service identifier.
     * @param callable|object $definition The factory callable or pre-built
     *                                    service instance.
     */
    public function set(string $id, callable|object $definition): void
    {
        if (is_object($definition)) {
            $this->instances[$id] = $definition;
            unset($this->definitions[$id]);

            return;
        }

        $this->definitions[$id] = $definition;
        unset($this->instances[$id]);
    }

    /**
     * Determine whether a service has been registered.
     *
     * @param string $id The service identifier.
     */
    public function has(string $id): bool
    {
        return isset($this->definitions[$id]) || isset($this->instances[$id]);
    }

    /**
     * Resolve a service and return its singleton instance.
     *
     * The service is resolved lazily on first access and cached, so every
     * subsequent call returns the same instance.
     *
     * @param string $id The service identifier.
     *
     * @return object The resolved singleton instance.
     *
     * @throws RuntimeException When the service has not been registered,
     *                          when its factory resolves to a non-object
     *                          value, or when a circular dependency is
     *                          detected.
     */
    public function get(string $id): object
    {
        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }

        if (!isset($this->definitions[$id])) {
            throw new RuntimeException("Service [{$id}] has not been registered.");
        }

        if (isset($this->resolving[$id])) {
            throw new RuntimeException("Circular dependency detected while resolving [{$id}].");
        }

        $this->resolving[$id] = true;

        try {
            $instance = ($this->definitions[$id])($this);

            if (!is_object($instance)) {
                throw new RuntimeException("Service [{$id}] resolved to a non-object value.");
            }

            return $this->instances[$id] = $instance;
        } finally {
            unset($this->resolving[$id]);
        }
    }
}
