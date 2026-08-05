<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Http\UserAgent.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Http\UserAgent
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-7776d03dcdbc8423caa3ae12a4cca49115ca6af2003f944e7d750ff964e9ecaa',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Http\\UserAgent',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Http/UserAgent.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Http',
    'name' => 'App\\Modules\\Http\\UserAgent',
    'shortName' => 'UserAgent',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Provides rotating desktop browser User-Agent strings.
 *
 * Used by CurlFactory and HttpClient to reduce request blocking
 * and improve website compatibility.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 13,
    'endLine' => 52,
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
      'AGENTS' => 
      array (
        'declaringClassName' => 'App\\Modules\\Http\\UserAgent',
        'implementingClassName' => 'App\\Modules\\Http\\UserAgent',
        'name' => 'AGENTS',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[
    // Chrome — Windows
    \'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36\',
    // Chrome — macOS
    \'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36\',
    // Firefox — Windows
    \'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:130.0) Gecko/20100101 Firefox/130.0\',
    // Firefox — Linux
    \'Mozilla/5.0 (X11; Linux x86_64; rv:130.0) Gecko/20100101 Firefox/130.0\',
    // Edge — Windows
    \'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0\',
    // Safari — macOS
    \'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Safari/605.1.15\',
]',
          'attributes' => 
          array (
            'startLine' => 16,
            'endLine' => 29,
            'startTokenPos' => 35,
            'startFilePos' => 313,
            'endTokenPos' => 67,
            'endFilePos' => 1185,
          ),
        ),
        'docComment' => '/** @var list<string> */',
        'attributes' => 
        array (
        ),
        'startLine' => 16,
        'endLine' => 29,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 31,
        'endLine' => 31,
        'startColumn' => 5,
        'endColumn' => 37,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\UserAgent',
        'implementingClassName' => 'App\\Modules\\Http\\UserAgent',
        'currentClassName' => 'App\\Modules\\Http\\UserAgent',
        'aliasName' => NULL,
      ),
      'random' => 
      array (
        'name' => 'random',
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
 * Return a random User-Agent string.
 *
 * @return non-empty-string
 */',
        'startLine' => 38,
        'endLine' => 41,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\UserAgent',
        'implementingClassName' => 'App\\Modules\\Http\\UserAgent',
        'currentClassName' => 'App\\Modules\\Http\\UserAgent',
        'aliasName' => NULL,
      ),
      'all' => 
      array (
        'name' => 'all',
        'parameters' => 
        array (
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
 * Return all available User-Agent strings.
 *
 * @return list<string>
 */',
        'startLine' => 48,
        'endLine' => 51,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\UserAgent',
        'implementingClassName' => 'App\\Modules\\Http\\UserAgent',
        'currentClassName' => 'App\\Modules\\Http\\UserAgent',
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