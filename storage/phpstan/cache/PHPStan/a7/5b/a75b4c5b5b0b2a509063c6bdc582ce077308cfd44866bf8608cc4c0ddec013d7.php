<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\PluginDetection\PluginDetectionManager.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\PluginDetection\PluginDetectionManager
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-7e2e6c3a8717d1569f857bc5d9f62209287fb12983b290173b351eedb3a3c309',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\PluginDetection\\PluginDetectionManager',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/PluginDetection/PluginDetectionManager.php',
      ),
    ),
    'namespace' => 'App\\Modules\\PluginDetection',
    'name' => 'App\\Modules\\PluginDetection\\PluginDetectionManager',
    'shortName' => 'PluginDetectionManager',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Coordinates the complete plugin detection workflow.
 *
 * The PluginDetectionManager is the orchestration layer of the Plugin
 * Detection Engine. It iterates the detectors registered in the
 * PluginRegistry, delegates detection to the first detector that supports
 * the supplied context, and returns the resulting PluginDetectionResult.
 *
 * Responsibilities:
 *
 * - Obtain every registered detector from the PluginRegistry.
 * - Iterate through the detectors in registration order.
 * - Invoke supports() on each detector.
 * - Delegate detection to the first detector that supports the supplied
 *   DetectionContext.
 * - Return the resulting PluginDetectionResult.
 *
 * Design philosophy:
 *
 * - Orchestrator Pattern: the manager coordinates the registered
 *   detectors and never performs detection itself.
 * - Single Responsibility Principle: the manager performs pure
 *   orchestration only. It does no HTTP requests, no parsing, no
 *   confidence calculation, and no platform-specific logic.
 * - Dependency Injection: the manager depends on the PluginRegistry and
 *   receives it through the constructor.
 * - Open/Closed Principle: it works exclusively with
 *   PluginDetectorInterface and has no knowledge of any concrete
 *   platform (WordPress, Shopify, Ghost, Browser Extensions, CMS Modules,
 *   etc.), so new detectors can be added without modifying the manager.
 * - Detectors are never reordered and never executed more than once. The
 *   first detector in registration order that supports the context is
 *   the only one executed.
 * - The manager is stateless, deterministic, and side-effect free: given
 *   the same registry and context, it always returns the same result.
 *
 * Future Compatibility:
 *
 * - Future plugin detector implementations are discovered only through
 *   the PluginRegistry and are consumed by this manager without
 *   modification.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 51,
    'endLine' => 90,
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
      'registry' => 
      array (
        'declaringClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionManager',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionManager',
        'name' => 'registry',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\PluginDetection\\PluginRegistry',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 58,
        'endLine' => 58,
        'startColumn' => 9,
        'endColumn' => 40,
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
          'registry' => 
          array (
            'name' => 'registry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\PluginDetection\\PluginRegistry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 58,
            'endLine' => 58,
            'startColumn' => 9,
            'endColumn' => 40,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param PluginRegistry $registry The registry of registered plugin
 *                                 detectors.
 */',
        'startLine' => 57,
        'endLine' => 60,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionManager',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionManager',
        'currentClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionManager',
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
            'startLine' => 76,
            'endLine' => 76,
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
 * Detectors are consulted in registration order. The first detector
 * that supports the context is delegated to and its result is
 * returned. When no detector supports the context, a deterministic
 * failed result (detected = false, plugin = null, confidence = 0) is
 * returned. The given DetectionContext is never changed.
 *
 * @param DetectionContext $context The immutable detection context
 *                                  containing the HTTP response data.
 *
 * @return PluginDetectionResult The normalized plugin detection result.
 */',
        'startLine' => 76,
        'endLine' => 89,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionManager',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionManager',
        'currentClassName' => 'App\\Modules\\PluginDetection\\PluginDetectionManager',
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