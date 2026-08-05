<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\PluginDetection\WordPress\PluginMetadataMapperTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\PluginDetection\WordPress\PluginMetadataMapperTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-1d62e4b8a4eed0ec115c962e8f18299593cd7eec0e245a9b9b86a9730c2f068f',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/PluginDetection/WordPress/PluginMetadataMapperTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
    'name' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
    'shortName' => 'PluginMetadataMapperTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Unit tests for the PluginMetadataMapper.
 *
 * Verifies the complete public contract of the mapper: raw plugin
 * metadata is translated into the canonical PluginMetadata value object
 * through a direct, side-effect free mapping. The slug is mapped onto
 * both the name and the slug, the extra array is preserved unchanged, a
 * missing extra array becomes an empty array, an empty slug maps to an
 * empty name and a null slug, the supplied raw metadata is never
 * modified, and the mapping is deterministic.
 *
 * The mapper is a pure translation layer: it performs no validation, no
 * normalization, no detection, no parsing, and no business logic.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use a real PluginMetadataMapper, a real RawPluginMetadata, and a
 * real PluginMetadata. No mocks, no fixtures, no filesystem, and no HTTP.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 30,
    'endLine' => 164,
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
      'map' => 
      array (
        'name' => 'map',
        'parameters' => 
        array (
          'raw' => 
          array (
            'name' => 'raw',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 39,
            'endLine' => 39,
            'startColumn' => 26,
            'endColumn' => 47,
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
            'name' => 'App\\Modules\\PluginDetection\\PluginMetadata',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Map raw plugin metadata with a real mapper instance.
 *
 * @param RawPluginMetadata $raw The raw plugin metadata.
 *
 * @return PluginMetadata The resulting normalized plugin metadata.
 */',
        'startLine' => 39,
        'endLine' => 42,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'raw' => 
      array (
        'name' => 'raw',
        'parameters' => 
        array (
          'slug' => 
          array (
            'name' => 'slug',
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
            'startLine' => 54,
            'endLine' => 54,
            'startColumn' => 26,
            'endColumn' => 37,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'confidence' => 
          array (
            'name' => 'confidence',
            'default' => 
            array (
              'code' => '0',
              'attributes' => 
              array (
                'startLine' => 54,
                'endLine' => 54,
                'startTokenPos' => 104,
                'startFilePos' => 2058,
                'endTokenPos' => 104,
                'endFilePos' => 2058,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 54,
            'endLine' => 54,
            'startColumn' => 40,
            'endColumn' => 58,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'extra' => 
          array (
            'name' => 'extra',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 54,
                'endLine' => 54,
                'startTokenPos' => 113,
                'startFilePos' => 2076,
                'endTokenPos' => 114,
                'endFilePos' => 2077,
              ),
            ),
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
            'startLine' => 54,
            'endLine' => 54,
            'startColumn' => 61,
            'endColumn' => 77,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Build a raw plugin metadata instance.
 *
 * @param string               $slug       The detected plugin slug.
 * @param int                  $confidence The rule-provided confidence
 *                                         score.
 * @param array<string, mixed> $extra      Additional raw metadata.
 *
 * @return RawPluginMetadata The raw plugin metadata.
 */',
        'startLine' => 54,
        'endLine' => 61,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_returns_plugin_metadata_instance' => 
      array (
        'name' => 'test_returns_plugin_metadata_instance',
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
        'docComment' => '/**
 * Verify that the mapping returns a PluginMetadata instance.
 */',
        'startLine' => 66,
        'endLine' => 71,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_slug_to_plugin_slug' => 
      array (
        'name' => 'test_maps_slug_to_plugin_slug',
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
        'docComment' => '/**
 * Verify that the plugin slug is mapped onto PluginMetadata::slug().
 */',
        'startLine' => 76,
        'endLine' => 81,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_maps_slug_to_plugin_name' => 
      array (
        'name' => 'test_maps_slug_to_plugin_name',
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
        'docComment' => '/**
 * Verify that the plugin slug is mapped onto PluginMetadata::name().
 */',
        'startLine' => 86,
        'endLine' => 91,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_preserves_extra_metadata' => 
      array (
        'name' => 'test_preserves_extra_metadata',
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
        'docComment' => '/**
 * Verify that the extra metadata is preserved unchanged.
 */',
        'startLine' => 96,
        'endLine' => 107,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_missing_extra_metadata_becomes_empty_array' => 
      array (
        'name' => 'test_missing_extra_metadata_becomes_empty_array',
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
        'docComment' => '/**
 * Verify that missing extra metadata becomes an empty array.
 */',
        'startLine' => 112,
        'endLine' => 117,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_empty_slug_maps_to_empty_name_and_null_slug' => 
      array (
        'name' => 'test_empty_slug_maps_to_empty_name_and_null_slug',
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
        'docComment' => '/**
 * Verify that an empty slug maps to an empty name and a null slug.
 */',
        'startLine' => 122,
        'endLine' => 128,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'aliasName' => NULL,
      ),
      'test_does_not_modify_raw_plugin_metadata' => 
      array (
        'name' => 'test_does_not_modify_raw_plugin_metadata',
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
        'docComment' => '/**
 * Verify that the raw plugin metadata is never modified.
 *
 * The mapper copies values onto a fresh PluginMetadata value object and
 * leaves the supplied RawPluginMetadata untouched.
 */',
        'startLine' => 136,
        'endLine' => 145,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
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
        'docComment' => '/**
 * Verify that the mapping is deterministic.
 *
 * Repeated mapping of the same raw metadata always produces the same
 * PluginMetadata values.
 */',
        'startLine' => 153,
        'endLine' => 163,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginMetadataMapperTest',
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