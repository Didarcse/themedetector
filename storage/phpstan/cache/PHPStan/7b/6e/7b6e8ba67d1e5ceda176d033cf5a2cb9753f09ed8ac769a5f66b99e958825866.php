<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\PluginDetection\WordPress\PluginSlugExtractorTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\PluginDetection\WordPress\PluginSlugExtractorTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-d1cfb4d4d865a5bbaa65688c78a42d3a963a1c396a4cded264bb44c8c894c4e7',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/PluginDetection/WordPress/PluginSlugExtractorTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
    'name' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
    'shortName' => 'PluginSlugExtractorTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Unit tests for the PluginSlugExtractor.
 *
 * Verifies the complete public contract of the extractor: a matching rule
 * result is transformed into a RawPluginMetadata transport object, null is
 * returned when no plugin slug can be extracted, non-string entries are
 * ignored, the primary slug and confidence score are preserved exactly,
 * the rule metadata is preserved unchanged inside extra(), the supplied
 * rule result is never modified, and the transformation is deterministic.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use a real PluginSlugExtractor and a real RawPluginMetadata, no
 * mocks, no fixtures, no filesystem, and no HTTP.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 25,
    'endLine' => 252,
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
      'extract' => 
      array (
        'name' => 'extract',
        'parameters' => 
        array (
          'ruleResult' => 
          array (
            'name' => 'ruleResult',
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
            'startLine' => 40,
            'endLine' => 40,
            'startColumn' => 30,
            'endColumn' => 46,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
          'data' => 
          array (
            'types' => 
            array (
              0 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
                  'isIdentifier' => false,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'null',
                  'isIdentifier' => true,
                ),
              ),
            ),
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Extract raw plugin metadata from a rule result with a real
 * extractor instance.
 *
 * @param array{
 *     matched: bool,
 *     confidence: int,
 *     metadata: array<string, mixed>
 * } $ruleResult The plugin detection rule evaluation result.
 *
 * @return RawPluginMetadata|null The extracted raw plugin metadata, or
 *                                null when no plugin slug was detected.
 */',
        'startLine' => 40,
        'endLine' => 43,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'aliasName' => NULL,
      ),
      'ruleResult' => 
      array (
        'name' => 'ruleResult',
        'parameters' => 
        array (
          'matched' => 
          array (
            'name' => 'matched',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 58,
            'endLine' => 58,
            'startColumn' => 33,
            'endColumn' => 45,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'confidence' => 
          array (
            'name' => 'confidence',
            'default' => NULL,
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
            'startLine' => 58,
            'endLine' => 58,
            'startColumn' => 48,
            'endColumn' => 62,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'metadata' => 
          array (
            'name' => 'metadata',
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
            'startLine' => 58,
            'endLine' => 58,
            'startColumn' => 65,
            'endColumn' => 79,
            'parameterIndex' => 2,
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
 * Build a plugin detection rule evaluation result.
 *
 * @param bool                 $matched    Whether the rule matched.
 * @param int                  $confidence The rule confidence score.
 * @param array<string, mixed> $metadata   The rule metadata array.
 *
 * @return array{
 *     matched: bool,
 *     confidence: int,
 *     metadata: array<string, mixed>
 * }
 */',
        'startLine' => 58,
        'endLine' => 65,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'aliasName' => NULL,
      ),
      'test_returns_raw_plugin_metadata_when_rule_matches' => 
      array (
        'name' => 'test_returns_raw_plugin_metadata_when_rule_matches',
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
 * Verify that a matching rule result is transformed into a
 * RawPluginMetadata transport object.
 */',
        'startLine' => 71,
        'endLine' => 80,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'aliasName' => NULL,
      ),
      'test_returns_null_when_rule_does_not_match' => 
      array (
        'name' => 'test_returns_null_when_rule_does_not_match',
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
 * Verify that null is returned when the rule did not match.
 */',
        'startLine' => 85,
        'endLine' => 94,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'aliasName' => NULL,
      ),
      'test_returns_null_when_metadata_has_no_plugins_key' => 
      array (
        'name' => 'test_returns_null_when_metadata_has_no_plugins_key',
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
 * Verify that null is returned when the metadata contains no plugins
 * key.
 */',
        'startLine' => 100,
        'endLine' => 109,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'aliasName' => NULL,
      ),
      'test_returns_null_when_plugins_is_not_an_array' => 
      array (
        'name' => 'test_returns_null_when_plugins_is_not_an_array',
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
 * Verify that null is returned when the plugins value is not an array.
 */',
        'startLine' => 114,
        'endLine' => 123,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'aliasName' => NULL,
      ),
      'test_returns_null_when_plugins_array_is_empty' => 
      array (
        'name' => 'test_returns_null_when_plugins_array_is_empty',
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
 * Verify that null is returned when the plugins array is empty.
 */',
        'startLine' => 128,
        'endLine' => 137,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'aliasName' => NULL,
      ),
      'test_ignores_non_string_plugin_entries' => 
      array (
        'name' => 'test_ignores_non_string_plugin_entries',
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
 * Verify that non-string plugin entries are ignored.
 *
 * Only string entries contribute to the extracted primary slug, while
 * the original metadata is still preserved unchanged inside extra().
 */',
        'startLine' => 145,
        'endLine' => 158,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'aliasName' => NULL,
      ),
      'test_uses_first_detected_slug_exactly_as_supplied' => 
      array (
        'name' => 'test_uses_first_detected_slug_exactly_as_supplied',
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
 * Verify that the first detected plugin slug is used exactly as
 * supplied.
 */',
        'startLine' => 164,
        'endLine' => 174,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'aliasName' => NULL,
      ),
      'test_preserves_confidence_score' => 
      array (
        'name' => 'test_preserves_confidence_score',
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
 * Verify that the confidence score is preserved unchanged.
 */',
        'startLine' => 179,
        'endLine' => 189,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'aliasName' => NULL,
      ),
      'test_preserves_metadata_unchanged_in_extra' => 
      array (
        'name' => 'test_preserves_metadata_unchanged_in_extra',
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
 * Verify that the rule metadata is preserved unchanged inside extra().
 */',
        'startLine' => 194,
        'endLine' => 209,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'aliasName' => NULL,
      ),
      'test_does_not_modify_supplied_rule_result' => 
      array (
        'name' => 'test_does_not_modify_supplied_rule_result',
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
 * Verify that the supplied rule result is never modified.
 */',
        'startLine' => 214,
        'endLine' => 227,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'aliasName' => NULL,
      ),
      'test_extraction_is_deterministic' => 
      array (
        'name' => 'test_extraction_is_deterministic',
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
 * Verify that the extraction is deterministic.
 *
 * Repeated extraction of the same rule result always produces the same
 * RawPluginMetadata values.
 */',
        'startLine' => 235,
        'endLine' => 251,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\PluginSlugExtractorTest',
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