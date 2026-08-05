<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\ThemeExtraction\WordPress\WordPressThemeExtractor.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\ThemeExtraction\WordPress\WordPressThemeExtractor
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-3d3b43c482ba338005243e88ac9fd5781cf8992cc10152ef32e6b08f607be65d',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/ThemeExtraction/WordPress/WordPressThemeExtractor.php',
      ),
    ),
    'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
    'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
    'shortName' => 'WordPressThemeExtractor',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Orchestrates the complete WordPress theme extraction workflow.
 *
 * WordPressThemeExtractor is the orchestration layer of the WordPress
 * theme extraction pipeline. It coordinates a fixed sequence of dedicated
 * collaborators — discovering the active theme stylesheet from the HTML,
 * downloading it, parsing its header, and mapping the raw metadata — and
 * assembles the resulting ThemeExtractionResult from their outputs. It is
 * a thin facade: it performs no work itself other than delegating each
 * step and wiring the results together.
 *
 * Pipeline:
 *
 * DetectionContext
 *   ↓
 * WordPressStyleCssLocator
 *   ↓
 * style.css URL
 *   ↓
 * WordPressStyleCssDownloader
 *   ↓
 * style.css contents
 *   ↓
 * WordPressStyleCssParser
 *   ↓
 * RawWordPressThemeMetadata
 *   ↓
 * WordPressThemeMetadataMapper
 *   ↓
 * ThemeMetadata
 *   ↓
 * ThemeExtractionResult
 *
 * Responsibilities:
 *
 * - Delegate active theme stylesheet discovery to
 *   WordPressStyleCssLocator.
 * - Delegate style.css downloading to WordPressStyleCssDownloader.
 * - Delegate raw metadata parsing to WordPressStyleCssParser.
 * - Delegate metadata normalization to WordPressThemeMetadataMapper.
 * - Assemble and return the resulting ThemeExtractionResult.
 * - Return a failed ThemeExtractionResult when the style.css cannot be
 *   located or downloaded.
 *
 * Design philosophy:
 *
 * - Facade: WordPressThemeExtractor is the single public entry point for
 *   WordPress theme extraction.
 * - Orchestrator: it wires the workflow steps together and nothing more.
 * - Single Responsibility Principle: orchestration only. It never parses
 *   CSS, never performs HTTP requests, never inspects HTML, never
 *   calculates confidence, and never contains WordPress business rules.
 * - Dependency Injection: every collaborator is provided through the
 *   constructor, making the pipeline fully testable and interchangeable.
 * - Open/Closed Principle: collaborator behavior can evolve without
 *   modifying this class, and new workflow steps are introduced by new
 *   collaborators.
 * - Stateless, deterministic, and side-effect free: given the same
 *   DetectionContext, it always produces the same ThemeExtractionResult,
 *   and its only observable effects are the delegated collaborator calls.
 *
 * The class contains no regular expressions, no CSS parsing, no HTTP
 * requests, no HTML inspection, no WordPress detection logic, no
 * confidence calculation, and no business rules.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 76,
    'endLine' => 172,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Modules\\ThemeExtraction\\Contracts\\ThemeExtractorInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'styleCssLocator' => 
      array (
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'name' => 'styleCssLocator',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 96,
        'endLine' => 96,
        'startColumn' => 9,
        'endColumn' => 57,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'styleCssDownloader' => 
      array (
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'name' => 'styleCssDownloader',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloader',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 97,
        'endLine' => 97,
        'startColumn' => 9,
        'endColumn' => 63,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'styleCssParser' => 
      array (
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'name' => 'styleCssParser',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 98,
        'endLine' => 98,
        'startColumn' => 9,
        'endColumn' => 55,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'metadataMapper' => 
      array (
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'name' => 'metadataMapper',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapper',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 99,
        'endLine' => 99,
        'startColumn' => 9,
        'endColumn' => 60,
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
          'styleCssLocator' => 
          array (
            'name' => 'styleCssLocator',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 96,
            'endLine' => 96,
            'startColumn' => 9,
            'endColumn' => 57,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'styleCssDownloader' => 
          array (
            'name' => 'styleCssDownloader',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloader',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 97,
            'endLine' => 97,
            'startColumn' => 9,
            'endColumn' => 63,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'styleCssParser' => 
          array (
            'name' => 'styleCssParser',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 98,
            'endLine' => 98,
            'startColumn' => 9,
            'endColumn' => 55,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
          'metadataMapper' => 
          array (
            'name' => 'metadataMapper',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapper',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 99,
            'endLine' => 99,
            'startColumn' => 9,
            'endColumn' => 60,
            'parameterIndex' => 3,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a new WordPressThemeExtractor.
 *
 * @param WordPressStyleCssLocator      $styleCssLocator      Discovers the
 *                                                            active theme style.css URL
 *                                                            from the HTML inside the
 *                                                            detection context.
 * @param WordPressStyleCssDownloader   $styleCssDownloader   Downloads the style.css
 *                                                            contents from the located
 *                                                            URL.
 * @param WordPressStyleCssParser       $styleCssParser       Parses the raw theme
 *                                                            metadata from the style.css
 *                                                            contents.
 * @param WordPressThemeMetadataMapper  $metadataMapper       Maps the raw theme metadata
 *                                                            to a normalized
 *                                                            ThemeMetadata.
 */',
        'startLine' => 95,
        'endLine' => 101,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
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
            'startLine' => 130,
            'endLine' => 130,
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
 * Extract WordPress theme metadata from the given detection context.
 *
 * Coordinates the dedicated collaborators in order and returns the
 * assembled result:
 *
 * - Discover the active theme style.css URL from the detection
 *   context HTML.
 * - Download the style.css contents from the located URL.
 * - Parse the raw theme metadata from the style.css contents.
 * - Map the raw metadata to a normalized ThemeMetadata.
 * - Assemble the resulting ThemeExtractionResult.
 *
 * When the style.css cannot be located or downloaded, a failed
 * ThemeExtractionResult is returned. For the MVP, the confidence is
 * always zero; confidence scoring is intentionally deferred to future
 * extraction rules and scoring logic. The given DetectionContext is
 * never modified.
 *
 * @param DetectionContext $context The immutable detection context
 *                                  containing the HTTP response data.
 *
 * @return ThemeExtractionResult The extracted WordPress theme metadata
 *                               result, or a failed result when the
 *                               style.css could not be located or
 *                               downloaded.
 */',
        'startLine' => 130,
        'endLine' => 152,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'aliasName' => NULL,
      ),
      'notExtracted' => 
      array (
        'name' => 'notExtracted',
        'parameters' => 
        array (
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
 * Return a ThemeExtractionResult representing a failed extraction.
 *
 * Used when the style.css cannot be located or downloaded, so that a
 * deterministic result is always produced. The confidence is zero,
 * consistent with the MVP scope in which this class owns no confidence
 * values.
 *
 * @return ThemeExtractionResult The failed extraction result.
 */',
        'startLine' => 164,
        'endLine' => 171,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
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