<?php

declare(strict_types=1);

namespace Core;

use RuntimeException;

/**
 * Lightweight dependency injection container with reflection-based resolution.
 */
final class Container
{
    /** @var array<string, callable|string> */
    private array $bindings = [];

    /** @var array<string, bool> */
    private array $singletons = [];

    /** @var array<string, object> */
    private array $instances = [];

    /** @var array<string, true> */
    private array $resolving = [];

    public function bind(string $abstract, callable|string $concrete): void
    {
        $this->bindings[$abstract] = $concrete;
        unset($this->singletons[$abstract], $this->instances[$abstract]);
    }

    public function singleton(string $abstract, callable|string $concrete): void
    {
        $this->bindings[$abstract] = $concrete;
        $this->singletons[$abstract] = true;
        unset($this->instances[$abstract]);
    }

    public function has(string $abstract): bool
    {
        return isset($this->bindings[$abstract])
            || (class_exists($abstract) && $this->isInstantiable($abstract));
    }

    public function make(string $abstract): object
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        if (isset($this->resolving[$abstract])) {
            throw new RuntimeException("Circular dependency detected while resolving [{$abstract}].");
        }

        $this->resolving[$abstract] = true;

        try {
            $object = $this->resolve($abstract);

            if (isset($this->singletons[$abstract])) {
                $this->instances[$abstract] = $object;
            }

            return $object;
        } finally {
            unset($this->resolving[$abstract]);
        }
    }

    private function resolve(string $abstract): object
    {
        if (isset($this->bindings[$abstract])) {
            return $this->resolveBinding($abstract);
        }

        if (class_exists($abstract)) {
            return $this->build($abstract);
        }

        throw new RuntimeException("No binding found for [{$abstract}] and the class does not exist.");
    }

    private function resolveBinding(string $abstract): object
    {
        $concrete = $this->bindings[$abstract];

        if (is_callable($concrete)) {
            $object = $concrete($this);

            if (!is_object($object)) {
                throw new RuntimeException(
                    "Binding [{$abstract}] resolved to a non-object value."
                );
            }

            return $object;
        }

        return $this->build($concrete);
    }

    private function build(string $class): object
    {
        try {
            $reflection = new \ReflectionClass($class);
        } catch (\ReflectionException $e) {
            throw new RuntimeException(
                "Cannot reflect class [{$class}]: {$e->getMessage()}.",
                previous: $e,
            );
        }

        if (!$reflection->isInstantiable()) {
            throw new RuntimeException("Class [{$class}] is not instantiable.");
        }

        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            return new $class();
        }

        $parameters = $constructor->getParameters();
        $arguments = [];

        foreach ($parameters as $parameter) {
            $arguments[] = $this->resolveParameter($parameter, $class);
        }

        try {
            return $reflection->newInstanceArgs($arguments);
        } catch (\ReflectionException $e) {
            throw new RuntimeException(
                "Cannot instantiate class [{$class}]: {$e->getMessage()}.",
                previous: $e,
            );
        }
    }

    private function resolveParameter(\ReflectionParameter $parameter, string $class): mixed
    {
        $type = $parameter->getType();

        if ($type === null || $type instanceof \ReflectionUnionType || $type instanceof \ReflectionIntersectionType) {
            if ($parameter->isDefaultValueAvailable()) {
                return $parameter->getDefaultValue();
            }

            if ($parameter->allowsNull()) {
                return null;
            }

            throw new RuntimeException(
                "Cannot resolve parameter [{$parameter->getName()}] of [{$class}]."
            );
        }

        /** @var \ReflectionNamedType $type */
        if ($type->isBuiltin()) {
            if ($parameter->isDefaultValueAvailable()) {
                return $parameter->getDefaultValue();
            }

            if ($type->allowsNull()) {
                return null;
            }

            throw new RuntimeException(
                "Cannot resolve builtin parameter [{$parameter->getName()}] of [{$class}]."
            );
        }

        return $this->make($type->getName());
    }

    private function isInstantiable(string $class): bool
    {
        try {
            $reflection = new \ReflectionClass($class);
        } catch (\ReflectionException $e) {
            return false;
        }

        return $reflection->isInstantiable();
    }
}
