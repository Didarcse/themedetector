<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Providers\DetectionServiceProvider.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Providers\DetectionServiceProvider
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-86fd3d04fcc16758eec71cd1cbbf7f7a7976d002887e770554a254637073862b',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Providers\\DetectionServiceProvider',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Providers/DetectionServiceProvider.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Providers',
    'name' => 'App\\Modules\\Detection\\Providers\\DetectionServiceProvider',
    'shortName' => 'DetectionServiceProvider',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Registers every public Detection module service into the dependency
 * injection container.
 *
 * This provider groups Detection module service registrations into a single
 * cohesive unit. It serves as the composition root for the Detection module
 * and performs service registration only.
 *
 * Responsibilities:
 *
 * - Register the DetectorRegistry as an intentionally empty registry.
 * - Register the DetectionManager wired to the registry.
 * - Register the DetectionContextFactory.
 * - Register the WebsiteDetector as the only public Detection API.
 *
 * Design philosophy:
 *
 * - Service Provider: registrations are grouped into cohesive units.
 * - Composition Root: the provider is the single place that wires the
 *   Detection module\'s public services together.
 * - Dependency Injection and Inversion of Control: consumers depend on the
 *   public Detection API; collaborators are wired through the container.
 * - Single Responsibility Principle: Detection module registration only.
 * - Open/Closed Principle: the provider is independent of concrete CMS
 *   detectors. Future detectors are introduced through a
 *   DetectorRegistryFactory without modifying this provider, and the
 *   WebsiteDetector remains the only public Detection API.
 * - Lazy service registration: services are constructed only on first
 *   resolution.
 * - Idempotent: no registration overwrites an already registered service.
 * - Stateless, side-effect free, and deterministic.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 47,
    'endLine' => 100,
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
            'startLine' => 64,
            'endLine' => 64,
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
 * Register the Detection module services with the given container.
 *
 * Registers the DetectorRegistry as an intentionally empty registry,
 * the DetectionManager wired to the registry resolved from the
 * container, the stateless DetectionContextFactory, and the
 * WebsiteDetector facade wired to the HTTP client, the context
 * factory, and the detection manager. Every registration is
 * idempotent: if a service is already registered, nothing changes.
 *
 * @param Container $container The application dependency injection
 *                             container receiving the registrations.
 *
 * @return void
 */',
        'startLine' => 64,
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Providers',
        'declaringClassName' => 'App\\Modules\\Detection\\Providers\\DetectionServiceProvider',
        'implementingClassName' => 'App\\Modules\\Detection\\Providers\\DetectionServiceProvider',
        'currentClassName' => 'App\\Modules\\Detection\\Providers\\DetectionServiceProvider',
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