<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Core\Providers\FrameworkServiceProvider.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Core\Providers\FrameworkServiceProvider
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-d517de3bb5e5fd0524675a38e1d0d82045ad889a2e4b43773253cfb42a160b12',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Core\\Providers\\FrameworkServiceProvider',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Core/Providers/FrameworkServiceProvider.php',
      ),
    ),
    'namespace' => 'App\\Core\\Providers',
    'name' => 'App\\Core\\Providers\\FrameworkServiceProvider',
    'shortName' => 'FrameworkServiceProvider',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Registers the core framework services into the dependency injection
 * container.
 *
 * This provider groups framework-level service registrations into a single
 * cohesive unit. It serves as the foundation for all future service
 * providers and performs service registration only.
 *
 * Responsibilities:
 *
 * - Register framework-level services into the container.
 *
 * Design philosophy:
 *
 * - Service Provider: registrations are grouped into cohesive units.
 * - Dependency Injection and Inversion of Control: services are wired into
 *   the container; consumers never construct them directly.
 * - Single Responsibility Principle: framework registration only.
 * - Open/Closed Principle: bootstrap grows by adding providers, never by
 *   modifying existing ones.
 * - Stateless, side-effect free, and deterministic.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 32,
    'endLine' => 54,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Core\\Contracts\\ServiceProviderInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'register' => 
      array (
        'name' => 'register',
        'parameters' => 
        array (
          'container' => 
          array (
            'name' => 'container',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Core\\Container',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 46,
            'endLine' => 46,
            'startColumn' => 30,
            'endColumn' => 49,
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
 * Register the framework-level services with the given container.
 *
 * The container registers itself under Container::class so that every
 * framework service can resolve it. The registration is idempotent: if
 * the service is already registered, nothing changes.
 *
 * @param Container $container The application dependency injection
 *                             container receiving the registrations.
 *
 * @return void
 */',
        'startLine' => 46,
        'endLine' => 53,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Core\\Providers',
        'declaringClassName' => 'App\\Core\\Providers\\FrameworkServiceProvider',
        'implementingClassName' => 'App\\Core\\Providers\\FrameworkServiceProvider',
        'currentClassName' => 'App\\Core\\Providers\\FrameworkServiceProvider',
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