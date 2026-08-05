<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\ThemeExtraction\ThemeExtractionManager.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\ThemeExtraction\ThemeExtractionManager
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-e89472dce9604cffde39e1661fb91441f59a64525cbbf55a8676baf8dfbd2343',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionManager',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/ThemeExtraction/ThemeExtractionManager.php',
      ),
    ),
    'namespace' => 'App\\Modules\\ThemeExtraction',
    'name' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionManager',
    'shortName' => 'ThemeExtractionManager',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Coordinates every registered Theme Extractor and returns the best
 * ThemeExtractionResult.
 *
 * The ThemeExtractionManager is the orchestration layer of the Theme
 * Extraction Engine. It executes every extractor registered in the
 * ThemeExtractorRegistry, compares their confidence scores, and returns
 * the ThemeExtractionResult with the highest confidence.
 *
 * Responsibilities:
 *
 * - Execute every registered theme extractor in the order it was provided.
 * - Compare extractor results and select the highest-confidence outcome.
 * - Throw a RuntimeException when no extractor has been registered.
 *
 * Design philosophy:
 *
 * - Manager: performs orchestration only.
 * - Orchestrator: it wires the registered extractors to the given
 *   context and nothing more.
 * - Single Responsibility Principle: the manager performs pure
 *   orchestration only. It does no HTTP requests, no style.css parsing,
 *   and no confidence calculation.
 * - Open/Closed Principle: it works exclusively with
 *   ThemeExtractorInterface and has no knowledge of any concrete
 *   platform (WordPress, Shopify, Ghost, Joomla, Drupal, TYPO3, etc.),
 *   so new extractors can be added without modifying the manager.
 * - Extractors are never reordered and never executed more than once. On
 *   equal confidence, the first extractor in registration order wins.
 * - The manager is stateless, deterministic, and side-effect free: given
 *   the same registry and context, it always returns the same result.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 43,
    'endLine' => 89,
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
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionManager',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionManager',
        'name' => 'registry',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\ThemeExtraction\\ThemeExtractorRegistry',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 50,
        'endLine' => 50,
        'startColumn' => 9,
        'endColumn' => 48,
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
                'name' => 'App\\Modules\\ThemeExtraction\\ThemeExtractorRegistry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 50,
            'endLine' => 50,
            'startColumn' => 9,
            'endColumn' => 48,
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
 * @param ThemeExtractorRegistry $registry The registry of registered
 *                                         theme extractors.
 */',
        'startLine' => 49,
        'endLine' => 52,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionManager',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionManager',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionManager',
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
            'startLine' => 71,
            'endLine' => 71,
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
 * Execute every registered theme extractor and return the best result.
 *
 * All extractors run against the given context in registration order.
 * The result with the highest confidence is returned; ties are
 * resolved in favour of the first extractor encountered. The returned
 * ThemeExtractionResult is never modified, and the given
 * DetectionContext is never changed.
 *
 * @param DetectionContext $context The immutable detection context
 *                                  containing the HTTP response data.
 *
 * @return ThemeExtractionResult The extraction result with the highest
 *                               confidence.
 *
 * @throws RuntimeException When no extractor has been registered.
 */',
        'startLine' => 71,
        'endLine' => 88,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => true,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionManager',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionManager',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionManager',
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