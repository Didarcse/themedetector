<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\Detection\Drupal\ScriptFingerprintRuleTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\Detection\Drupal\ScriptFingerprintRuleTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-1135c73a5e309a54e856a442a3c472dc722efe85274ae0e46192362815c1f193',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/Detection/Drupal/ScriptFingerprintRuleTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\Detection\\Drupal',
    'name' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
    'shortName' => 'ScriptFingerprintRuleTest',
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
    'endLine' => 108,
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
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
            'startFilePos' => 249,
            'endTokenPos' => 45,
            'endFilePos' => 269,
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
            'name' => 'App\\Modules\\Detection\\Drupal\\Rules\\ScriptFingerprintRule',
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_drupal_object' => 
      array (
        'name' => 'test_detects_drupal_object',
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_drupal_settings' => 
      array (
        'name' => 'test_detects_drupal_settings',
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_drupal_behaviors' => 
      array (
        'name' => 'test_detects_drupal_behaviors',
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_once_function' => 
      array (
        'name' => 'test_detects_once_function',
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
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
        'startLine' => 62,
        'endLine' => 75,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
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
        'startLine' => 77,
        'endLine' => 83,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
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
        'startLine' => 85,
        'endLine' => 90,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
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
        'startLine' => 92,
        'endLine' => 97,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
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
        'startLine' => 99,
        'endLine' => 107,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\ScriptFingerprintRuleTest',
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