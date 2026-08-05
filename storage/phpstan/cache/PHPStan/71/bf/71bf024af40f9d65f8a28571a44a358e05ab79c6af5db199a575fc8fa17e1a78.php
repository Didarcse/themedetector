<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\DetectionManager.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\DetectionManager
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-d9f178f8e0455526a8b7eb4d00f5aef8638c74a770b8a39cbb1ce6031495362b',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\DetectionManager',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/DetectionManager.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection',
    'name' => 'App\\Modules\\Detection\\DetectionManager',
    'shortName' => 'DetectionManager',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65536,
    'docComment' => '/**
 * Coordinates every registered detector and returns the best detection
 * result.
 *
 * The DetectionManager is the orchestration layer of the Detection
 * Engine. It executes every detector registered in the DetectorRegistry,
 * compares their confidence scores, and returns the DetectionResult with
 * the highest confidence.
 *
 * Responsibilities:
 *
 * - Execute every registered detector in the order it was provided.
 * - Compare detector results and select the highest-confidence outcome.
 * - Throw a RuntimeException when no detector has been registered.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: the manager performs pure
 *   orchestration only. It does no HTTP requests, no HTML parsing, no
 *   confidence calculation, and no metadata merging.
 * - Open/Closed Principle: it works exclusively with DetectorInterface
 *   and has no knowledge of any concrete technology (WordPress, Joomla,
 *   Drupal, Ghost, TYPO3, etc.), so new detectors can be added without
 *   modifying the manager.
 * - Detectors are never reordered and never executed more than once. On
 *   equal confidence, the first detector in registration order wins.
 * - The manager is stateless, deterministic, and side-effect free: given
 *   the same registry and context, it always returns the same result.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 38,
    'endLine' => 78,
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
        'declaringClassName' => 'App\\Modules\\Detection\\DetectionManager',
        'implementingClassName' => 'App\\Modules\\Detection\\DetectionManager',
        'name' => 'registry',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Detection\\DetectorRegistry',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 41,
        'endLine' => 41,
        'startColumn' => 9,
        'endColumn' => 42,
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
                'name' => 'App\\Modules\\Detection\\DetectorRegistry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 41,
            'endLine' => 41,
            'startColumn' => 9,
            'endColumn' => 42,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 40,
        'endLine' => 43,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection',
        'declaringClassName' => 'App\\Modules\\Detection\\DetectionManager',
        'implementingClassName' => 'App\\Modules\\Detection\\DetectionManager',
        'currentClassName' => 'App\\Modules\\Detection\\DetectionManager',
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
            'startLine' => 60,
            'endLine' => 60,
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
            'name' => 'App\\Modules\\Detection\\DetectionResult',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Execute every registered detector and return the best result.
 *
 * All detectors run against the given context in registration order.
 * The result with the highest confidence is returned; ties are
 * resolved in favour of the first detector encountered. The returned
 * DetectionResult is never modified, and the given DetectionContext
 * is never changed.
 *
 * @param DetectionContext $context The immutable HTTP response context.
 *
 * @return DetectionResult The detection result with the highest confidence.
 *
 * @throws RuntimeException When no detector has been registered.
 */',
        'startLine' => 60,
        'endLine' => 77,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => true,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection',
        'declaringClassName' => 'App\\Modules\\Detection\\DetectionManager',
        'implementingClassName' => 'App\\Modules\\Detection\\DetectionManager',
        'currentClassName' => 'App\\Modules\\Detection\\DetectionManager',
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