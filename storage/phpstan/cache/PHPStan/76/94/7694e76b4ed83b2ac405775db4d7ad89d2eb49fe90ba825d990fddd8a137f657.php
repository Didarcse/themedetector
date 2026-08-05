<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\ThemeExtraction\ThemeExtractorRegistry.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\ThemeExtraction\ThemeExtractorRegistry
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-5ae13c347785f1427265432eadae669b0d0f629c5f5865812998f605c0b8492f',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\ThemeExtraction\\ThemeExtractorRegistry',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/ThemeExtraction/ThemeExtractorRegistry.php',
      ),
    ),
    'namespace' => 'App\\Modules\\ThemeExtraction',
    'name' => 'App\\Modules\\ThemeExtraction\\ThemeExtractorRegistry',
    'shortName' => 'ThemeExtractorRegistry',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Provides a central registry for every Theme Extractor supported by the
 * Theme Extraction Engine.
 *
 * The registry is responsible only for registering and exposing extractor
 * instances. It performs no extraction, no orchestration, no confidence
 * calculation, and no HTTP requests.
 *
 * Responsibilities:
 *
 * - Store extractor instances in the exact order they were provided.
 * - Expose every registered extractor via the all() accessor.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: the registry has no business logic,
 *   no extraction logic, no HTML parsing, no HTTP, and no confidence
 *   calculation.
 * - Open/Closed Principle: it works exclusively with
 *   ThemeExtractorInterface and has no knowledge of any concrete
 *   platform (WordPress, Shopify, Ghost, Joomla, Drupal, TYPO3, etc.),
 *   so new extractors can be added without modifying the registry.
 * - Extractors are never reordered, filtered, or transformed. The all()
 *   accessor returns exactly what was supplied.
 * - The registry is stateless after construction, deterministic, and
 *   side-effect free.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 36,
    'endLine' => 84,
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
      'extractors' => 
      array (
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractorRegistry',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractorRegistry',
        'name' => 'extractors',
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
 * @var list<ThemeExtractorInterface>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 41,
        'endLine' => 41,
        'startColumn' => 5,
        'endColumn' => 39,
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
          'extractors' => 
          array (
            'name' => 'extractors',
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
            'startLine' => 48,
            'endLine' => 48,
            'startColumn' => 9,
            'endColumn' => 28,
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
 * @param iterable<ThemeExtractorInterface> $extractors The extractors
 *                                                      to register.
 */',
        'startLine' => 47,
        'endLine' => 51,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractorRegistry',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractorRegistry',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractorRegistry',
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
 * Return every registered theme extractor.
 *
 * Extractors are returned exactly as provided: no reordering, no
 * filtering, and no transformation.
 *
 * @return iterable<ThemeExtractorInterface>
 */',
        'startLine' => 61,
        'endLine' => 64,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractorRegistry',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractorRegistry',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractorRegistry',
        'aliasName' => NULL,
      ),
      'materialize' => 
      array (
        'name' => 'materialize',
        'parameters' => 
        array (
          'extractors' => 
          array (
            'name' => 'extractors',
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
            'startLine' => 74,
            'endLine' => 74,
            'startColumn' => 34,
            'endColumn' => 53,
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
 * @param iterable<ThemeExtractorInterface> $extractors The iterable to
 *                                                      materialize.
 *
 * @return list<ThemeExtractorInterface> The materialized extractors.
 */',
        'startLine' => 74,
        'endLine' => 83,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\ThemeExtraction',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractorRegistry',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractorRegistry',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractorRegistry',
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