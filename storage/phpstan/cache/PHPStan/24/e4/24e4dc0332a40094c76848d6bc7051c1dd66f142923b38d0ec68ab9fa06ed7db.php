<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\PluginDetection\PluginDetectionResult.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\PluginDetection\PluginDetectionResult
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-647ab5785a87f10e32c08363ab39dfdf056e624140eb3ec7d6f1f63c364820fd',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/PluginDetection/PluginDetectionResult.php',
      ),
    ),
    'namespace' => 'App\\Modules\\PluginDetection',
    'name' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
    'shortName' => 'PluginDetectionResult',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Immutable value object representing the result of a plugin detection.
 *
 * PluginDetectionResult is the canonical result produced by every Plugin
 * Detector implementation. It contains the outcome of a plugin detection
 * operation — whether a plugin was detected, the confidence of that
 * outcome, and the normalized PluginMetadata describing the detected
 * plugin when detection succeeded.
 *
 * Responsibilities:
 *
 * - Represent the outcome of a plugin detection operation.
 * - Carry the normalized plugin metadata and confidence score.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it stores result data only and
 *   performs no detection logic.
 * - Stateless, deterministic, and side-effect free.
 * - It contains no parsing logic and knows nothing about WordPress,
 *   Shopify, Ghost, or any other platform.
 *
 * Future Compatibility:
 *
 * - Future plugin detectors must produce this normalized result model.
 * - The model supports WordPress Plugins, Shopify Apps, Ghost
 *   Integrations, and future platforms without modification.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 36,
    'endLine' => 83,
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
      'detected' => 
      array (
        'declaringClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'name' => 'detected',
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
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 47,
        'endLine' => 47,
        'startColumn' => 9,
        'endColumn' => 30,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'plugin' => 
      array (
        'declaringClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'name' => 'plugin',
        'modifiers' => 4,
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
                  'name' => 'App\\Modules\\PluginDetection\\PluginMetadata',
                  'isIdentifier' => false,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'null',
                  'isIdentifier' => true,
                ),
              ),
            ),
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 48,
        'endLine' => 48,
        'startColumn' => 9,
        'endColumn' => 39,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'confidence' => 
      array (
        'declaringClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'name' => 'confidence',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 49,
        'endLine' => 49,
        'startColumn' => 9,
        'endColumn' => 31,
        'isPromoted' => true,
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
          'detected' => 
          array (
            'name' => 'detected',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 47,
            'endLine' => 47,
            'startColumn' => 9,
            'endColumn' => 30,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'plugin' => 
          array (
            'name' => 'plugin',
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
                      'name' => 'App\\Modules\\PluginDetection\\PluginMetadata',
                      'isIdentifier' => false,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'null',
                      'isIdentifier' => true,
                    ),
                  ),
                ),
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 48,
            'endLine' => 48,
            'startColumn' => 9,
            'endColumn' => 39,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'confidence' => 
          array (
            'name' => 'confidence',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 49,
            'endLine' => 49,
            'startColumn' => 9,
            'endColumn' => 31,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a plugin detection result instance.
 *
 * @param bool                 $detected   Whether a plugin was detected.
 * @param PluginMetadata|null  $plugin     The normalized plugin metadata,
 *                                         null when no plugin was detected.
 * @param int                  $confidence The confidence score (0–100).
 */',
        'startLine' => 46,
        'endLine' => 51,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'currentClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'aliasName' => NULL,
      ),
      'isDetected' => 
      array (
        'name' => 'isDetected',
        'parameters' => 
        array (
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
 * Return whether a plugin was detected.
 *
 * @return bool True when the detection identified a plugin.
 */',
        'startLine' => 58,
        'endLine' => 61,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'currentClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'aliasName' => NULL,
      ),
      'plugin' => 
      array (
        'name' => 'plugin',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
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
                  'name' => 'App\\Modules\\PluginDetection\\PluginMetadata',
                  'isIdentifier' => false,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'null',
                  'isIdentifier' => true,
                ),
              ),
            ),
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return the normalized plugin metadata.
 *
 * @return PluginMetadata|null The detected plugin metadata, or null when
 *                             no plugin was detected.
 */',
        'startLine' => 69,
        'endLine' => 72,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'currentClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'aliasName' => NULL,
      ),
      'confidence' => 
      array (
        'name' => 'confidence',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return the confidence score of the detection.
 *
 * @return int The confidence score (0–100).
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
        'namespace' => 'App\\Modules\\PluginDetection',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
        'currentClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
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