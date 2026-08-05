<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Http\Curl\NativeCurlAdapter.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Http\Curl\NativeCurlAdapter
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-2f4dfa47ce7119ecacb66ed79a1b5ea479fd34c776e729e205e3211279627843',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Http\\Curl\\NativeCurlAdapter',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Http/Curl/NativeCurlAdapter.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Http\\Curl',
    'name' => 'App\\Modules\\Http\\Curl\\NativeCurlAdapter',
    'shortName' => 'NativeCurlAdapter',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Production implementation of CurlAdapterInterface using PHP cURL.
 *
 * This class is the only component in the entire project allowed to call
 * native curl_*() functions. It performs the complete transport operation
 * and returns an immutable CurlResponse. It contains no HTTP response
 * parsing, no business logic, and no CMS knowledge.
 *
 * Responsibilities:
 *
 * - Validate the supplied URL before any network activity.
 * - Perform a single HTTP GET request via cURL with a fixed, safe option
 *   set.
 * - Collect the original URL, final URL, status code, header size, and
 *   response body of the raw cURL exchange.
 * - Split the raw cURL exchange into a raw header region and a body using
 *   CURLINFO_HEADER_SIZE.
 * - Return the exchange as an immutable CurlResponse.
 * - Throw HttpClientException on invalid URLs, cURL initialization,
 *   option, or execution failures.
 * - Always close the cURL handle via try/finally; never leak resources.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is a concrete transport
 *   implementation only. It performs no HTTP response parsing, no CMS
 *   detection, no theme extraction, and no plugin detection.
 * - All native curl_*() calls are isolated inside this class.
 * - The adapter is stateless and deterministic except for the network I/O
 *   inherent to performing a request.
 * - Public methods stay small and orchestration-focused; implementation
 *   details live in private helper methods.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 43,
    'endLine' => 154,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Modules\\Http\\Curl\\CurlAdapterInterface',
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
      'execute' => 
      array (
        'name' => 'execute',
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
            'startLine' => 57,
            'endLine' => 57,
            'startColumn' => 29,
            'endColumn' => 39,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'timeout' => 
          array (
            'name' => 'timeout',
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
            'startLine' => 57,
            'endLine' => 57,
            'startColumn' => 42,
            'endColumn' => 53,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'userAgent' => 
          array (
            'name' => 'userAgent',
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
            'startLine' => 57,
            'endLine' => 57,
            'startColumn' => 56,
            'endColumn' => 72,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
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
 * Execute a single HTTP GET request and return the raw exchange.
 *
 * @param string $url       The absolute URL to request.
 * @param int    $timeout   The total request timeout in seconds.
 * @param string $userAgent The user agent to send with the request.
 *
 * @return CurlResponse The immutable raw cURL exchange.
 *
 * @throws HttpClientException On invalid URL, cURL initialization,
 *                             option, or execution failure.
 */',
        'startLine' => 57,
        'endLine' => 82,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => true,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http\\Curl',
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\NativeCurlAdapter',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\NativeCurlAdapter',
        'currentClassName' => 'App\\Modules\\Http\\Curl\\NativeCurlAdapter',
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
            'startLine' => 91,
            'endLine' => 91,
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
        'startLine' => 91,
        'endLine' => 96,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => true,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Http\\Curl',
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\NativeCurlAdapter',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\NativeCurlAdapter',
        'currentClassName' => 'App\\Modules\\Http\\Curl\\NativeCurlAdapter',
        'aliasName' => NULL,
      ),
      'options' => 
      array (
        'name' => 'options',
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
            'startLine' => 107,
            'endLine' => 107,
            'startColumn' => 30,
            'endColumn' => 40,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'timeout' => 
          array (
            'name' => 'timeout',
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
            'startLine' => 107,
            'endLine' => 107,
            'startColumn' => 43,
            'endColumn' => 54,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'userAgent' => 
          array (
            'name' => 'userAgent',
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
            'startLine' => 107,
            'endLine' => 107,
            'startColumn' => 57,
            'endColumn' => 73,
            'parameterIndex' => 2,
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
 * Build the immutable set of cURL options for a GET request.
 *
 * The option set is fixed and safe: timeouts are bounded, redirects
 * are followed to a strict maximum, SSL verification is enabled, and
 * all supported content encodings are accepted.
 *
 * @return array<int, mixed>
 */',
        'startLine' => 107,
        'endLine' => 123,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Http\\Curl',
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\NativeCurlAdapter',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\NativeCurlAdapter',
        'currentClassName' => 'App\\Modules\\Http\\Curl\\NativeCurlAdapter',
        'aliasName' => NULL,
      ),
      'createResponse' => 
      array (
        'name' => 'createResponse',
        'parameters' => 
        array (
          'originalUrl' => 
          array (
            'name' => 'originalUrl',
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
            'startLine' => 140,
            'endLine' => 140,
            'startColumn' => 9,
            'endColumn' => 27,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'rawExchange' => 
          array (
            'name' => 'rawExchange',
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
            'startLine' => 141,
            'endLine' => 141,
            'startColumn' => 9,
            'endColumn' => 27,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'handle' => 
          array (
            'name' => 'handle',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'CurlHandle',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 142,
            'endLine' => 142,
            'startColumn' => 9,
            'endColumn' => 26,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
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
 * Build an immutable CurlResponse from a raw cURL exchange.
 *
 * The raw exchange is split at the cURL-reported header size: the
 * header region is stored verbatim and the remaining bytes form the
 * body. No parsing or transformation is applied; the raw header
 * string is returned exactly as received.
 *
 * @param string     $originalUrl The URL that was originally requested.
 * @param string     $rawExchange The raw cURL exchange (headers and body).
 * @param CurlHandle $handle      The active cURL handle providing response metadata.
 *
 * @return CurlResponse The immutable raw cURL exchange.
 */',
        'startLine' => 139,
        'endLine' => 153,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Http\\Curl',
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\NativeCurlAdapter',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\NativeCurlAdapter',
        'currentClassName' => 'App\\Modules\\Http\\Curl\\NativeCurlAdapter',
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