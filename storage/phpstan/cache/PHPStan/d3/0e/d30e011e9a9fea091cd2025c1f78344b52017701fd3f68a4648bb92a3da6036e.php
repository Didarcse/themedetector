<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\ThemeExtraction\ThemeExtractor.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\ThemeExtraction\ThemeExtractor
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-bf5c11f6726cf481385c782cf25fd23fdc39e190260b18dd148fefc2c0ad50e5',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\ThemeExtraction\\ThemeExtractor',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/ThemeExtraction/ThemeExtractor.php',
      ),
    ),
    'namespace' => 'App\\Modules\\ThemeExtraction',
    'name' => 'App\\Modules\\ThemeExtraction\\ThemeExtractor',
    'shortName' => 'ThemeExtractor',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Public entry point for the Theme Extraction Engine.
 *
 * ThemeExtractor coordinates the complete theme extraction workflow: it
 * delegates extraction to the ThemeExtractionManager and returns the
 * resulting highest-confidence ThemeExtractionResult.
 *
 * ThemeExtractor is the only class external consumers should interact with
 * for theme extraction.
 *
 * Responsibilities:
 *
 * - Delegate extraction to the ThemeExtractionManager.
 * - Return the resulting ThemeExtractionResult.
 *
 * Design philosophy:
 *
 * - Facade: it is the single public entry point for the Theme Extraction
 *   Engine.
 * - Orchestrator: it wires the workflow steps together and nothing more.
 * - Dependency Injection: collaborators are provided through the
 *   constructor.
 * - Single Responsibility Principle: coordination only; it contains no
 *   business logic, no CMS or plugin detection, and no HTTP requests.
 * - Open/Closed Principle: new extractors are added without modifying this
 *   class.
 * - Stateless, deterministic, and side-effect free.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 37,
    'endLine' => 67,
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
      'manager' => 
      array (
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractor',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractor',
        'name' => 'manager',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionManager',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 46,
        'endLine' => 46,
        'startColumn' => 9,
        'endColumn' => 47,
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
          'manager' => 
          array (
            'name' => 'manager',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionManager',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 46,
            'endLine' => 46,
            'startColumn' => 9,
            'endColumn' => 47,
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
 * Create a new ThemeExtractor.
 *
 * @param ThemeExtractionManager $manager The ThemeExtractionManager that
 *                                        performs theme extraction.
 */',
        'startLine' => 45,
        'endLine' => 48,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractor',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractor',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractor',
        'aliasName' => NULL,
      ),
      'extract' => 
      array (
        'name' => 'extract',
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
            'startLine' => 63,
            'endLine' => 63,
            'startColumn' => 29,
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
            'name' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Extract the theme of the website represented by the given context.
 *
 * Delegates extraction to the ThemeExtractionManager and returns the
 * resulting ThemeExtractionResult. The returned result is never
 * modified, and the given DetectionContext is never changed.
 *
 * @param DetectionContext $context The immutable detection context
 *                                  containing the HTTP response data.
 *
 * @return ThemeExtractionResult The extraction result with the highest
 *                               confidence.
 */',
        'startLine' => 63,
        'endLine' => 66,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractor',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractor',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractor',
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