<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\ThemeExtraction\WordPress\WordPressStyleCssDownloaderTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\ThemeExtraction\WordPress\WordPressStyleCssDownloaderTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-b54cfea8e725d405bcc5a843522beadf6f0b7927510da5c3a468f31fbb189f07',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/ThemeExtraction/WordPress/WordPressStyleCssDownloaderTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
    'name' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
    'shortName' => 'WordPressStyleCssDownloaderTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Unit tests for the WordPressStyleCssDownloader.
 *
 * Verifies the complete public contract of the downloader: a successful
 * HTTP 200 response yields the response body, non-200 responses yield
 * null, transport exceptions are converted into null, the supplied URL is
 * passed to the HTTP client exactly once per call, and repeated calls are
 * deterministic.
 *
 * The tests are behaviour-driven and use mocks only for the
 * HttpClientInterface collaborator; the real WordPressStyleCssDownloader
 * is exercised, and no real HTTP request is ever performed.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 26,
    'endLine' => 134,
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
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'name' => 'URL',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'https://example.com/wp-content/themes/twentytwentyfive/style.css\'',
          'attributes' => 
          array (
            'startLine' => 28,
            'endLine' => 28,
            'startTokenPos' => 62,
            'startFilePos' => 959,
            'endTokenPos' => 62,
            'endFilePos' => 1024,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 28,
        'endLine' => 28,
        'startColumn' => 5,
        'endColumn' => 91,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
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
            'startLine' => 37,
            'endLine' => 37,
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
 * Create a downloader backed by the given HTTP client.
 *
 * @param HttpClientInterface $client The HTTP client collaborator.
 *
 * @return WordPressStyleCssDownloader The downloader under test.
 */',
        'startLine' => 37,
        'endLine' => 40,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
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
            'startLine' => 50,
            'endLine' => 50,
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
              'code' => '\'body\'',
              'attributes' => 
              array (
                'startLine' => 50,
                'endLine' => 50,
                'startTokenPos' => 114,
                'startFilePos' => 1738,
                'endTokenPos' => 114,
                'endFilePos' => 1743,
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
            'startLine' => 50,
            'endLine' => 50,
            'startColumn' => 48,
            'endColumn' => 68,
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
 * Create an immutable HTTP response for the given status and body.
 *
 * @param int    $statusCode The HTTP status code.
 * @param string $body       The response body.
 *
 * @return HttpResponse The HTTP response.
 */',
        'startLine' => 50,
        'endLine' => 59,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'aliasName' => NULL,
      ),
      'test_returns_response_body_for_http_200' => 
      array (
        'name' => 'test_returns_response_body_for_http_200',
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
        'docComment' => NULL,
        'startLine' => 61,
        'endLine' => 69,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'aliasName' => NULL,
      ),
      'test_returns_null_for_http_404' => 
      array (
        'name' => 'test_returns_null_for_http_404',
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
        'docComment' => NULL,
        'startLine' => 71,
        'endLine' => 79,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'aliasName' => NULL,
      ),
      'test_returns_null_for_http_500' => 
      array (
        'name' => 'test_returns_null_for_http_500',
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
        'docComment' => NULL,
        'startLine' => 81,
        'endLine' => 89,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'aliasName' => NULL,
      ),
      'test_returns_null_when_http_client_throws_http_exception' => 
      array (
        'name' => 'test_returns_null_when_http_client_throws_http_exception',
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
        'docComment' => NULL,
        'startLine' => 91,
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'aliasName' => NULL,
      ),
      'test_passes_url_to_http_client' => 
      array (
        'name' => 'test_passes_url_to_http_client',
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
        'docComment' => NULL,
        'startLine' => 101,
        'endLine' => 110,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'aliasName' => NULL,
      ),
      'test_performs_exactly_one_http_request' => 
      array (
        'name' => 'test_performs_exactly_one_http_request',
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
        'docComment' => NULL,
        'startLine' => 112,
        'endLine' => 120,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'aliasName' => NULL,
      ),
      'test_download_is_deterministic' => 
      array (
        'name' => 'test_download_is_deterministic',
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
        'docComment' => NULL,
        'startLine' => 122,
        'endLine' => 133,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloaderTest',
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