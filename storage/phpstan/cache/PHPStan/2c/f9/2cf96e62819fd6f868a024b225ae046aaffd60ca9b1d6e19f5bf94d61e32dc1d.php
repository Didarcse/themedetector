<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\PluginDetection\PluginRegistry.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\PluginDetection\PluginRegistry
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-061fcd379b4208c7ecb1606ddeb907b05be2f26f237bcadaf624275f92f0f9f2',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\PluginDetection\\PluginRegistry',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/PluginDetection/PluginRegistry.php',
      ),
    ),
    'namespace' => 'App\\Modules\\PluginDetection',
    'name' => 'App\\Modules\\PluginDetection\\PluginRegistry',
    'shortName' => 'PluginRegistry',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Provides a central registry for every Plugin Detector supported by the
 * Plugin Detection Engine.
 *
 * The registry is the composition point for plugin detector
 * implementations. It is responsible only for registering and exposing
 * detector instances. It performs no detection, no orchestration, no
 * confidence calculation, and no HTTP requests.
 *
 * Responsibilities:
 *
 * - Register PluginDetectorInterface implementations.
 * - Return all registered detectors.
 * - Nothing else.
 *
 * Design philosophy:
 *
 * - Registry Pattern: the registry owns the plugin detector collection and
 *   nothing more.
 * - Single Responsibility Principle: the registry has no business logic,
 *   no detection logic, no parsing, and no HTTP.
 * - Open/Closed Principle: it works exclusively with
 *   PluginDetectorInterface and has no knowledge of any concrete
 *   platform (WordPress, Shopify, Ghost, Browser Extensions, CMS Modules,
 *   etc.), so new detectors can be registered without modifying the
 *   registry.
 * - Detectors are never reordered, filtered, deduplicated, or
 *   transformed. The all() accessor returns exactly what was registered,
 *   in the order it was registered.
 * - The registry is deterministic and side-effect free, holding no state
 *   other than the detector collection itself.
 *
 * Future Compatibility:
 *
 * - Every future plugin detector implementation — WordPress Plugins,
 *   Shopify Apps, Ghost Integrations, Browser Extensions, CMS Modules,
 *   and future platforms — is registered through this registry.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 47,
    'endLine' => 79,
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
      'detectors' => 
      array (
        'declaringClassName' => 'App\\Modules\\PluginDetection\\PluginRegistry',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\PluginRegistry',
        'name' => 'detectors',
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
            'startLine' => 52,
            'endLine' => 52,
            'startTokenPos' => 40,
            'startFilePos' => 1827,
            'endTokenPos' => 41,
            'endFilePos' => 1828,
          ),
        ),
        'docComment' => '/**
 * @var list<PluginDetectorInterface>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 52,
        'endLine' => 52,
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
      'register' => 
      array (
        'name' => 'register',
        'parameters' => 
        array (
          'detector' => 
          array (
            'name' => 'detector',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\PluginDetection\\Contracts\\PluginDetectorInterface',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 62,
            'endLine' => 62,
            'startColumn' => 30,
            'endColumn' => 62,
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
 * Register a plugin detector implementation.
 *
 * The detector is appended to the registry in the exact order it is
 * registered.
 *
 * @param PluginDetectorInterface $detector The detector to register.
 */',
        'startLine' => 62,
        'endLine' => 65,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\PluginRegistry',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\PluginRegistry',
        'currentClassName' => 'App\\Modules\\PluginDetection\\PluginRegistry',
        'aliasName' => NULL,
      ),
      'all' => 
      array (
        'name' => 'all',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return every registered plugin detector.
 *
 * Detectors are returned exactly as registered: no reordering, no
 * filtering, and no transformation.
 *
 * @return list<PluginDetectorInterface> The registered detectors.
 */',
        'startLine' => 75,
        'endLine' => 78,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\PluginRegistry',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\PluginRegistry',
        'currentClassName' => 'App\\Modules\\PluginDetection\\PluginRegistry',
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