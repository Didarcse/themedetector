<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\Http\CurlHttpClientTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\Http\CurlHttpClientTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-a8a07e01ed1e5c055e4c3c180e206ec9d4b94035765e5dba46ca8fc03f190b67',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/Http/CurlHttpClientTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\Http',
    'name' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
    'shortName' => 'CurlHttpClientTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Unit tests for the CurlHttpClient orchestration layer.
 *
 * Verifies that CurlHttpClient correctly orchestrates the HTTP transport
 * layer by collaborating with a mocked CurlAdapterInterface. The tests
 * are behaviour-driven and mock-based only: they never call curl_*(),
 * never use file://, never touch the network, and never inspect private
 * implementation details.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 25,
    'endLine' => 177,
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
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'name' => 'URL',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'https://example.com\'',
          'attributes' => 
          array (
            'startLine' => 27,
            'endLine' => 27,
            'startTokenPos' => 77,
            'startFilePos' => 854,
            'endTokenPos' => 77,
            'endFilePos' => 874,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 27,
        'endLine' => 27,
        'startColumn' => 5,
        'endColumn' => 46,
      ),
      'TIMEOUT' => 
      array (
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'name' => 'TIMEOUT',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '15',
          'attributes' => 
          array (
            'startLine' => 28,
            'endLine' => 28,
            'startTokenPos' => 88,
            'startFilePos' => 905,
            'endTokenPos' => 88,
            'endFilePos' => 906,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 28,
        'endLine' => 28,
        'startColumn' => 5,
        'endColumn' => 31,
      ),
      'USER_AGENT' => 
      array (
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'name' => 'USER_AGENT',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'ThemeDetectorTool/2.0\'',
          'attributes' => 
          array (
            'startLine' => 29,
            'endLine' => 29,
            'startTokenPos' => 99,
            'startFilePos' => 940,
            'endTokenPos' => 99,
            'endFilePos' => 962,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 29,
        'endLine' => 29,
        'startColumn' => 5,
        'endColumn' => 55,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'createAdapter' => 
      array (
        'name' => 'createAdapter',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionIntersectionType',
          'data' => 
          array (
            'types' => 
            array (
              0 => 
              array (
                'name' => 'App\\Modules\\Http\\Curl\\CurlAdapterInterface',
                'isIdentifier' => false,
              ),
              1 => 
              array (
                'name' => 'PHPUnit\\Framework\\MockObject\\MockObject',
                'isIdentifier' => false,
              ),
            ),
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a mock CurlAdapterInterface.
 *
 * @return CurlAdapterInterface&MockObject
 */',
        'startLine' => 36,
        'endLine' => 39,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\Http',
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'currentClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'aliasName' => NULL,
      ),
      'createCurlResponse' => 
      array (
        'name' => 'createCurlResponse',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Http\\Curl\\CurlResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a CurlResponse representing a raw transport exchange.
 */',
        'startLine' => 44,
        'endLine' => 57,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\Http',
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'currentClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'aliasName' => NULL,
      ),
      'makeClient' => 
      array (
        'name' => 'makeClient',
        'parameters' => 
        array (
          'adapter' => 
          array (
            'name' => 'adapter',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Http\\Curl\\CurlAdapterInterface',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 62,
            'endLine' => 62,
            'startColumn' => 33,
            'endColumn' => 61,
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
            'name' => 'App\\Modules\\Http\\CurlHttpClient',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a CurlHttpClient backed by the given adapter.
 */',
        'startLine' => 62,
        'endLine' => 65,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\Http',
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'currentClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'aliasName' => NULL,
      ),
      'test_implements_http_client_interface' => 
      array (
        'name' => 'test_implements_http_client_interface',
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
        'startLine' => 67,
        'endLine' => 70,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Http',
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'currentClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'aliasName' => NULL,
      ),
      'test_throws_exception_for_invalid_url' => 
      array (
        'name' => 'test_throws_exception_for_invalid_url',
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
        'startLine' => 72,
        'endLine' => 81,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Http',
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'currentClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'aliasName' => NULL,
      ),
      'test_delegates_request_to_adapter' => 
      array (
        'name' => 'test_delegates_request_to_adapter',
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
        'startLine' => 83,
        'endLine' => 92,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Http',
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'currentClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'aliasName' => NULL,
      ),
      'test_returns_http_response' => 
      array (
        'name' => 'test_returns_http_response',
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
        'startLine' => 94,
        'endLine' => 102,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Http',
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'currentClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'aliasName' => NULL,
      ),
      'test_copies_original_url' => 
      array (
        'name' => 'test_copies_original_url',
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
        'startLine' => 104,
        'endLine' => 112,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Http',
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'currentClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'aliasName' => NULL,
      ),
      'test_copies_final_url' => 
      array (
        'name' => 'test_copies_final_url',
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
        'startLine' => 114,
        'endLine' => 122,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Http',
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'currentClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'aliasName' => NULL,
      ),
      'test_copies_status_code' => 
      array (
        'name' => 'test_copies_status_code',
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
        'startLine' => 124,
        'endLine' => 132,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Http',
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'currentClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'aliasName' => NULL,
      ),
      'test_copies_body' => 
      array (
        'name' => 'test_copies_body',
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
        'startLine' => 134,
        'endLine' => 142,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Http',
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'currentClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'aliasName' => NULL,
      ),
      'test_parses_headers' => 
      array (
        'name' => 'test_parses_headers',
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
        'startLine' => 144,
        'endLine' => 153,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Http',
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'currentClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'aliasName' => NULL,
      ),
      'test_preserves_duplicate_headers' => 
      array (
        'name' => 'test_preserves_duplicate_headers',
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
        'startLine' => 155,
        'endLine' => 163,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Http',
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'currentClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'aliasName' => NULL,
      ),
      'test_propagates_adapter_exception' => 
      array (
        'name' => 'test_propagates_adapter_exception',
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
        'startLine' => 165,
        'endLine' => 176,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Http',
        'declaringClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'implementingClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
        'currentClassName' => 'Tests\\Unit\\Http\\CurlHttpClientTest',
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