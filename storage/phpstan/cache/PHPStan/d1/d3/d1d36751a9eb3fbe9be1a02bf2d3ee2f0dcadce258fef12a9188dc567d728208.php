<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\Detection\Drupal\AssetPathRuleTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\Detection\Drupal\AssetPathRuleTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-9a2db254e13c2e6e12805de384e960619df779c30775d83c6169436116b61b22',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/Detection/Drupal/AssetPathRuleTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\Detection\\Drupal',
    'name' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
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
    'endLine' => 175,
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
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
            'name' => 'App\\Modules\\Detection\\Drupal\\Rules\\AssetPathRule',
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_sites_default_files_path' => 
      array (
        'name' => 'test_detects_sites_default_files_path',
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
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_core_misc_path' => 
      array (
        'name' => 'test_detects_core_misc_path',
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
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_core_assets_path' => 
      array (
        'name' => 'test_detects_core_assets_path',
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
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_modules_custom_path' => 
      array (
        'name' => 'test_detects_modules_custom_path',
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
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_themes_custom_path' => 
      array (
        'name' => 'test_detects_themes_custom_path',
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
        'endLine' => 90,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
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
        'startLine' => 92,
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
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
        'startLine' => 101,
        'endLine' => 108,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
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
        'startLine' => 110,
        'endLine' => 117,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
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
        'startLine' => 119,
        'endLine' => 131,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
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
        'startLine' => 133,
        'endLine' => 139,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
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
        'startLine' => 141,
        'endLine' => 146,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
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
        'startLine' => 148,
        'endLine' => 153,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
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
        'startLine' => 155,
        'endLine' => 162,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
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
        'startLine' => 164,
        'endLine' => 174,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Drupal',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Drupal\\AssetPathRuleTest',
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