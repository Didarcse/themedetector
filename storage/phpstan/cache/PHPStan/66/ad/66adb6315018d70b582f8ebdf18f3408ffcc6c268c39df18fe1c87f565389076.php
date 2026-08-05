<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\ThemeExtraction\Providers\ThemeExtractionServiceProvider.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\ThemeExtraction\Providers\ThemeExtractionServiceProvider
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-45c6f749ddb444b379759b9fdd8aa42d3bd47a829c6e12eb16fc40eed9d30506',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\ThemeExtraction\\Providers\\ThemeExtractionServiceProvider',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/ThemeExtraction/Providers/ThemeExtractionServiceProvider.php',
      ),
    ),
    'namespace' => 'App\\Modules\\ThemeExtraction\\Providers',
    'name' => 'App\\Modules\\ThemeExtraction\\Providers\\ThemeExtractionServiceProvider',
    'shortName' => 'ThemeExtractionServiceProvider',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Registers every Theme Extraction Engine service into the dependency
 * injection container.
 *
 * This provider groups Theme Extraction service registrations into a single
 * cohesive unit. It serves as the composition root for the Theme Extraction
 * module and performs service registration only.
 *
 * Responsibilities:
 *
 * - Register the ThemeExtractorRegistry as an intentionally empty registry.
 * - Register the ThemeExtractionManager wired to the registry.
 *
 * Design philosophy:
 *
 * - Service Provider: registrations are grouped into cohesive units.
 * - Composition Root: the provider is the single place that wires the Theme
 *   Extraction Engine\'s public services together.
 * - Dependency Injection and Inversion of Control: consumers depend on the
 *   public Theme Extraction services; collaborators are wired through the
 *   container.
 * - Single Responsibility Principle: Theme Extraction registration only.
 * - Open/Closed Principle: the provider is independent of concrete theme
 *   extractors. Future extractors are introduced through a
 *   ThemeExtractorRegistryFactory without modifying this provider, so this
 *   provider never requires modification when new extractors are added.
 * - Lazy service registration: services are constructed only on first
 *   resolution.
 * - Idempotent: no registration overwrites an already registered service.
 * - Stateless, side-effect free, and deterministic.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 43,
    'endLine' => 76,
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
            'startLine' => 58,
            'endLine' => 58,
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
 * Register the Theme Extraction Engine services with the given container.
 *
 * Registers the ThemeExtractorRegistry as an intentionally empty
 * registry and the ThemeExtractionManager wired to the registry resolved
 * from the container. Every registration is idempotent: if a service is
 * already registered, nothing changes.
 *
 * @param Container $container The application dependency injection
 *                             container receiving the registrations.
 *
 * @return void
 */',
        'startLine' => 58,
        'endLine' => 75,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction\\Providers',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\Providers\\ThemeExtractionServiceProvider',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\Providers\\ThemeExtractionServiceProvider',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\Providers\\ThemeExtractionServiceProvider',
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