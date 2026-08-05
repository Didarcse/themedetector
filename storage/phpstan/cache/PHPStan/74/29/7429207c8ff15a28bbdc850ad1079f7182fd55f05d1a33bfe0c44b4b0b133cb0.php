<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\DetectorRegistry.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\DetectorRegistry
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-83a6a0fd633aebcb173820ffa4403cd2274c4bf1588c0f6d98262418a4be5970',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\DetectorRegistry',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/DetectorRegistry.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection',
    'name' => 'App\\Modules\\Detection\\DetectorRegistry',
    'shortName' => 'DetectorRegistry',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Provides a central registry for every CMS detector supported by the
 * Detection Engine.
 *
 * The registry is responsible only for registering and exposing detector
 * instances. It performs no detection, no orchestration, no confidence
 * calculation, and no HTTP requests.
 *
 * Responsibilities:
 *
 * - Store detector instances in the exact order they were provided.
 * - Expose every registered detector via the all() accessor.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: the registry has no business logic,
 *   no detection logic, no HTML parsing, no HTTP, no confidence
 *   calculation, and no metadata manipulation.
 * - Detectors are never reordered, filtered, or transformed. The all()
 *   accessor returns exactly what was supplied.
 * - The registry is stateless after construction, deterministic, and
 *   side-effect free.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 30,
    'endLine' => 86,
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
        'declaringClassName' => 'App\\Modules\\Detection\\DetectorRegistry',
        'implementingClassName' => 'App\\Modules\\Detection\\DetectorRegistry',
        'name' => 'detectors',
        'modifiers' => 132,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'default' => NULL,
        'docComment' => '/**
 * @var list<DetectorInterface>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 35,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 38,
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
          'detectors' => 
          array (
            'name' => 'detectors',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'iterable',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 41,
            'endLine' => 41,
            'startColumn' => 9,
            'endColumn' => 27,
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
 * @param iterable<DetectorInterface> $detectors The detectors to register.
 */',
        'startLine' => 40,
        'endLine' => 44,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection',
        'declaringClassName' => 'App\\Modules\\Detection\\DetectorRegistry',
        'implementingClassName' => 'App\\Modules\\Detection\\DetectorRegistry',
        'currentClassName' => 'App\\Modules\\Detection\\DetectorRegistry',
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
            'name' => 'iterable',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return every registered detector.
 *
 * Detectors are returned exactly as provided: no reordering, no
 * filtering, and no transformation.
 *
 * @return iterable<DetectorInterface>
 */',
        'startLine' => 54,
        'endLine' => 57,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection',
        'declaringClassName' => 'App\\Modules\\Detection\\DetectorRegistry',
        'implementingClassName' => 'App\\Modules\\Detection\\DetectorRegistry',
        'currentClassName' => 'App\\Modules\\Detection\\DetectorRegistry',
        'aliasName' => NULL,
      ),
      'count' => 
      array (
        'name' => 'count',
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
 * Return the number of registered detectors.
 *
 * @return int The number of registered detectors.
 */',
        'startLine' => 64,
        'endLine' => 67,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection',
        'declaringClassName' => 'App\\Modules\\Detection\\DetectorRegistry',
        'implementingClassName' => 'App\\Modules\\Detection\\DetectorRegistry',
        'currentClassName' => 'App\\Modules\\Detection\\DetectorRegistry',
        'aliasName' => NULL,
      ),
      'materialize' => 
      array (
        'name' => 'materialize',
        'parameters' => 
        array (
          'iterable' => 
          array (
            'name' => 'iterable',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'iterable',
                'isIdentifier' => true,
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
            'startColumn' => 34,
            'endColumn' => 51,
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
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Convert an iterable to a list, preserving insertion order.
 *
 * @param iterable<DetectorInterface> $iterable The iterable to materialize.
 *
 * @return list<DetectorInterface> The materialized detectors.
 */',
        'startLine' => 76,
        'endLine' => 85,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection',
        'declaringClassName' => 'App\\Modules\\Detection\\DetectorRegistry',
        'implementingClassName' => 'App\\Modules\\Detection\\DetectorRegistry',
        'currentClassName' => 'App\\Modules\\Detection\\DetectorRegistry',
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