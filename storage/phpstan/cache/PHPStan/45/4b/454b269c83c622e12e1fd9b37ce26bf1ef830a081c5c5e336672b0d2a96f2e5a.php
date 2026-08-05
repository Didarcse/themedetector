<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Integration\ThemeExtraction\ThemeExtractionIntegrationTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Integration\ThemeExtraction\ThemeExtractionIntegrationTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-d2b5f763b801c557186afdc98880d4b674e16c6c44492e92a8eb24142c0d2509',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Integration/ThemeExtraction/ThemeExtractionIntegrationTest.php',
      ),
    ),
    'namespace' => 'Tests\\Integration\\ThemeExtraction',
    'name' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
    'shortName' => 'ThemeExtractionIntegrationTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Integration tests for the complete Theme Extraction pipeline.
 *
 * This is the highest-level automated test for the Theme Extraction
 * Engine. It verifies that every production component works together
 * correctly by running the full pipeline end-to-end through the public
 * ThemeExtractor facade:
 *
 * DetectionContext
 *   ↓
 * ThemeExtractor
 *   ↓
 * ThemeExtractionManager
 *   ↓
 * ThemeExtractorRegistry
 *   ↓
 * WordPressThemeExtractor
 *   ↓
 * WordPressStyleCssLocator
 *   ↓
 * WordPressStyleCssDownloader
 *   ↓
 * WordPressStyleCssParser
 *   ↓
 * WordPressThemeMetadataMapper
 *   ↓
 * ThemeMetadata
 *   ↓
 * ThemeExtractionResult
 *
 * Every collaborator is a real production object: the real ThemeExtractor
 * facade, ThemeExtractionManager, ThemeExtractorRegistry,
 * WordPressThemeExtractor, WordPressStyleCssLocator,
 * WordPressStyleCssDownloader, WordPressStyleCssParser, and
 * WordPressThemeMetadataMapper. The only mocked collaborator is the
 * HttpClientInterface injected into the real downloader; it represents
 * the external transport boundary and prevents all network I/O.
 *
 * The tests are integration tests: fast, deterministic, and repeatable.
 * They validate the collaboration between all production components and
 * never inspect implementation details — only externally observable
 * behaviour is asserted.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 64,
    'endLine' => 272,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'PHPUnit\\Framework\\TestCase',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'URL' => 
      array (
        'declaringClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'name' => 'URL',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'https://example.com\'',
          'attributes' => 
          array (
            'startLine' => 66,
            'endLine' => 66,
            'startTokenPos' => 102,
            'startFilePos' => 2266,
            'endTokenPos' => 102,
            'endFilePos' => 2286,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 66,
        'endLine' => 66,
        'startColumn' => 5,
        'endColumn' => 46,
      ),
      'STYLE_CSS_URL' => 
      array (
        'declaringClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'name' => 'STYLE_CSS_URL',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'https://example.com/wp-content/themes/astra/style.css\'',
          'attributes' => 
          array (
            'startLine' => 68,
            'endLine' => 68,
            'startTokenPos' => 113,
            'startFilePos' => 2324,
            'endTokenPos' => 113,
            'endFilePos' => 2378,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 68,
        'endLine' => 68,
        'startColumn' => 5,
        'endColumn' => 90,
      ),
      'STYLE_CSS_CONTENTS' => 
      array (
        'declaringClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'name' => 'STYLE_CSS_CONTENTS',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '"/*\\n" . "Theme Name: Astra\\n" . "Version: 1.0.0\\n" . "*/"',
          'attributes' => 
          array (
            'startLine' => 70,
            'endLine' => 73,
            'startTokenPos' => 124,
            'startFilePos' => 2421,
            'endTokenPos' => 136,
            'endFilePos' => 2502,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 70,
        'endLine' => 73,
        'startColumn' => 5,
        'endColumn' => 15,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'context' => 
      array (
        'name' => 'context',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Detection\\DetectionContext',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a detection context whose HTML locates the theme stylesheet.
 *
 * The HTML carries a root-relative reference to the theme style.css
 * that the real locator resolves against the final URL into the
 * STYLE_CSS_URL constant.
 *
 * @return DetectionContext The immutable detection context.
 */',
        'startLine' => 84,
        'endLine' => 95,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Integration\\ThemeExtraction',
        'declaringClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'aliasName' => NULL,
      ),
      'contextWithoutThemeStylesheet' => 
      array (
        'name' => 'contextWithoutThemeStylesheet',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Detection\\DetectionContext',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a detection context with no theme stylesheet present.
 *
 * The stylesheet reference does not live under /wp-content/themes/,
 * so the real locator returns null for this context.
 *
 * @return DetectionContext The immutable detection context.
 */',
        'startLine' => 105,
        'endLine' => 116,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Integration\\ThemeExtraction',
        'declaringClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'aliasName' => NULL,
      ),
      'extractor' => 
      array (
        'name' => 'extractor',
        'parameters' => 
        array (
          'client' => 
          array (
            'name' => 'client',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Http\\HttpClientInterface',
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
            'startColumn' => 32,
            'endColumn' => 58,
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
            'name' => 'App\\Modules\\ThemeExtraction\\ThemeExtractor',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Assemble the complete real Theme Extraction pipeline.
 *
 * Wires the real ThemeExtractor facade, ThemeExtractionManager,
 * ThemeExtractorRegistry, WordPressThemeExtractor, locator, downloader,
 * parser, and mapper together. The only mock is the given
 * HttpClientInterface injected into the real downloader.
 *
 * @param HttpClientInterface $client The mocked transport boundary.
 *
 * @return ThemeExtractor The fully wired pipeline entry point.
 */',
        'startLine' => 130,
        'endLine' => 144,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Integration\\ThemeExtraction',
        'declaringClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'aliasName' => NULL,
      ),
      'response' => 
      array (
        'name' => 'response',
        'parameters' => 
        array (
          'statusCode' => 
          array (
            'name' => 'statusCode',
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
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 154,
            'endLine' => 154,
            'startColumn' => 31,
            'endColumn' => 45,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'body' => 
          array (
            'name' => 'body',
            'default' => 
            array (
              'code' => '\'not found\'',
              'attributes' => 
              array (
                'startLine' => 154,
                'endLine' => 154,
                'startTokenPos' => 389,
                'startFilePos' => 5329,
                'endTokenPos' => 389,
                'endFilePos' => 5339,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 154,
            'endLine' => 154,
            'startColumn' => 48,
            'endColumn' => 73,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Http\\HttpResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create an HTTP response for the stylesheet under test.
 *
 * @param int    $statusCode The HTTP status code.
 * @param string $body       The response body.
 *
 * @return HttpResponse The immutable HTTP response.
 */',
        'startLine' => 154,
        'endLine' => 163,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Integration\\ThemeExtraction',
        'declaringClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'aliasName' => NULL,
      ),
      'successfulClient' => 
      array (
        'name' => 'successfulClient',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Http\\HttpClientInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create an HTTP client mock that serves the stylesheet contents.
 *
 * @return HttpClientInterface A mock HTTP client returning the stylesheet
 *                             contents for any request.
 */',
        'startLine' => 171,
        'endLine' => 177,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Integration\\ThemeExtraction',
        'declaringClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'aliasName' => NULL,
      ),
      'test_extracts_wordpress_theme_successfully' => 
      array (
        'name' => 'test_extracts_wordpress_theme_successfully',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Verify that the complete pipeline extracts a WordPress theme.
 *
 * The real locator discovers the stylesheet URL from the context HTML,
 * the real downloader fetches the stylesheet contents through the
 * mocked transport, the real parser extracts the raw metadata, and the
 * real mapper produces the normalized ThemeMetadata. The confidence
 * assertion mirrors the production WordPressThemeExtractor, which
 * reports a fixed confidence of zero.
 */',
        'startLine' => 189,
        'endLine' => 207,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\ThemeExtraction',
        'declaringClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'aliasName' => NULL,
      ),
      'test_returns_failed_result_when_stylesheet_is_missing' => 
      array (
        'name' => 'test_returns_failed_result_when_stylesheet_is_missing',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Verify that a missing theme stylesheet yields a failed result.
 *
 * When the real locator cannot discover a theme stylesheet, the
 * pipeline short-circuits before the downloader: the mocked transport
 * boundary is expected to receive no request, and the result is a
 * failed ThemeExtractionResult.
 */',
        'startLine' => 217,
        'endLine' => 227,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\ThemeExtraction',
        'declaringClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'aliasName' => NULL,
      ),
      'test_returns_failed_result_when_stylesheet_download_fails' => 
      array (
        'name' => 'test_returns_failed_result_when_stylesheet_download_fails',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Verify that a failed stylesheet download yields a failed result.
 *
 * When the mocked transport boundary returns a non-200 response, the
 * real downloader returns null and the pipeline short-circuits into a
 * failed ThemeExtractionResult before parsing or mapping.
 */',
        'startLine' => 236,
        'endLine' => 246,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\ThemeExtraction',
        'declaringClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'aliasName' => NULL,
      ),
      'test_pipeline_is_deterministic' => 
      array (
        'name' => 'test_pipeline_is_deterministic',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Verify that the complete pipeline is deterministic.
 *
 * Extracting twice with the same pipeline and the same detection
 * context produces equivalent results in every observable field.
 */',
        'startLine' => 254,
        'endLine' => 271,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\ThemeExtraction',
        'declaringClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\ThemeExtraction\\ThemeExtractionIntegrationTest',
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