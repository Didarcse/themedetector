<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\ThemeExtraction\Contracts\ThemeExtractorInterface.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\ThemeExtraction\Contracts\ThemeExtractorInterface
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-612dfc11828f74d62adc2d4ef0f5492d35c9127b4bee721fb53113f5c35b434e',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\ThemeExtraction\\Contracts\\ThemeExtractorInterface',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/ThemeExtraction/Contracts/ThemeExtractorInterface.php',
      ),
    ),
    'namespace' => 'App\\Modules\\ThemeExtraction\\Contracts',
    'name' => 'App\\Modules\\ThemeExtraction\\Contracts\\ThemeExtractorInterface',
    'shortName' => 'ThemeExtractorInterface',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Contract for every Theme Extractor implementation.
 *
 * A Theme Extractor is responsible for extracting theme metadata from a
 * website after the CMS has already been detected. Theme extractors never
 * detect the CMS themselves; they consume the immutable detection context
 * produced by the Detection Engine and return a structured
 * ThemeExtractionResult.
 *
 * Responsibilities:
 *
 * - Extract theme metadata from the given detection context.
 * - Return the extracted theme information as a ThemeExtractionResult.
 *
 * Design philosophy:
 *
 * - Contract: consumers depend on this abstraction rather than on a
 *   concrete extractor.
 * - Dependency Injection and Open/Closed Principle: new extractors are
 *   introduced by implementing this interface without modifying existing
 *   code.
 * - Single Responsibility Principle: extractors perform theme extraction
 *   only. They never detect CMS, never perform HTTP requests, never
 *   calculate confidence, and never perform plugin detection.
 * - Stateless, deterministic, and side-effect free.
 *
 * Supported implementations:
 *
 * - WordPressThemeExtractor, ShopifyThemeExtractor, GhostThemeExtractor,
 *   JoomlaThemeExtractor, DrupalThemeExtractor, TYPO3ThemeExtractor,
 *   WebflowThemeExtractor, WixThemeExtractor, MagentoThemeExtractor, and
 *   future extractors.
 *
 * The interface knows nothing about SEO, Security, Performance, or
 * Website Intelligence.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 46,
    'endLine' => 61,
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
            'startLine' => 60,
            'endLine' => 60,
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
 * Extract theme metadata from the given detection context.
 *
 * The context carries the immutable HTTP response data collected by
 * the Detection Engine. Extractors translate that data into theme
 * information and perform no additional HTTP requests of their own.
 *
 * @param DetectionContext $context The immutable detection context
 *                                  containing the HTTP response data.
 *
 * @return ThemeExtractionResult The extracted theme metadata result.
 */',
        'startLine' => 60,
        'endLine' => 60,
        'startColumn' => 5,
        'endColumn' => 78,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction\\Contracts',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\Contracts\\ThemeExtractorInterface',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\Contracts\\ThemeExtractorInterface',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\Contracts\\ThemeExtractorInterface',
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