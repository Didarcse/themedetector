<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Http\Curl\CurlResponse.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Http\Curl\CurlResponse
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-c7146b541ae111e09e1581e49232ca56fa2a7ce6084cb2f9d50751c3e330a0c9',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Http/Curl/CurlResponse.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Http\\Curl',
    'name' => 'App\\Modules\\Http\\Curl\\CurlResponse',
    'shortName' => 'CurlResponse',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Immutable raw transport result returned by a CurlAdapterInterface
 * implementation.
 *
 * Contains only transport-layer data produced by the native cURL adapter.
 * CurlHttpClient converts this object into an HttpResponse.
 *
 * Responsibilities:
 *
 * - Store the original and final URLs, status code, raw header region,
 *   and body of a raw cURL exchange.
 * - Expose the stored transport data through immutable read-only
 *   accessors.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is a pure Value Object. It
 *   represents the raw transport layer only and performs no parsing, no
 *   validation, no normalization, and no transformation.
 * - The object is immutable, stateless, deterministic, and side-effect
 *   free. Once constructed, its state cannot be altered.
 * - It knows nothing about HttpResponse, detection, theme extraction,
 *   plugin detection, or any concrete technology (WordPress, Joomla,
 *   Drupal, Ghost, TYPO3, etc.).
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 32,
    'endLine' => 100,
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
      'originalUrl' => 
      array (
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'name' => 'originalUrl',
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
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 48,
        'endLine' => 48,
        'startColumn' => 9,
        'endColumn' => 35,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'finalUrl' => 
      array (
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'name' => 'finalUrl',
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
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 49,
        'endLine' => 49,
        'startColumn' => 9,
        'endColumn' => 32,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'statusCode' => 
      array (
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'name' => 'statusCode',
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
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 50,
        'endLine' => 50,
        'startColumn' => 9,
        'endColumn' => 31,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'rawHeaders' => 
      array (
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'name' => 'rawHeaders',
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
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 51,
        'endLine' => 51,
        'startColumn' => 9,
        'endColumn' => 34,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'body' => 
      array (
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'name' => 'body',
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
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 52,
        'endLine' => 52,
        'startColumn' => 9,
        'endColumn' => 28,
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
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 48,
            'endLine' => 48,
            'startColumn' => 9,
            'endColumn' => 35,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'finalUrl' => 
          array (
            'name' => 'finalUrl',
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
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 49,
            'endLine' => 49,
            'startColumn' => 9,
            'endColumn' => 32,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
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
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 50,
            'endLine' => 50,
            'startColumn' => 9,
            'endColumn' => 31,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
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
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 51,
            'endLine' => 51,
            'startColumn' => 9,
            'endColumn' => 34,
            'parameterIndex' => 3,
            'isOptional' => false,
          ),
          'body' => 
          array (
            'name' => 'body',
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
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 52,
            'endLine' => 52,
            'startColumn' => 9,
            'endColumn' => 28,
            'parameterIndex' => 4,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a raw transport-layer response value object.
 *
 * @param string $originalUrl The URL that was originally requested.
 * @param string $finalUrl    The URL of the final response after any
 *                            redirects.
 * @param int    $statusCode  The HTTP status code of the final
 *                            response.
 * @param string $rawHeaders  The raw header region of the cURL
 *                            exchange, verbatim and unparsed.
 * @param string $body        The response body, verbatim and
 *                            unmodified.
 */',
        'startLine' => 47,
        'endLine' => 54,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http\\Curl',
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'currentClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'aliasName' => NULL,
      ),
      'originalUrl' => 
      array (
        'name' => 'originalUrl',
        'parameters' => 
        array (
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
 * Return the URL that was originally requested.
 */',
        'startLine' => 59,
        'endLine' => 62,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http\\Curl',
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'currentClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'aliasName' => NULL,
      ),
      'finalUrl' => 
      array (
        'name' => 'finalUrl',
        'parameters' => 
        array (
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
 * Return the URL of the final response after any redirects.
 */',
        'startLine' => 67,
        'endLine' => 70,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http\\Curl',
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'currentClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'aliasName' => NULL,
      ),
      'statusCode' => 
      array (
        'name' => 'statusCode',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return the HTTP status code of the final response.
 */',
        'startLine' => 75,
        'endLine' => 78,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http\\Curl',
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'currentClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'aliasName' => NULL,
      ),
      'rawHeaders' => 
      array (
        'name' => 'rawHeaders',
        'parameters' => 
        array (
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
 * Return the raw header region of the cURL exchange.
 *
 * The header region is returned verbatim and unparsed. When redirects
 * are followed it may contain multiple header blocks separated by
 * blank lines; the consumer is responsible for selecting the final
 * block.
 */',
        'startLine' => 88,
        'endLine' => 91,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http\\Curl',
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'currentClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'aliasName' => NULL,
      ),
      'body' => 
      array (
        'name' => 'body',
        'parameters' => 
        array (
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
 * Return the response body, verbatim and unmodified.
 */',
        'startLine' => 96,
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http\\Curl',
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
        'currentClassName' => 'App\\Modules\\Http\\Curl\\CurlResponse',
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