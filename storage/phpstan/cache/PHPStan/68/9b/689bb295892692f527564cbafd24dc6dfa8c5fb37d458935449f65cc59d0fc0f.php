<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\Detection\Drupal\MetaGeneratorRuleTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\Detection\Drupal\MetaGeneratorRuleTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-7577a9f471bc86fdcda1bdb2d5c590b8c3d7fe88afa2463324a60a231e24519d',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/Detection/Drupal/MetaGeneratorRuleTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\Detection\\Drupal',
    'name' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
    'shortName' => 'MetaGeneratorRuleTest',
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
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
            'name' => 'App\\Modules\\Detection\\Drupal\\Rules\\MetaGeneratorRule',
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
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
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
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_plain_drupal_generator' => 
      array (
        'name' => 'test_detects_plain_drupal_generator',
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
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_drupal_ten' => 
      array (
        'name' => 'test_detects_drupal_ten',
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
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_drupal_eleven' => 
      array (
        'name' => 'test_detects_drupal_eleven',
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
        'endLine' => 46,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_powered_by_drupal' => 
      array (
        'name' => 'test_detects_powered_by_drupal',
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
        'startLine' => 48,
        'endLine' => 53,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_built_with_drupal' => 
      array (
        'name' => 'test_detects_built_with_drupal',
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
        'startLine' => 55,
        'endLine' => 60,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_generator_case_insensitively' => 
      array (
        'name' => 'test_detects_generator_case_insensitively',
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
        'startLine' => 62,
        'endLine' => 67,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_ignores_non_drupal_generator' => 
      array (
        'name' => 'test_ignores_non_drupal_generator',
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
        'startLine' => 69,
        'endLine' => 74,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_no_match_when_generator_is_missing' => 
      array (
        'name' => 'test_returns_no_match_when_generator_is_missing',
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
        'startLine' => 76,
        'endLine' => 81,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
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
        'startLine' => 83,
        'endLine' => 88,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_handles_malformed_html' => 
      array (
        'name' => 'test_handles_malformed_html',
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
        'startLine' => 90,
        'endLine' => 95,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
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
        'startLine' => 97,
        'endLine' => 102,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_generator_metadata' => 
      array (
        'name' => 'test_returns_generator_metadata',
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
        'endLine' => 109,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\MetaGeneratorRuleTest',
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