<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\ThemeExtraction\WordPress\WordPressStyleCssParserTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\ThemeExtraction\WordPress\WordPressStyleCssParserTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-5f49c393ee69c20276d207f5dbb7d4aecc33b83629ba63353735c4b307e741f6',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/ThemeExtraction/WordPress/WordPressStyleCssParserTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
    'name' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
    'shortName' => 'WordPressStyleCssParserTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Unit tests for the WordPressStyleCssParser.
 *
 * Verifies the complete public contract of the parser: every recognized
 * field is extracted from the metadata header, unknown fields and CSS
 * rules are ignored, parsing stops at the end of the header comment,
 * original values are preserved, and both Windows and Linux line endings
 * are handled.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use a real parser instance, no mocks, no fixtures, no filesystem,
 * and no HTTP.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 24,
    'endLine' => 251,
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
      'parse' => 
      array (
        'name' => 'parse',
        'parameters' => 
        array (
          'styleCss' => 
          array (
            'name' => 'styleCss',
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
            'startLine' => 33,
            'endLine' => 33,
            'startColumn' => 28,
            'endColumn' => 43,
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
 * Parse the given style.css contents with a real parser instance.
 *
 * @param string $styleCss The style.css contents to parse.
 *
 * @return RawWordPressThemeMetadata The parsed raw metadata.
 */',
        'startLine' => 33,
        'endLine' => 36,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'styleCss' => 
      array (
        'name' => 'styleCss',
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
            'startLine' => 45,
            'endLine' => 45,
            'startColumn' => 31,
            'endColumn' => 43,
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
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Build a style.css metadata header from the given fields.
 *
 * @param array<string, string> $fields The header fields.
 *
 * @return string A style.css string carrying the given header fields.
 */',
        'startLine' => 45,
        'endLine' => 54,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_theme_name' => 
      array (
        'name' => 'test_parses_theme_name',
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
        'startLine' => 56,
        'endLine' => 61,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_theme_uri' => 
      array (
        'name' => 'test_parses_theme_uri',
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
        'startLine' => 63,
        'endLine' => 68,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_author' => 
      array (
        'name' => 'test_parses_author',
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
        'startLine' => 70,
        'endLine' => 75,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_author_uri' => 
      array (
        'name' => 'test_parses_author_uri',
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
        'endLine' => 82,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_description' => 
      array (
        'name' => 'test_parses_description',
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
        'endLine' => 89,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_version' => 
      array (
        'name' => 'test_parses_version',
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
        'startLine' => 91,
        'endLine' => 96,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_license' => 
      array (
        'name' => 'test_parses_license',
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
        'startLine' => 98,
        'endLine' => 103,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_license_uri' => 
      array (
        'name' => 'test_parses_license_uri',
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
        'startLine' => 105,
        'endLine' => 110,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_tags' => 
      array (
        'name' => 'test_parses_tags',
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
        'startLine' => 112,
        'endLine' => 117,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_text_domain' => 
      array (
        'name' => 'test_parses_text_domain',
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
        'endLine' => 124,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_requires_php' => 
      array (
        'name' => 'test_parses_requires_php',
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
        'startLine' => 126,
        'endLine' => 131,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_requires_at_least' => 
      array (
        'name' => 'test_parses_requires_at_least',
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
        'endLine' => 138,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_tested_up_to' => 
      array (
        'name' => 'test_parses_tested_up_to',
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
        'startLine' => 140,
        'endLine' => 145,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_template' => 
      array (
        'name' => 'test_parses_template',
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
        'startLine' => 147,
        'endLine' => 152,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_returns_empty_metadata_for_empty_file' => 
      array (
        'name' => 'test_returns_empty_metadata_for_empty_file',
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
        'startLine' => 154,
        'endLine' => 159,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_ignores_unknown_fields' => 
      array (
        'name' => 'test_ignores_unknown_fields',
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
        'startLine' => 161,
        'endLine' => 173,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_ignores_css_rules' => 
      array (
        'name' => 'test_ignores_css_rules',
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
        'startLine' => 175,
        'endLine' => 195,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_stops_after_header_comment' => 
      array (
        'name' => 'test_stops_after_header_comment',
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
        'startLine' => 197,
        'endLine' => 211,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_preserves_original_values' => 
      array (
        'name' => 'test_preserves_original_values',
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
        'startLine' => 213,
        'endLine' => 224,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_windows_line_endings' => 
      array (
        'name' => 'test_parses_windows_line_endings',
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
        'startLine' => 226,
        'endLine' => 237,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'aliasName' => NULL,
      ),
      'test_parses_linux_line_endings' => 
      array (
        'name' => 'test_parses_linux_line_endings',
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
        'startLine' => 239,
        'endLine' => 250,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssParserTest',
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