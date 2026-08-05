<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\Detection\Joomla\MetaGeneratorRuleTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\Detection\Joomla\MetaGeneratorRuleTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-144b0f4ba2ef3e834276bddd03cd91f73230025a10ab8daffd9a4fc9d1c870c5',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/Detection/Joomla/MetaGeneratorRuleTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\Detection\\Joomla',
    'name' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
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
    'endLine' => 117,
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
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
            'name' => 'App\\Modules\\Detection\\Joomla\\Rules\\MetaGeneratorRule',
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
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
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
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_plain_joomla_generator' => 
      array (
        'name' => 'test_detects_plain_joomla_generator',
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
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_joomla_open_source_cms' => 
      array (
        'name' => 'test_detects_joomla_open_source_cms',
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
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_powered_by_joomla' => 
      array (
        'name' => 'test_detects_powered_by_joomla',
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
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_built_with_joomla' => 
      array (
        'name' => 'test_detects_built_with_joomla',
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
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_joomla_five' => 
      array (
        'name' => 'test_detects_joomla_five',
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
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_joomla_four' => 
      array (
        'name' => 'test_detects_joomla_four',
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
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
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
        'startLine' => 69,
        'endLine' => 74,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_ignores_non_joomla_generator' => 
      array (
        'name' => 'test_ignores_non_joomla_generator',
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
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
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
        'startLine' => 83,
        'endLine' => 88,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
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
        'startLine' => 90,
        'endLine' => 95,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
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
        'startLine' => 97,
        'endLine' => 102,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
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
        'startLine' => 104,
        'endLine' => 109,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
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
        'startLine' => 111,
        'endLine' => 116,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\MetaGeneratorRuleTest',
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