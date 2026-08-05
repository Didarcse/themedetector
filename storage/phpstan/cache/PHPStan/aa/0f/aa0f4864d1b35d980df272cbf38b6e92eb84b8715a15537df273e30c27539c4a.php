<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Http\HttpClient.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Http\HttpClient
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-ef8e74d4c488ef0c5cdb6aa8a776cdf6dec92b0aae9f259b621784ef8375c91e',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Http\\HttpClient',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Http/HttpClient.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Http',
    'name' => 'App\\Modules\\Http\\HttpClient',
    'shortName' => 'HttpClient',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Lightweight HTTP client for performing GET requests.
 *
 * Wraps cURL behind a clean API and returns immutable HttpResponse objects.
 * Every request automatically creates and releases its own CurlHandle.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 13,
    'endLine' => 106,
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
            'startLine' => 22,
            'endLine' => 22,
            'startColumn' => 41,
            'endColumn' => 51,
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
 * Validate a URL string and return the trimmed, valid value.
 *
 * @throws HttpException If the URL is empty or malformed.
 *
 * @return non-empty-string The validated URL.
 */',
        'startLine' => 22,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => true,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\HttpClient',
        'implementingClassName' => 'App\\Modules\\Http\\HttpClient',
        'currentClassName' => 'App\\Modules\\Http\\HttpClient',
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
            'startLine' => 45,
            'endLine' => 45,
            'startColumn' => 42,
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
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Parse raw response headers into a name-to-values map.
 *
 * Skips the status line and the trailing blank line. Repeated header
 * names are preserved as a list of values under a single key.
 *
 * @return array<string, list<string>>
 */',
        'startLine' => 45,
        'endLine' => 67,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\HttpClient',
        'implementingClassName' => 'App\\Modules\\Http\\HttpClient',
        'currentClassName' => 'App\\Modules\\Http\\HttpClient',
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
            'startLine' => 74,
            'endLine' => 74,
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
 * Perform an HTTP GET request and return an immutable response.
 *
 * @throws HttpException On invalid URL or cURL failure.
 */',
        'startLine' => 74,
        'endLine' => 105,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => true,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\HttpClient',
        'implementingClassName' => 'App\\Modules\\Http\\HttpClient',
        'currentClassName' => 'App\\Modules\\Http\\HttpClient',
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