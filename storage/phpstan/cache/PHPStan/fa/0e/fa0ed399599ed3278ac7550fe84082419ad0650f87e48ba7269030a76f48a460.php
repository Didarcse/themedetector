<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Integration\Detection\WebsiteDetectorIntegrationTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Integration\Detection\FakeHttpClient
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-471b58e93968cc26c38022e1e3b5df4a96ab15ebe96a2cf884dfecc0e787209f',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Integration\\Detection\\FakeHttpClient',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Integration/Detection/WebsiteDetectorIntegrationTest.php',
      ),
    ),
    'namespace' => 'Tests\\Integration\\Detection',
    'name' => 'Tests\\Integration\\Detection\\FakeHttpClient',
    'shortName' => 'FakeHttpClient',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Fake HTTP client for the Detection Engine integration tests.
 *
 * Replaces the real HTTP client in the container so that no network I/O
 * occurs. It always returns the same static WordPress-generator page.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 26,
    'endLine' => 38,
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
    ),
    'immediateMethods' => 
    array (
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
            'startLine' => 28,
            'endLine' => 28,
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
        'docComment' => NULL,
        'startLine' => 28,
        'endLine' => 37,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Detection',
        'declaringClassName' => 'Tests\\Integration\\Detection\\FakeHttpClient',
        'implementingClassName' => 'Tests\\Integration\\Detection\\FakeHttpClient',
        'currentClassName' => 'Tests\\Integration\\Detection\\FakeHttpClient',
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