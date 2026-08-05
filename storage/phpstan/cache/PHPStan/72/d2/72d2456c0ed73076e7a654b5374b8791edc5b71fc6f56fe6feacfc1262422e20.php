<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Http\Curl\CurlAdapterInterface.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Http\Curl\CurlAdapterInterface
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-812d8810e5a0bd359cbd87ab809ee9ce0d112121150ba5374f576f4e826326dd',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Http\\Curl\\CurlAdapterInterface',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Http/Curl/CurlAdapterInterface.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Http\\Curl',
    'name' => 'App\\Modules\\Http\\Curl\\CurlAdapterInterface',
    'shortName' => 'CurlAdapterInterface',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Abstraction over PHP native cURL functions.
 *
 * The adapter isolates all direct interaction with the cURL extension.
 * CurlHttpClient must never call curl_*() functions directly; instead,
 * it communicates exclusively through this interface. This allows the
 * HTTP layer to be fully unit-testable without depending on the native
 * cURL extension or network access.
 *
 * Responsibilities:
 *
 * - Execute one HTTP GET request against the given URL.
 * - Return the raw cURL exchange as an immutable CurlResponse.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is a pure transport
 *   abstraction. It knows nothing about HttpResponse, detection, theme
 *   extraction, plugin detection, or any concrete technology (WordPress,
 *   Joomla, Drupal, Ghost, TYPO3, etc.).
 * - Dependency Inversion Principle: consumers depend on this abstraction
 *   rather than on the native cURL extension directly.
 * - The adapter is stateless and deterministic except for the network I/O
 *   inherent to performing a request.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 32,
    'endLine' => 44,
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
            'startLine' => 43,
            'endLine' => 43,
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
            'startLine' => 43,
            'endLine' => 43,
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
            'startLine' => 43,
            'endLine' => 43,
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
 * @param string $url      The absolute URL to request.
 * @param int    $timeout  The total request timeout in seconds.
 * @param string $userAgent The user agent to send with the request.
 *
 * @return CurlResponse The immutable raw cURL exchange.
 */',
        'startLine' => 43,
        'endLine' => 43,
        'startColumn' => 5,
        'endColumn' => 88,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http\\Curl',
        'declaringClassName' => 'App\\Modules\\Http\\Curl\\CurlAdapterInterface',
        'implementingClassName' => 'App\\Modules\\Http\\Curl\\CurlAdapterInterface',
        'currentClassName' => 'App\\Modules\\Http\\Curl\\CurlAdapterInterface',
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