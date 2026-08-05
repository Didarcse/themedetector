<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\Detection\Webflow\DataAttributesRuleTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\Detection\Webflow\DataAttributesRuleTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-79fda57f7f3f6bf1fc66cf5c656c3169ab4f1767ba8013ead0ee8d7cdc2899f7',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/Detection/Webflow/DataAttributesRuleTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\Detection\\Webflow',
    'name' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
    'shortName' => 'DataAttributesRuleTest',
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
    'endLine' => 88,
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
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
            'startFilePos' => 245,
            'endTokenPos' => 45,
            'endFilePos' => 265,
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
            'name' => 'App\\Modules\\Detection\\Webflow\\Rules\\DataAttributesRule',
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
        'namespace' => 'Tests\\Unit\\Detection\\Webflow',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
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
 * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
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
        'namespace' => 'Tests\\Unit\\Detection\\Webflow',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_data_wf_page_attribute' => 
      array (
        'name' => 'test_detects_data_wf_page_attribute',
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
        'endLine' => 33,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Webflow',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_data_wf_site_attribute' => 
      array (
        'name' => 'test_detects_data_wf_site_attribute',
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
        'startLine' => 35,
        'endLine' => 41,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Webflow',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_first_matching_attribute' => 
      array (
        'name' => 'test_returns_first_matching_attribute',
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
        'startLine' => 43,
        'endLine' => 51,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Webflow',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_no_match_when_attributes_are_missing' => 
      array (
        'name' => 'test_returns_no_match_when_attributes_are_missing',
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
        'startLine' => 53,
        'endLine' => 59,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Webflow',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
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
        'startLine' => 61,
        'endLine' => 66,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Webflow',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
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
        'startLine' => 68,
        'endLine' => 73,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Webflow',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_expected_confidence' => 
      array (
        'name' => 'test_returns_expected_confidence',
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
        'startLine' => 75,
        'endLine' => 80,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Webflow',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_attribute_metadata' => 
      array (
        'name' => 'test_returns_attribute_metadata',
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
        'startLine' => 82,
        'endLine' => 87,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Webflow',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Webflow\\DataAttributesRuleTest',
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