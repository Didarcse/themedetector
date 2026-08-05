<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Http\Providers\HttpServiceProvider.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Http\Providers\HttpServiceProvider
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-34505e2a037a05360d264e156ceccda8b178f0b0de17d40043ca3e94bc8174be',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Http\\Providers\\HttpServiceProvider',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Http/Providers/HttpServiceProvider.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Http\\Providers',
    'name' => 'App\\Modules\\Http\\Providers\\HttpServiceProvider',
    'shortName' => 'HttpServiceProvider',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Registers all HTTP Infrastructure services into the dependency injection
 * container.
 *
 * This provider groups HTTP-related service registrations into a single
 * cohesive unit. It serves as the composition root for the HTTP module and
 * performs service registration only.
 *
 * Responsibilities:
 *
 * - Register HTTP Infrastructure services into the container.
 *
 * Design philosophy:
 *
 * - Service Provider: registrations are grouped into cohesive units.
 * - Dependency Injection and Inversion of Control: HTTP consumers depend
 *   on HttpClientInterface, never on a concrete transport.
 * - Single Responsibility Principle: HTTP registration only.
 * - Open/Closed Principle: the HTTP module grows by adding providers,
 *   never by modifying existing ones.
 * - Lazy service registration: the client is constructed only on first
 *   resolution.
 * - Stateless, side-effect free, and deterministic.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 37,
    'endLine' => 64,
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
            'startLine' => 51,
            'endLine' => 51,
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
 * Register the HTTP Infrastructure services with the given container.
 *
 * Binds HttpClientInterface to a lazy factory that constructs the
 * cURL-backed client on first resolution. The registration is
 * idempotent: if the service is already registered, nothing changes.
 *
 * @param Container $container The application dependency injection
 *                             container receiving the registrations.
 *
 * @return void
 */',
        'startLine' => 51,
        'endLine' => 63,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http\\Providers',
        'declaringClassName' => 'App\\Modules\\Http\\Providers\\HttpServiceProvider',
        'implementingClassName' => 'App\\Modules\\Http\\Providers\\HttpServiceProvider',
        'currentClassName' => 'App\\Modules\\Http\\Providers\\HttpServiceProvider',
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