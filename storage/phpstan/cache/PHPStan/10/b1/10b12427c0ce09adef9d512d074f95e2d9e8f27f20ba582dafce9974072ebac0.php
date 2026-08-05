<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Http\RequestOptions.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Http\RequestOptions
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-7934181f53e512cc126f0bd8b05e465d18b9ef3997ca360c86eb728e324ff01a',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Http\\RequestOptions',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Http/RequestOptions.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Http',
    'name' => 'App\\Modules\\Http\\RequestOptions',
    'shortName' => 'RequestOptions',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Immutable HTTP request options value object.
 *
 * Contains every configurable option required by an
 * HttpClientInterface implementation. Future options — such as proxy,
 * cookies, custom headers, or authentication — can be added here without
 * changing the HttpClientInterface contract.
 *
 * Current options:
 *
 * - timeout: total request timeout in seconds.
 * - connectTimeout: connection timeout in seconds.
 * - userAgent: the user agent sent with the request.
 * - followRedirects: whether redirects are followed.
 * - maxRedirects: the maximum number of redirects to follow.
 *
 * Responsibilities:
 *
 * - Store HTTP request configuration.
 * - Expose the stored configuration through immutable read-only
 *   accessors.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is a pure Value Object. It
 *   stores configuration only and performs no HTTP requests, no
 *   validation, and no business logic.
 * - The object is immutable, stateless, deterministic, and side-effect
 *   free. Once constructed, its state cannot be altered.
 * - It knows nothing about detection, theme extraction, plugin detection,
 *   or any concrete technology (WordPress, Joomla, Drupal, Ghost, TYPO3,
 *   etc.).
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 40,
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
      'timeout' => 
      array (
        'declaringClassName' => 'App\\Modules\\Http\\RequestOptions',
        'implementingClassName' => 'App\\Modules\\Http\\RequestOptions',
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
            'startLine' => 53,
            'endLine' => 53,
            'startTokenPos' => 44,
            'startFilePos' => 1893,
            'endTokenPos' => 44,
            'endFilePos' => 1894,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 53,
        'endLine' => 53,
        'startColumn' => 9,
        'endColumn' => 33,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'connectTimeout' => 
      array (
        'declaringClassName' => 'App\\Modules\\Http\\RequestOptions',
        'implementingClassName' => 'App\\Modules\\Http\\RequestOptions',
        'name' => 'connectTimeout',
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
          'code' => '5',
          'attributes' => 
          array (
            'startLine' => 54,
            'endLine' => 54,
            'startTokenPos' => 55,
            'startFilePos' => 1935,
            'endTokenPos' => 55,
            'endFilePos' => 1935,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 54,
        'endLine' => 54,
        'startColumn' => 9,
        'endColumn' => 39,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'userAgent' => 
      array (
        'declaringClassName' => 'App\\Modules\\Http\\RequestOptions',
        'implementingClassName' => 'App\\Modules\\Http\\RequestOptions',
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
            'startLine' => 55,
            'endLine' => 55,
            'startTokenPos' => 66,
            'startFilePos' => 1974,
            'endTokenPos' => 66,
            'endFilePos' => 1996,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 55,
        'endLine' => 55,
        'startColumn' => 9,
        'endColumn' => 59,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'followRedirects' => 
      array (
        'declaringClassName' => 'App\\Modules\\Http\\RequestOptions',
        'implementingClassName' => 'App\\Modules\\Http\\RequestOptions',
        'name' => 'followRedirects',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => 'true',
          'attributes' => 
          array (
            'startLine' => 56,
            'endLine' => 56,
            'startTokenPos' => 77,
            'startFilePos' => 2039,
            'endTokenPos' => 77,
            'endFilePos' => 2042,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 56,
        'endLine' => 56,
        'startColumn' => 9,
        'endColumn' => 44,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'maxRedirects' => 
      array (
        'declaringClassName' => 'App\\Modules\\Http\\RequestOptions',
        'implementingClassName' => 'App\\Modules\\Http\\RequestOptions',
        'name' => 'maxRedirects',
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
          'code' => '10',
          'attributes' => 
          array (
            'startLine' => 57,
            'endLine' => 57,
            'startTokenPos' => 88,
            'startFilePos' => 2081,
            'endTokenPos' => 88,
            'endFilePos' => 2082,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 57,
        'endLine' => 57,
        'startColumn' => 9,
        'endColumn' => 38,
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
          'timeout' => 
          array (
            'name' => 'timeout',
            'default' => 
            array (
              'code' => '15',
              'attributes' => 
              array (
                'startLine' => 53,
                'endLine' => 53,
                'startTokenPos' => 44,
                'startFilePos' => 1893,
                'endTokenPos' => 44,
                'endFilePos' => 1894,
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
            'startLine' => 53,
            'endLine' => 53,
            'startColumn' => 9,
            'endColumn' => 33,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'connectTimeout' => 
          array (
            'name' => 'connectTimeout',
            'default' => 
            array (
              'code' => '5',
              'attributes' => 
              array (
                'startLine' => 54,
                'endLine' => 54,
                'startTokenPos' => 55,
                'startFilePos' => 1935,
                'endTokenPos' => 55,
                'endFilePos' => 1935,
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
            'startLine' => 54,
            'endLine' => 54,
            'startColumn' => 9,
            'endColumn' => 39,
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
                'startLine' => 55,
                'endLine' => 55,
                'startTokenPos' => 66,
                'startFilePos' => 1974,
                'endTokenPos' => 66,
                'endFilePos' => 1996,
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
            'startLine' => 55,
            'endLine' => 55,
            'startColumn' => 9,
            'endColumn' => 59,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'followRedirects' => 
          array (
            'name' => 'followRedirects',
            'default' => 
            array (
              'code' => 'true',
              'attributes' => 
              array (
                'startLine' => 56,
                'endLine' => 56,
                'startTokenPos' => 77,
                'startFilePos' => 2039,
                'endTokenPos' => 77,
                'endFilePos' => 2042,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
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
            'endColumn' => 44,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
          'maxRedirects' => 
          array (
            'name' => 'maxRedirects',
            'default' => 
            array (
              'code' => '10',
              'attributes' => 
              array (
                'startLine' => 57,
                'endLine' => 57,
                'startTokenPos' => 88,
                'startFilePos' => 2081,
                'endTokenPos' => 88,
                'endFilePos' => 2082,
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
            'startLine' => 57,
            'endLine' => 57,
            'startColumn' => 9,
            'endColumn' => 38,
            'parameterIndex' => 4,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create an immutable set of HTTP request options.
 *
 * @param int    $timeout         Total request timeout in seconds.
 * @param int    $connectTimeout  Connection timeout in seconds.
 * @param string $userAgent       The user agent sent with the request.
 * @param bool   $followRedirects Whether redirects are followed.
 * @param int    $maxRedirects    The maximum number of redirects to
 *                                follow.
 */',
        'startLine' => 52,
        'endLine' => 59,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\RequestOptions',
        'implementingClassName' => 'App\\Modules\\Http\\RequestOptions',
        'currentClassName' => 'App\\Modules\\Http\\RequestOptions',
        'aliasName' => NULL,
      ),
      'timeout' => 
      array (
        'name' => 'timeout',
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
 * Return the total request timeout in seconds.
 */',
        'startLine' => 64,
        'endLine' => 67,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\RequestOptions',
        'implementingClassName' => 'App\\Modules\\Http\\RequestOptions',
        'currentClassName' => 'App\\Modules\\Http\\RequestOptions',
        'aliasName' => NULL,
      ),
      'connectTimeout' => 
      array (
        'name' => 'connectTimeout',
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
 * Return the connection timeout in seconds.
 */',
        'startLine' => 72,
        'endLine' => 75,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\RequestOptions',
        'implementingClassName' => 'App\\Modules\\Http\\RequestOptions',
        'currentClassName' => 'App\\Modules\\Http\\RequestOptions',
        'aliasName' => NULL,
      ),
      'userAgent' => 
      array (
        'name' => 'userAgent',
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
 * Return the user agent sent with the request.
 */',
        'startLine' => 80,
        'endLine' => 83,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\RequestOptions',
        'implementingClassName' => 'App\\Modules\\Http\\RequestOptions',
        'currentClassName' => 'App\\Modules\\Http\\RequestOptions',
        'aliasName' => NULL,
      ),
      'followRedirects' => 
      array (
        'name' => 'followRedirects',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return whether redirects are followed.
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
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\RequestOptions',
        'implementingClassName' => 'App\\Modules\\Http\\RequestOptions',
        'currentClassName' => 'App\\Modules\\Http\\RequestOptions',
        'aliasName' => NULL,
      ),
      'maxRedirects' => 
      array (
        'name' => 'maxRedirects',
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
 * Return the maximum number of redirects to follow.
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
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\RequestOptions',
        'implementingClassName' => 'App\\Modules\\Http\\RequestOptions',
        'currentClassName' => 'App\\Modules\\Http\\RequestOptions',
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