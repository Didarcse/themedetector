<?php declare(strict_types = 1);

// osfsl-C:\xampp\htdocs\themedetector\app\Core\Container.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Core\Container
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-4d4ba00566ae6e68b26916658872a25d39c50f1c51cb23733f9a0fa5359fd23c-8.2-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Core\\Container',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Core/Container.php',
      ),
    ),
    'namespace' => 'App\\Core',
    'name' => 'App\\Core\\Container',
    'shortName' => 'Container',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
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
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 41,
    'endLine' => 158,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'definitions' => 
      array (
        'declaringClassName' => 'App\\Core\\Container',
        'implementingClassName' => 'App\\Core\\Container',
        'name' => 'definitions',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 51,
            'endLine' => 51,
            'startTokenPos' => 40,
            'startFilePos' => 1875,
            'endTokenPos' => 41,
            'endFilePos' => 1876,
          ),
        ),
        'docComment' => '/**
 * Registered service factories.
 *
 * Each entry is a lazy factory callable, invoked with the container as
 * its only argument the first time the service is resolved.
 *
 * @var array<string, callable(Container): object>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 51,
        'endLine' => 51,
        'startColumn' => 5,
        'endColumn' => 36,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'instances' => 
      array (
        'declaringClassName' => 'App\\Core\\Container',
        'implementingClassName' => 'App\\Core\\Container',
        'name' => 'instances',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 61,
            'endLine' => 61,
            'startTokenPos' => 54,
            'startFilePos' => 2147,
            'endTokenPos' => 55,
            'endFilePos' => 2148,
          ),
        ),
        'docComment' => '/**
 * Cached singleton instances.
 *
 * Each entry is a fully resolved service instance, cached so that every
 * subsequent resolution returns the exact same object.
 *
 * @var array<string, object>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 61,
        'endLine' => 61,
        'startColumn' => 5,
        'endColumn' => 34,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      'set' => 
      array (
        'name' => 'set',
        'parameters' => 
        array (
          'id' => 
          array (
            'name' => 'id',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 76,
            'endLine' => 76,
            'startColumn' => 25,
            'endColumn' => 34,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'definition' => 
          array (
            'name' => 'definition',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
              'data' => 
              array (
                'types' => 
                array (
                  0 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'callable',
                      'isIdentifier' => true,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'object',
                      'isIdentifier' => true,
                    ),
                  ),
                ),
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 76,
            'endLine' => 76,
            'startColumn' => 37,
            'endColumn' => 63,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
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
 */',
        'startLine' => 76,
        'endLine' => 87,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Core',
        'declaringClassName' => 'App\\Core\\Container',
        'implementingClassName' => 'App\\Core\\Container',
        'currentClassName' => 'App\\Core\\Container',
        'aliasName' => NULL,
      ),
      'has' => 
      array (
        'name' => 'has',
        'parameters' => 
        array (
          'id' => 
          array (
            'name' => 'id',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 97,
            'endLine' => 97,
            'startColumn' => 25,
            'endColumn' => 34,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Determine whether a service has been registered.
 *
 * Returns true only for identifiers registered via set(); unknown
 * identifiers are never resolved automatically.
 *
 * @param string $id The service identifier.
 */',
        'startLine' => 97,
        'endLine' => 100,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Core',
        'declaringClassName' => 'App\\Core\\Container',
        'implementingClassName' => 'App\\Core\\Container',
        'currentClassName' => 'App\\Core\\Container',
        'aliasName' => NULL,
      ),
      'get' => 
      array (
        'name' => 'get',
        'parameters' => 
        array (
          'id' => 
          array (
            'name' => 'id',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 120,
            'endLine' => 120,
            'startColumn' => 25,
            'endColumn' => 34,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'object',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
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
 */',
        'startLine' => 120,
        'endLine' => 133,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => true,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Core',
        'declaringClassName' => 'App\\Core\\Container',
        'implementingClassName' => 'App\\Core\\Container',
        'currentClassName' => 'App\\Core\\Container',
        'aliasName' => NULL,
      ),
      'make' => 
      array (
        'name' => 'make',
        'parameters' => 
        array (
          'id' => 
          array (
            'name' => 'id',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 154,
            'endLine' => 154,
            'startColumn' => 26,
            'endColumn' => 35,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'object',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
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
 */',
        'startLine' => 154,
        'endLine' => 157,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Core',
        'declaringClassName' => 'App\\Core\\Container',
        'implementingClassName' => 'App\\Core\\Container',
        'currentClassName' => 'App\\Core\\Container',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));