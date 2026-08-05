<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\Detection\Ghost\MetaGeneratorRuleTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\Detection\Ghost\MetaGeneratorRuleTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-82fe614eb6b772fad7665cc1397401e3985ee086ac5ddd47534d469697fdc766',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/Detection/Ghost/MetaGeneratorRuleTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\Detection\\Ghost',
    'name' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
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
            'startFilePos' => 239,
            'endTokenPos' => 45,
            'endFilePos' => 259,
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
            'name' => 'App\\Modules\\Detection\\Ghost\\Rules\\MetaGeneratorRule',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_plain_ghost_generator' => 
      array (
        'name' => 'test_detects_plain_ghost_generator',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_ghost_five' => 
      array (
        'name' => 'test_detects_ghost_five',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_ghost_six' => 
      array (
        'name' => 'test_detects_ghost_six',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_powered_by_ghost' => 
      array (
        'name' => 'test_detects_powered_by_ghost',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_built_with_ghost' => 
      array (
        'name' => 'test_detects_built_with_ghost',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'aliasName' => NULL,
      ),
      'test_ignores_non_ghost_generator' => 
      array (
        'name' => 'test_ignores_non_ghost_generator',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\MetaGeneratorRuleTest',
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