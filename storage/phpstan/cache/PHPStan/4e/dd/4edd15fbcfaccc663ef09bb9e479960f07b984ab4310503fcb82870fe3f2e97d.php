<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\Detection\Ghost\AssetPathRuleTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\Detection\Ghost\AssetPathRuleTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-793707a47c4c9cb08835b1db10ca82c4f0b0b09a0b79947c5033b361053c7ad5',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/Detection/Ghost/AssetPathRuleTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\Detection\\Ghost',
    'name' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
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
    'endLine' => 149,
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
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
            'startFilePos' => 231,
            'endTokenPos' => 45,
            'endFilePos' => 251,
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
            'name' => 'App\\Modules\\Detection\\Ghost\\Rules\\AssetPathRule',
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_content_themes_path' => 
      array (
        'name' => 'test_detects_content_themes_path',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_content_images_path' => 
      array (
        'name' => 'test_detects_content_images_path',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_assets_built_path' => 
      array (
        'name' => 'test_detects_assets_built_path',
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
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
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
        'startLine' => 66,
        'endLine' => 73,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
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
        'startLine' => 75,
        'endLine' => 82,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
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
        'startLine' => 84,
        'endLine' => 91,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
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
        'startLine' => 93,
        'endLine' => 105,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
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
        'startLine' => 107,
        'endLine' => 113,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
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
        'startLine' => 115,
        'endLine' => 120,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
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
        'startLine' => 122,
        'endLine' => 127,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
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
        'startLine' => 129,
        'endLine' => 136,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
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
        'startLine' => 138,
        'endLine' => 148,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Ghost',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Ghost\\AssetPathRuleTest',
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