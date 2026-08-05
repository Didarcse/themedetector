<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\ThemeExtraction\WordPress\WordPressThemeMetadataMapperTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\ThemeExtraction\WordPress\WordPressThemeMetadataMapperTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-270585b43e0e6b757eb8d61fb87e0d06efb98423a6a61496fb5414728f27f00c',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/ThemeExtraction/WordPress/WordPressThemeMetadataMapperTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
    'name' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
    'shortName' => 'WordPressThemeMetadataMapperTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Unit tests for the WordPressThemeMetadataMapper.
 *
 * Verifies the complete public contract of the mapper: every recognized
 * field is translated into its ThemeMetadata counterpart, the Tags field
 * is preserved without splitting, Tested up to is stored inside the extra
 * array, missing fields become null, whitespace is normalized, and mapping
 * is deterministic.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use real objects, no mocks, no filesystem, and no HTTP.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 24,
    'endLine' => 211,
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
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'mapper' => 
      array (
        'name' => 'mapper',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapper',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a real mapper instance.
 *
 * @return WordPressThemeMetadataMapper The mapper under test.
 */',
        'startLine' => 31,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'raw' => 
      array (
        'name' => 'raw',
        'parameters' => 
        array (
          'fields' => 
          array (
            'name' => 'fields',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 43,
            'endLine' => 43,
            'startColumn' => 26,
            'endColumn' => 38,
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
            'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\RawWordPressThemeMetadata',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Wrap the given raw fields in a RawWordPressThemeMetadata object.
 *
 * @param array<string, string> $fields The raw metadata fields.
 *
 * @return RawWordPressThemeMetadata The raw metadata transport object.
 */',
        'startLine' => 43,
        'endLine' => 46,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_theme_name' => 
      array (
        'name' => 'test_maps_theme_name',
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
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_theme_uri' => 
      array (
        'name' => 'test_maps_theme_uri',
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
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_author' => 
      array (
        'name' => 'test_maps_author',
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
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_author_uri' => 
      array (
        'name' => 'test_maps_author_uri',
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
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_description' => 
      array (
        'name' => 'test_maps_description',
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
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_version' => 
      array (
        'name' => 'test_maps_version',
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
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_license' => 
      array (
        'name' => 'test_maps_license',
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
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_license_uri' => 
      array (
        'name' => 'test_maps_license_uri',
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
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_text_domain' => 
      array (
        'name' => 'test_maps_text_domain',
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
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_parent_theme' => 
      array (
        'name' => 'test_maps_parent_theme',
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
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_requires_php' => 
      array (
        'name' => 'test_maps_requires_php',
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
        'startLine' => 118,
        'endLine' => 123,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_requires_wordpress' => 
      array (
        'name' => 'test_maps_requires_wordpress',
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
        'startLine' => 125,
        'endLine' => 130,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_tags_without_splitting' => 
      array (
        'name' => 'test_maps_tags_without_splitting',
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
        'startLine' => 132,
        'endLine' => 137,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_tested_up_to_into_extra' => 
      array (
        'name' => 'test_maps_tested_up_to_into_extra',
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
        'startLine' => 139,
        'endLine' => 144,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_missing_fields_become_null' => 
      array (
        'name' => 'test_missing_fields_become_null',
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
        'startLine' => 146,
        'endLine' => 164,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_trims_surrounding_whitespace' => 
      array (
        'name' => 'test_trims_surrounding_whitespace',
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
        'startLine' => 166,
        'endLine' => 175,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_preserves_internal_whitespace' => 
      array (
        'name' => 'test_preserves_internal_whitespace',
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
        'startLine' => 177,
        'endLine' => 182,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_returns_theme_metadata_instance' => 
      array (
        'name' => 'test_returns_theme_metadata_instance',
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
        'startLine' => 184,
        'endLine' => 189,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_mapping_is_deterministic' => 
      array (
        'name' => 'test_mapping_is_deterministic',
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
        'startLine' => 191,
        'endLine' => 210,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapperTest',
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