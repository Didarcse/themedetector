<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Core\Application.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Core\Application
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-a5e918490a7188304c817319706121f137b79e7fb22870c342f6808631f42bac',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Core\\Application',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Core/Application.php',
      ),
    ),
    'namespace' => 'App\\Core',
    'name' => 'App\\Core\\Application',
    'shortName' => 'Application',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
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
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 43,
    'endLine' => 138,
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
      'container' => 
      array (
        'declaringClassName' => 'App\\Core\\Application',
        'implementingClassName' => 'App\\Core\\Application',
        'name' => 'container',
        'modifiers' => 132,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Core\\Container',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => '/**
 * The application\'s dependency injection container.
 *
 * Every framework-level service is registered with this container by
 * the executed service providers during boot().
 *
 * @var Container
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 53,
        'endLine' => 53,
        'startColumn' => 5,
        'endColumn' => 42,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'providers' => 
      array (
        'declaringClassName' => 'App\\Core\\Application',
        'implementingClassName' => 'App\\Core\\Application',
        'name' => 'providers',
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
            'startLine' => 63,
            'endLine' => 63,
            'startTokenPos' => 66,
            'startFilePos' => 2053,
            'endTokenPos' => 67,
            'endFilePos' => 2054,
          ),
        ),
        'docComment' => '/**
 * The collection of registered service providers.
 *
 * Providers are appended in registration order and executed in that
 * same order during boot().
 *
 * @var list<ServiceProviderInterface>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 63,
        'endLine' => 63,
        'startColumn' => 5,
        'endColumn' => 34,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'booted' => 
      array (
        'declaringClassName' => 'App\\Core\\Application',
        'implementingClassName' => 'App\\Core\\Application',
        'name' => 'booted',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 72,
            'endLine' => 72,
            'startTokenPos' => 80,
            'startFilePos' => 2239,
            'endTokenPos' => 80,
            'endFilePos' => 2243,
          ),
        ),
        'docComment' => '/**
 * Whether the framework has already been booted.
 *
 * Guards against boot() running more than once.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 72,
        'endLine' => 72,
        'startColumn' => 5,
        'endColumn' => 33,
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
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a new application and its dependency injection container.
 *
 * No services are registered at construction time.
 */',
        'startLine' => 79,
        'endLine' => 82,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Core',
        'declaringClassName' => 'App\\Core\\Application',
        'implementingClassName' => 'App\\Core\\Application',
        'currentClassName' => 'App\\Core\\Application',
        'aliasName' => NULL,
      ),
      'container' => 
      array (
        'name' => 'container',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Core\\Container',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return the application\'s dependency injection container.
 *
 * @return Container The application container.
 */',
        'startLine' => 89,
        'endLine' => 92,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Core',
        'declaringClassName' => 'App\\Core\\Application',
        'implementingClassName' => 'App\\Core\\Application',
        'currentClassName' => 'App\\Core\\Application',
        'aliasName' => NULL,
      ),
      'register' => 
      array (
        'name' => 'register',
        'parameters' => 
        array (
          'provider' => 
          array (
            'name' => 'provider',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Core\\Contracts\\ServiceProviderInterface',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 105,
            'endLine' => 105,
            'startColumn' => 30,
            'endColumn' => 63,
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
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Register a service provider with the application.
 *
 * Appends the provider to the provider collection. The provider is not
 * executed immediately; it runs during boot() in registration order.
 *
 * @param ServiceProviderInterface $provider The service provider to
 *                                           register.
 *
 * @return void
 */',
        'startLine' => 105,
        'endLine' => 108,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Core',
        'declaringClassName' => 'App\\Core\\Application',
        'implementingClassName' => 'App\\Core\\Application',
        'currentClassName' => 'App\\Core\\Application',
        'aliasName' => NULL,
      ),
      'boot' => 
      array (
        'name' => 'boot',
        'parameters' => 
        array (
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
 */',
        'startLine' => 122,
        'endLine' => 137,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Core',
        'declaringClassName' => 'App\\Core\\Application',
        'implementingClassName' => 'App\\Core\\Application',
        'currentClassName' => 'App\\Core\\Application',
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