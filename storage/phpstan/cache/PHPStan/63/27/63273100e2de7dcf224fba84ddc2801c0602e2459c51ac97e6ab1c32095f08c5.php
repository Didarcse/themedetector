<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\Detection\Joomla\AssetPathRuleTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\Detection\Joomla\AssetPathRuleTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-7625f2c27bf5024748bef437ec9a23bc06329200c817ae34c6229b475ffb9d48',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/Detection/Joomla/AssetPathRuleTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\Detection\\Joomla',
    'name' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
    'shortName' => 'AssetPathRuleTest',
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
    'endLine' => 162,
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
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
            'startFilePos' => 233,
            'endTokenPos' => 45,
            'endFilePos' => 253,
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
            'name' => 'App\\Modules\\Detection\\Joomla\\Rules\\AssetPathRule',
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_media_system_path' => 
      array (
        'name' => 'test_detects_media_system_path',
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
        'endLine' => 38,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_media_jui_path' => 
      array (
        'name' => 'test_detects_media_jui_path',
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
        'startLine' => 40,
        'endLine' => 51,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_media_com_path' => 
      array (
        'name' => 'test_detects_media_com_path',
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
        'endLine' => 64,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_templates_path' => 
      array (
        'name' => 'test_detects_templates_path',
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
        'startLine' => 66,
        'endLine' => 77,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_asset_path_in_link_element' => 
      array (
        'name' => 'test_detects_asset_path_in_link_element',
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
        'endLine' => 86,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_asset_path_in_script_element' => 
      array (
        'name' => 'test_detects_asset_path_in_script_element',
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
        'startLine' => 88,
        'endLine' => 95,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_asset_path_in_img_element' => 
      array (
        'name' => 'test_detects_asset_path_in_img_element',
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
        'endLine' => 104,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_first_matching_asset_path' => 
      array (
        'name' => 'test_returns_first_matching_asset_path',
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
        'startLine' => 106,
        'endLine' => 118,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_no_match_when_no_asset_path_exists' => 
      array (
        'name' => 'test_returns_no_match_when_no_asset_path_exists',
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
        'startLine' => 120,
        'endLine' => 126,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
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
        'startLine' => 128,
        'endLine' => 133,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
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
        'startLine' => 135,
        'endLine' => 140,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
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
        'startLine' => 142,
        'endLine' => 149,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_asset_path_metadata' => 
      array (
        'name' => 'test_returns_asset_path_metadata',
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
        'startLine' => 151,
        'endLine' => 161,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\AssetPathRuleTest',
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