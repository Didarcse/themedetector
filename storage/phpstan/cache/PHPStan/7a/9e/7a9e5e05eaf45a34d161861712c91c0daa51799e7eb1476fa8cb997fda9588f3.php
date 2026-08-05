<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\Detection\Squarespace\StaticJsRuleTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\Detection\Squarespace\StaticJsRuleTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-55e907d794e3ac2650d4fa16db42c757c2b536b5a71e3b6f2aa91a77992b0908',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/Detection/Squarespace/StaticJsRuleTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\Detection\\Squarespace',
    'name' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
    'shortName' => 'StaticJsRuleTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 10,
    'endLine' => 110,
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'name' => 'URL',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'https://example.com\'',
          'attributes' => 
          array (
            'startLine' => 12,
            'endLine' => 12,
            'startTokenPos' => 45,
            'startFilePos' => 241,
            'endTokenPos' => 45,
            'endFilePos' => 261,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 12,
        'endLine' => 12,
        'startColumn' => 5,
        'endColumn' => 46,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'createRule' => 
      array (
        'name' => 'createRule',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Detection\\Squarespace\\Rules\\StaticJsRule',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 14,
        'endLine' => 17,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\Detection\\Squarespace',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'aliasName' => NULL,
      ),
      'evaluate' => 
      array (
        'name' => 'evaluate',
        'parameters' => 
        array (
          'html' => 
          array (
            'name' => 'html',
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
            'startColumn' => 31,
            'endColumn' => 42,
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
 * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
 */',
        'startLine' => 22,
        'endLine' => 25,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\Detection\\Squarespace',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_squarespace_load' => 
      array (
        'name' => 'test_detects_squarespace_load',
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
        'startLine' => 27,
        'endLine' => 32,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Squarespace',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_squarespace_initialize' => 
      array (
        'name' => 'test_detects_squarespace_initialize',
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
        'startLine' => 34,
        'endLine' => 39,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Squarespace',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_static_squarespace_host' => 
      array (
        'name' => 'test_detects_static_squarespace_host',
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
        'startLine' => 41,
        'endLine' => 48,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Squarespace',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_y_use' => 
      array (
        'name' => 'test_detects_y_use',
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
        'startLine' => 50,
        'endLine' => 55,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Squarespace',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_case_insensitively' => 
      array (
        'name' => 'test_detects_case_insensitively',
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
        'startLine' => 57,
        'endLine' => 62,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Squarespace',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_first_matching_fingerprint' => 
      array (
        'name' => 'test_returns_first_matching_fingerprint',
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
        'startLine' => 64,
        'endLine' => 77,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Squarespace',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_no_match_when_no_fingerprint_exists' => 
      array (
        'name' => 'test_returns_no_match_when_no_fingerprint_exists',
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
        'startLine' => 79,
        'endLine' => 85,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Squarespace',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'aliasName' => NULL,
      ),
      'test_handles_empty_html' => 
      array (
        'name' => 'test_handles_empty_html',
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
        'startLine' => 87,
        'endLine' => 92,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Squarespace',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_expected_weight' => 
      array (
        'name' => 'test_returns_expected_weight',
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
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Squarespace',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_js_fingerprint_metadata' => 
      array (
        'name' => 'test_returns_js_fingerprint_metadata',
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
        'endLine' => 109,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Squarespace',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Squarespace\\StaticJsRuleTest',
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