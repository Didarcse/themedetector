<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Http\CurlHttpClient.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Http\CurlHttpClient
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-ab3b582f4f883e32db489cf733eb7ed3b2f15c7f3f582b8d8a777ed58f0bd0d5',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Http\\CurlHttpClient',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Http/CurlHttpClient.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Http',
    'name' => 'App\\Modules\\Http\\CurlHttpClient',
    'shortName' => 'CurlHttpClient',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Default HttpClientInterface implementation.
 *
 * Orchestrates the transport layer and converts transport responses into
 * immutable HttpResponse objects. CurlHttpClient contains no direct
 * interaction with PHP native cURL; all transport operations are
 * delegated to a CurlAdapterInterface.
 *
 * Responsibilities:
 *
 * - Validate the supplied URL before any network activity.
 * - Delegate the raw cURL exchange to a CurlAdapterInterface.
 * - Convert the raw CurlResponse into an immutable HttpResponse.
 * - Parse the final HTTP header block into a name-to-values map.
 * - Propagate HttpClientException raised by the adapter.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is a thin orchestration layer
 *   only. It performs no CMS detection, no HTML parsing, and contains no
 *   business logic.
 * - Dependency Inversion Principle: the client depends on the
 *   CurlAdapterInterface abstraction, never on the native cURL functions
 *   directly.
 * - The client is stateless and deterministic except for the network I/O
 *   inherent to performing a request.
 * - Public methods stay small and orchestration-focused; parsing logic
 *   lives in private helper methods.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 40,
    'endLine' => 175,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Modules\\Http\\HttpClientInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'adapter' => 
      array (
        'declaringClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'implementingClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'name' => 'adapter',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Http\\Curl\\CurlAdapterInterface',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 54,
        'endLine' => 54,
        'startColumn' => 9,
        'endColumn' => 45,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'timeout' => 
      array (
        'declaringClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'implementingClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'name' => 'timeout',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '15',
          'attributes' => 
          array (
            'startLine' => 55,
            'endLine' => 55,
            'startTokenPos' => 70,
            'startFilePos' => 2148,
            'endTokenPos' => 70,
            'endFilePos' => 2149,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 55,
        'endLine' => 55,
        'startColumn' => 9,
        'endColumn' => 33,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'userAgent' => 
      array (
        'declaringClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'implementingClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'name' => 'userAgent',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '\'ThemeDetectorTool/2.0\'',
          'attributes' => 
          array (
            'startLine' => 56,
            'endLine' => 56,
            'startTokenPos' => 81,
            'startFilePos' => 2188,
            'endTokenPos' => 81,
            'endFilePos' => 2210,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 56,
        'endLine' => 56,
        'startColumn' => 9,
        'endColumn' => 59,
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
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 54,
            'endLine' => 54,
            'startColumn' => 9,
            'endColumn' => 45,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'timeout' => 
          array (
            'name' => 'timeout',
            'default' => 
            array (
              'code' => '15',
              'attributes' => 
              array (
                'startLine' => 55,
                'endLine' => 55,
                'startTokenPos' => 70,
                'startFilePos' => 2148,
                'endTokenPos' => 70,
                'endFilePos' => 2149,
              ),
            ),
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
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 55,
            'endLine' => 55,
            'startColumn' => 9,
            'endColumn' => 33,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'userAgent' => 
          array (
            'name' => 'userAgent',
            'default' => 
            array (
              'code' => '\'ThemeDetectorTool/2.0\'',
              'attributes' => 
              array (
                'startLine' => 56,
                'endLine' => 56,
                'startTokenPos' => 81,
                'startFilePos' => 2188,
                'endTokenPos' => 81,
                'endFilePos' => 2210,
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
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 56,
            'endLine' => 56,
            'startColumn' => 9,
            'endColumn' => 59,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create an HTTP client backed by a CurlAdapterInterface.
 *
 * @param CurlAdapterInterface $adapter   The transport adapter that
 *                                        performs the raw cURL
 *                                        exchange.
 * @param int                  $timeout   The total request timeout in
 *                                        seconds.
 * @param string               $userAgent The user agent to send with
 *                                        the request.
 */',
        'startLine' => 53,
        'endLine' => 58,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'implementingClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'currentClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'aliasName' => NULL,
      ),
      'get' => 
      array (
        'name' => 'get',
        'parameters' => 
        array (
          'url' => 
          array (
            'name' => 'url',
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
            'startLine' => 70,
            'endLine' => 70,
            'startColumn' => 25,
            'endColumn' => 35,
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
            'name' => 'App\\Modules\\Http\\HttpResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Send an HTTP GET request and return the immutable response.
 *
 * @param string $url The absolute URL to request.
 *
 * @return HttpResponse The immutable HTTP response.
 *
 * @throws HttpClientException On invalid URL or transport-level
 *                             failure.
 */',
        'startLine' => 70,
        'endLine' => 81,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'implementingClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'currentClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'aliasName' => NULL,
      ),
      'validateUrl' => 
      array (
        'name' => 'validateUrl',
        'parameters' => 
        array (
          'url' => 
          array (
            'name' => 'url',
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
            'startLine' => 90,
            'endLine' => 90,
            'startColumn' => 34,
            'endColumn' => 44,
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
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Validate that a URL is an absolute, well-formed URL.
 *
 * @param string $url The URL to validate.
 *
 * @throws HttpClientException If the URL is malformed.
 */',
        'startLine' => 90,
        'endLine' => 95,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => true,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'implementingClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'currentClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'aliasName' => NULL,
      ),
      'createResponse' => 
      array (
        'name' => 'createResponse',
        'parameters' => 
        array (
          'response' => 
          array (
            'name' => 'response',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Http\\Curl\\CurlResponse',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 108,
            'endLine' => 108,
            'startColumn' => 37,
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
            'name' => 'App\\Modules\\Http\\HttpResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Build an immutable HttpResponse from a raw CurlResponse.
 *
 * Only the final HTTP header block is parsed: redirect headers are
 * ignored and intermediate header blocks are discarded rather than
 * merged.
 *
 * @param CurlResponse $response The immutable raw cURL exchange.
 *
 * @return HttpResponse The immutable HTTP response.
 */',
        'startLine' => 108,
        'endLine' => 117,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'implementingClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'currentClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'aliasName' => NULL,
      ),
      'parseHeaders' => 
      array (
        'name' => 'parseHeaders',
        'parameters' => 
        array (
          'rawHeaders' => 
          array (
            'name' => 'rawHeaders',
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
            'startLine' => 130,
            'endLine' => 130,
            'startColumn' => 35,
            'endColumn' => 52,
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
 * Parse a raw header block into a name-to-values map.
 *
 * Preserves duplicate header names as a list of values under a single
 * key and ignores malformed lines (empty lines and lines without a
 * colon separator).
 *
 * @param string $rawHeaders The raw final header block.
 *
 * @return array<string, list<string>>
 */',
        'startLine' => 130,
        'endLine' => 152,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'implementingClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'currentClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'aliasName' => NULL,
      ),
      'finalHeaderBlock' => 
      array (
        'name' => 'finalHeaderBlock',
        'parameters' => 
        array (
          'rawHeaders' => 
          array (
            'name' => 'rawHeaders',
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
            'startLine' => 165,
            'endLine' => 165,
            'startColumn' => 39,
            'endColumn' => 56,
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
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Extract the final header block from a raw header region.
 *
 * A raw header region may contain multiple blocks separated by blank
 * lines when redirects are followed. Only the last non-empty block —
 * the final response\'s headers — is returned.
 *
 * @param string $rawHeaders The raw header region.
 *
 * @return string The final header block.
 */',
        'startLine' => 165,
        'endLine' => 174,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'implementingClassName' => 'App\\Modules\\Http\\CurlHttpClient',
        'currentClassName' => 'App\\Modules\\Http\\CurlHttpClient',
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