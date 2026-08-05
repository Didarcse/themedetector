<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\ThemeExtraction\WordPress\WordPressThemeExtractorComponentTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\ThemeExtraction\WordPress\WordPressThemeExtractorComponentTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-2242d9828e26334594a6d8b6fded1a1c04aeb0316419ef9c5565bff453d62296',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/ThemeExtraction/WordPress/WordPressThemeExtractorComponentTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
    'name' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
    'shortName' => 'WordPressThemeExtractorComponentTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Component tests for the WordPressThemeExtractor orchestration.
 *
 * This suite is a Component Test, not a pure Unit Test: it executes the
 * complete WordPress theme extraction pipeline using the real
 * implementations of every collaborator. It verifies the collaboration
 * between
 *
 * - WordPressStyleCssLocator,
 * - WordPressStyleCssDownloader,
 * - WordPressStyleCssParser, and
 * - WordPressThemeMetadataMapper
 *
 * by exercising their real implementations through WordPressThemeExtractor
 * and observing the assembled ThemeExtractionResult.
 *
 * The pipeline delegates active theme stylesheet discovery to the locator,
 * stylesheet downloading to the downloader, raw metadata parsing to the
 * parser, and metadata normalization to the mapper, and it assembles the
 * resulting ThemeExtractionResult from their outputs. When the stylesheet
 * cannot be located or downloaded, the pipeline short-circuits into a
 * failed result without invoking any downstream collaborator.
 *
 * The four collaborators are exercised as real, deterministic objects;
 * they are final readonly classes and therefore cannot be doubled by
 * PHPUnit. The only mocked collaborator is the HttpClientInterface
 * injected into the real WordPressStyleCssDownloader. It represents the
 * external transport boundary and is the sole place where behaviour must
 * be controlled and invocation counts observed.
 *
 * The tests are component tests: behaviour-driven, fast, independent,
 * deterministic, and repeatable. They verify collaboration and
 * orchestration only; they never test the internals of the individual
 * collaborators, which are covered by their own dedicated test suites.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 54,
    'endLine' => 528,
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
      'STYLE_CSS_URL' => 
      array (
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'name' => 'STYLE_CSS_URL',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'https://example.com/wp-content/themes/astra/style.css\'',
          'attributes' => 
          array (
            'startLine' => 56,
            'endLine' => 56,
            'startTokenPos' => 92,
            'startFilePos' => 2475,
            'endTokenPos' => 92,
            'endFilePos' => 2529,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 56,
        'endLine' => 56,
        'startColumn' => 5,
        'endColumn' => 90,
      ),
      'STYLE_CSS_CONTENTS' => 
      array (
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'name' => 'STYLE_CSS_CONTENTS',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '"/*\\n" . "Theme Name: Astra\\n" . "Version: 1.0.0\\n" . "*/"',
          'attributes' => 
          array (
            'startLine' => 58,
            'endLine' => 61,
            'startTokenPos' => 103,
            'startFilePos' => 2572,
            'endTokenPos' => 115,
            'endFilePos' => 2653,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 58,
        'endLine' => 61,
        'startColumn' => 5,
        'endColumn' => 15,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'extractor' => 
      array (
        'name' => 'extractor',
        'parameters' => 
        array (
          'locator' => 
          array (
            'name' => 'locator',
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
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 78,
            'endLine' => 78,
            'startColumn' => 9,
            'endColumn' => 41,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'downloader' => 
          array (
            'name' => 'downloader',
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
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 79,
            'endLine' => 79,
            'startColumn' => 9,
            'endColumn' => 47,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'parser' => 
          array (
            'name' => 'parser',
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
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 80,
            'endLine' => 80,
            'startColumn' => 9,
            'endColumn' => 39,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
          'mapper' => 
          array (
            'name' => 'mapper',
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
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 81,
            'endLine' => 81,
            'startColumn' => 9,
            'endColumn' => 44,
            'parameterIndex' => 3,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Assemble the extractor under test from its four collaborators.
 *
 * @param WordPressStyleCssLocator      $locator    Discovers the active
 *                                                  theme style.css URL.
 * @param WordPressStyleCssDownloader   $downloader Downloads the style.css
 *                                                  contents.
 * @param WordPressStyleCssParser       $parser     Parses the raw theme
 *                                                  metadata.
 * @param WordPressThemeMetadataMapper  $mapper     Maps the raw theme
 *                                                  metadata.
 *
 * @return WordPressThemeExtractor The extractor under test.
 */',
        'startLine' => 77,
        'endLine' => 84,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'locator' => 
      array (
        'name' => 'locator',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create the real locator collaborator.
 *
 * @return WordPressStyleCssLocator A real, deterministic locator.
 */',
        'startLine' => 91,
        'endLine' => 94,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'downloader' => 
      array (
        'name' => 'downloader',
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
            'startLine' => 103,
            'endLine' => 103,
            'startColumn' => 33,
            'endColumn' => 59,
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
            'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloader',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create the real downloader collaborator backed by the given client.
 *
 * @param HttpClientInterface $client The HTTP client collaborator.
 *
 * @return WordPressStyleCssDownloader A real downloader over the client.
 */',
        'startLine' => 103,
        'endLine' => 106,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'parser' => 
      array (
        'name' => 'parser',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create the real parser collaborator.
 *
 * @return WordPressStyleCssParser A real, deterministic parser.
 */',
        'startLine' => 113,
        'endLine' => 116,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'mapper' => 
      array (
        'name' => 'mapper',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapper',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create the real mapper collaborator.
 *
 * @return WordPressThemeMetadataMapper A real, deterministic mapper.
 */',
        'startLine' => 123,
        'endLine' => 126,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
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
 * Create a detection context whose HTML locates the Astra stylesheet.
 *
 * @return DetectionContext The immutable detection context.
 */',
        'startLine' => 133,
        'endLine' => 136,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'contextForTheme' => 
      array (
        'name' => 'contextForTheme',
        'parameters' => 
        array (
          'theme' => 
          array (
            'name' => 'theme',
            'default' => NULL,
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
            'startLine' => 149,
            'endLine' => 149,
            'startColumn' => 38,
            'endColumn' => 50,
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
            'name' => 'App\\Modules\\Detection\\DetectionContext',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a detection context referencing the given theme directory.
 *
 * The HTML carries a root-relative reference to the theme style.css
 * that the real locator resolves against the final URL, producing a
 * stylesheet URL for the given theme directory.
 *
 * @param string $theme The theme directory name.
 *
 * @return DetectionContext The immutable detection context.
 */',
        'startLine' => 149,
        'endLine' => 160,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
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
        'startLine' => 170,
        'endLine' => 181,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'metadata' => 
      array (
        'name' => 'metadata',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\ThemeExtraction\\ThemeMetadata',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create the expected ThemeMetadata for the stylesheet under test.
 *
 * @return ThemeMetadata The expected normalized theme metadata.
 */',
        'startLine' => 188,
        'endLine' => 194,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
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
            'startLine' => 204,
            'endLine' => 204,
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
                'startLine' => 204,
                'endLine' => 204,
                'startTokenPos' => 513,
                'startFilePos' => 7486,
                'endTokenPos' => 513,
                'endFilePos' => 7496,
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
            'startLine' => 204,
            'endLine' => 204,
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
        'startLine' => 204,
        'endLine' => 213,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
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
        'startLine' => 221,
        'endLine' => 227,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'successExtractor' => 
      array (
        'name' => 'successExtractor',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeExtractor',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Assemble a fully wired extractor over a successful HTTP client.
 *
 * @return WordPressThemeExtractor The extractor under test.
 */',
        'startLine' => 234,
        'endLine' => 242,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'test_extract_returns_successful_result' => 
      array (
        'name' => 'test_extract_returns_successful_result',
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
 * Verify that the full pipeline produces a successful result.
 *
 * The locator discovers the stylesheet URL, the downloader fetches the
 * stylesheet contents, the parser extracts the raw metadata, the mapper
 * normalizes it, and the extractor assembles the ThemeExtractionResult.
 * The confidence assertion mirrors the production implementation, which
 * reports a fixed confidence of zero.
 */',
        'startLine' => 253,
        'endLine' => 266,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'test_returns_failed_result_when_locator_returns_null' => 
      array (
        'name' => 'test_returns_failed_result_when_locator_returns_null',
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
 * Verify that a null locator result yields a failed result.
 *
 * The downloader, parser, and mapper must never be invoked: the HTTP
 * client behind the real downloader is expected to receive no request,
 * and the failed result proves the pipeline short-circuited before any
 * downstream collaborator could run.
 */',
        'startLine' => 276,
        'endLine' => 288,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'test_returns_failed_result_when_downloader_returns_null' => 
      array (
        'name' => 'test_returns_failed_result_when_downloader_returns_null',
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
 * Verify that a null download result yields a failed result.
 *
 * The parser and mapper must never be invoked: the failed result
 * proves the pipeline short-circuited as soon as the download failed,
 * before parsing or mapping could run.
 */',
        'startLine' => 297,
        'endLine' => 309,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'test_successful_pipeline_discovers_stylesheet_url' => 
      array (
        'name' => 'test_successful_pipeline_discovers_stylesheet_url',
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
 * Verify that the successful pipeline discovers the stylesheet URL.
 *
 * The URL delivered to the downloader originates exclusively from the
 * real locator over the detection context HTML, so a single HTTP
 * request against that URL proves the locator discovered exactly one
 * stylesheet and the pipeline completed successfully.
 */',
        'startLine' => 319,
        'endLine' => 332,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'test_calls_downloader_once' => 
      array (
        'name' => 'test_calls_downloader_once',
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
 * Verify that the downloader performs exactly one download.
 *
 * The HTTP client behind the real downloader is the observable
 * transport boundary; it is expected to receive exactly one request for
 * the located stylesheet URL, proving the downloader was invoked
 * exactly once per extraction.
 */',
        'startLine' => 342,
        'endLine' => 355,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'test_successful_pipeline_parses_theme_metadata' => 
      array (
        'name' => 'test_successful_pipeline_parses_theme_metadata',
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
 * Verify that the successful pipeline parses the theme metadata.
 *
 * The theme name and version carried by the result are parsed by the
 * real parser from the downloaded stylesheet header, proving the raw
 * metadata was parsed during the successful pipeline run.
 */',
        'startLine' => 364,
        'endLine' => 372,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'test_successful_pipeline_maps_theme_metadata' => 
      array (
        'name' => 'test_successful_pipeline_maps_theme_metadata',
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
 * Verify that the successful pipeline maps the theme metadata.
 *
 * The ThemeMetadata carried by the result is the normalized output of
 * the real mapper over the raw parsed fields, proving the raw metadata
 * was mapped during the successful pipeline run.
 */',
        'startLine' => 381,
        'endLine' => 391,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'test_passes_detection_context_to_locator' => 
      array (
        'name' => 'test_passes_detection_context_to_locator',
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
 * Verify that the detection context is handed to the locator.
 *
 * A context referencing a distinct theme directory yields a download
 * of exactly that theme\'s stylesheet URL, proving the real locator
 * derived the URL from the given detection context rather than from a
 * fixed value.
 */',
        'startLine' => 401,
        'endLine' => 414,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'test_passes_style_css_url_to_downloader' => 
      array (
        'name' => 'test_passes_style_css_url_to_downloader',
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
 * Verify that the located stylesheet URL is passed to the downloader.
 *
 * The HTTP client behind the real downloader must be called with the
 * exact stylesheet URL discovered by the locator.
 */',
        'startLine' => 422,
        'endLine' => 433,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'test_passes_downloaded_css_to_parser' => 
      array (
        'name' => 'test_passes_downloaded_css_to_parser',
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
 * Verify that the downloaded stylesheet contents are passed to the parser.
 *
 * The theme name and version exposed by the result are derived only
 * from the downloaded stylesheet body, proving the parser received the
 * exact downloaded CSS.
 */',
        'startLine' => 442,
        'endLine' => 450,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'test_passes_raw_metadata_to_mapper' => 
      array (
        'name' => 'test_passes_raw_metadata_to_mapper',
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
 * Verify that the raw parsed metadata is passed to the mapper.
 *
 * The mapped ThemeMetadata carries exactly the fields declared in the
 * stylesheet header; fields absent from the header map to null or the
 * empty tags array, proving the raw metadata reached the mapper.
 */',
        'startLine' => 459,
        'endLine' => 479,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'test_returns_fixed_confidence' => 
      array (
        'name' => 'test_returns_fixed_confidence',
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
 * Verify that the extractor reports a fixed confidence.
 *
 * The production WordPressThemeExtractor owns no confidence logic and
 * reports a constant confidence of zero for both the successful and
 * the failed outcome; the assertions mirror that implementation.
 */',
        'startLine' => 488,
        'endLine' => 505,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'aliasName' => NULL,
      ),
      'test_extractor_is_deterministic' => 
      array (
        'name' => 'test_extractor_is_deterministic',
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
 * Verify that repeated extractions with identical behaviour are
 * deterministic.
 *
 * Calling extract() twice with the same extractor and the same
 * collaborator behaviour produces equivalent results in every
 * observable field.
 */',
        'startLine' => 515,
        'endLine' => 527,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeExtractorComponentTest',
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