<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\PluginDetection\Contracts\PluginDetectorInterface.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\PluginDetection\Contracts\PluginDetectorInterface
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-a0c3d5b32034fa9e49bbd1ce6bff3a624081c680941fd19826d36c1ccba04e9e',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\PluginDetection\\Contracts\\PluginDetectorInterface',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/PluginDetection/Contracts/PluginDetectorInterface.php',
      ),
    ),
    'namespace' => 'App\\Modules\\PluginDetection\\Contracts',
    'name' => 'App\\Modules\\PluginDetection\\Contracts\\PluginDetectorInterface',
    'shortName' => 'PluginDetectorInterface',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Contract for every Plugin Detector implementation.
 *
 * A Plugin Detector determines whether it supports the supplied detection
 * context and, if so, produces a normalized plugin detection result. Every
 * detector returns the same normalized PluginDetectionResult shape
 * regardless of the underlying platform.
 *
 * Responsibilities:
 *
 * - Determine whether the detector supports the given detection context.
 * - Produce a normalized plugin detection result.
 *
 * Design philosophy:
 *
 * - Interface Segregation Principle: the contract exposes only the
 *   operations a plugin detector needs.
 * - Contract: consumers depend on this abstraction rather than on a
 *   concrete detector.
 * - Dependency Injection and Open/Closed Principle: new detectors are
 *   introduced by implementing this interface without modifying existing
 *   code.
 * - Single Responsibility Principle: detectors perform plugin detection
 *   only. They never perform HTTP requests, never parse responses, and
 *   never apply detection rules.
 * - Stateless, deterministic, and side-effect free.
 *
 * Future Compatibility:
 *
 * - Every future plugin detector — WordPress Plugins, Shopify Apps, Ghost
 *   Integrations, Browser Extensions, CMS Modules, and future platforms —
 *   must implement this contract and produce a PluginDetectionResult.
 *
 * The interface knows nothing about SEO, Security, Performance, or
 * Website Intelligence.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 46,
    'endLine' => 71,
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
    ),
    'immediateMethods' => 
    array (
      'supports' => 
      array (
        'name' => 'supports',
        'parameters' => 
        array (
          'context' => 
          array (
            'name' => 'context',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Detection\\DetectionContext',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 56,
            'endLine' => 56,
            'startColumn' => 30,
            'endColumn' => 54,
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
 * Determine whether the detector supports the given detection context.
 *
 * @param DetectionContext $context The immutable detection context
 *                                  containing the HTTP response data.
 *
 * @return bool True when the detector supports the supplied context.
 */',
        'startLine' => 56,
        'endLine' => 56,
        'startColumn' => 5,
        'endColumn' => 62,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection\\Contracts',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\Contracts\\PluginDetectorInterface',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\Contracts\\PluginDetectorInterface',
        'currentClassName' => 'App\\Modules\\PluginDetection\\Contracts\\PluginDetectorInterface',
        'aliasName' => NULL,
      ),
      'detect' => 
      array (
        'name' => 'detect',
        'parameters' => 
        array (
          'context' => 
          array (
            'name' => 'context',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Detection\\DetectionContext',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 70,
            'endLine' => 70,
            'startColumn' => 28,
            'endColumn' => 52,
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
            'name' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Detect a plugin from the given detection context.
 *
 * The context carries the immutable HTTP response data collected by
 * the Detection Engine. Detectors translate that data into plugin
 * information and perform no additional HTTP requests of their own.
 *
 * @param DetectionContext $context The immutable detection context
 *                                  containing the HTTP response data.
 *
 * @return PluginDetectionResult The normalized plugin detection result.
 */',
        'startLine' => 70,
        'endLine' => 70,
        'startColumn' => 5,
        'endColumn' => 77,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection\\Contracts',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\Contracts\\PluginDetectorInterface',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\Contracts\\PluginDetectorInterface',
        'currentClassName' => 'App\\Modules\\PluginDetection\\Contracts\\PluginDetectorInterface',
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