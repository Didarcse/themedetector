<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\ThemeExtraction\WordPress\WordPressStyleCssLocatorTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\ThemeExtraction\WordPress\WordPressStyleCssLocatorTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-5f3bb39e653aeec101c593aa991229ce34cbd2bef519f9612e3012923a3ea095',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/ThemeExtraction/WordPress/WordPressStyleCssLocatorTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
    'name' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
    'shortName' => 'WordPressStyleCssLocatorTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Unit tests for the WordPressStyleCssLocator.
 *
 * Verifies the complete public contract of the locator: the active
 * WordPress theme stylesheet is discovered from the HTML carried by a real
 * DetectionContext, absolute hrefs are preserved, relative hrefs are
 * resolved into absolute URLs against the final URL, the original URL is
 * used as a fallback, non-theme stylesheets (wp-includes, plugins, Google
 * Fonts, and external CSS) are ignored, the first matching theme
 * stylesheet wins, child themes are supported, malformed HTML is tolerated,
 * empty HTML yields null, and locating is deterministic across repeated
 * calls.
 *
 * The tests are behaviour-driven, fast, independent, and deterministic.
 * They use only real objects — a real WordPressStyleCssLocator and a real
 * DetectionContext — with no mocks, no filesystem, and no HTTP.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 28,
    'endLine' => 325,
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
      'THEME_URL' => 
      array (
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'name' => 'THEME_URL',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'https://example.com/wp-content/themes/astra/style.css\'',
          'attributes' => 
          array (
            'startLine' => 30,
            'endLine' => 30,
            'startTokenPos' => 52,
            'startFilePos' => 1185,
            'endTokenPos' => 52,
            'endFilePos' => 1239,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 30,
        'endLine' => 30,
        'startColumn' => 5,
        'endColumn' => 86,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'locator' => 
      array (
        'name' => 'locator',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a real locator instance.
 *
 * @return WordPressStyleCssLocator The locator under test.
 */',
        'startLine' => 37,
        'endLine' => 40,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'context' => 
      array (
        'name' => 'context',
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
            'startLine' => 52,
            'endLine' => 52,
            'startColumn' => 9,
            'endColumn' => 20,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'finalUrl' => 
          array (
            'name' => 'finalUrl',
            'default' => 
            array (
              'code' => '\'https://example.com\'',
              'attributes' => 
              array (
                'startLine' => 53,
                'endLine' => 53,
                'startTokenPos' => 101,
                'startFilePos' => 1912,
                'endTokenPos' => 101,
                'endFilePos' => 1932,
              ),
            ),
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
            'startLine' => 53,
            'endLine' => 53,
            'startColumn' => 9,
            'endColumn' => 48,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'originalUrl' => 
          array (
            'name' => 'originalUrl',
            'default' => 
            array (
              'code' => '\'https://example.com\'',
              'attributes' => 
              array (
                'startLine' => 54,
                'endLine' => 54,
                'startTokenPos' => 110,
                'startFilePos' => 1965,
                'endTokenPos' => 110,
                'endFilePos' => 1985,
              ),
            ),
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
            'startColumn' => 9,
            'endColumn' => 51,
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
            'name' => 'App\\Modules\\Detection\\DetectionContext',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a real detection context carrying the given HTML.
 *
 * @param string $html        The HTML body to carry.
 * @param string $finalUrl    The final URL after redirects.
 * @param string $originalUrl The URL requested by the user.
 *
 * @return DetectionContext The immutable detection context.
 */',
        'startLine' => 51,
        'endLine' => 62,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'document' => 
      array (
        'name' => 'document',
        'parameters' => 
        array (
          'link' => 
          array (
            'name' => 'link',
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
            'startLine' => 71,
            'endLine' => 71,
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
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Wrap a stylesheet link into a minimal HTML document.
 *
 * @param string $link The full <link> element markup.
 *
 * @return string A complete HTML document carrying the given link.
 */',
        'startLine' => 71,
        'endLine' => 80,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'test_finds_absolute_theme_stylesheet' => 
      array (
        'name' => 'test_finds_absolute_theme_stylesheet',
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
 * Verify that an absolute theme stylesheet href is located unchanged.
 */',
        'startLine' => 85,
        'endLine' => 98,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'test_finds_relative_theme_stylesheet' => 
      array (
        'name' => 'test_finds_relative_theme_stylesheet',
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
 * Verify that a root-relative theme stylesheet href is resolved
 * against the final URL.
 */',
        'startLine' => 104,
        'endLine' => 111,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'test_returns_null_when_no_theme_stylesheet_exists' => 
      array (
        'name' => 'test_returns_null_when_no_theme_stylesheet_exists',
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
 * Verify that null is returned when no valid theme stylesheet exists.
 *
 * A stylesheet living under /wp-content/themes/ that does not name a
 * style.css file is rejected, and so is an empty href.
 */',
        'startLine' => 119,
        'endLine' => 129,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'test_ignores_wp_includes_stylesheets' => 
      array (
        'name' => 'test_ignores_wp_includes_stylesheets',
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
 * Verify that wp-includes stylesheets are ignored.
 */',
        'startLine' => 134,
        'endLine' => 144,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'test_ignores_plugin_stylesheets' => 
      array (
        'name' => 'test_ignores_plugin_stylesheets',
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
 * Verify that plugin stylesheets are ignored.
 */',
        'startLine' => 149,
        'endLine' => 159,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'test_ignores_google_fonts' => 
      array (
        'name' => 'test_ignores_google_fonts',
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
 * Verify that Google Fonts stylesheets are ignored.
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
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'test_ignores_external_stylesheets' => 
      array (
        'name' => 'test_ignores_external_stylesheets',
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
 * Verify that external stylesheets hosted outside the target site are
 * ignored.
 */',
        'startLine' => 180,
        'endLine' => 187,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'test_returns_first_matching_theme_stylesheet' => 
      array (
        'name' => 'test_returns_first_matching_theme_stylesheet',
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
 * Verify that the first matching theme stylesheet is returned even when
 * unrelated stylesheets appear earlier in the markup.
 */',
        'startLine' => 193,
        'endLine' => 212,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'test_supports_child_theme_stylesheet' => 
      array (
        'name' => 'test_supports_child_theme_stylesheet',
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
 * Verify that a child theme stylesheet is located and resolved.
 */',
        'startLine' => 217,
        'endLine' => 227,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'test_supports_malformed_html' => 
      array (
        'name' => 'test_supports_malformed_html',
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
 * Verify that malformed HTML still yields the theme stylesheet.
 */',
        'startLine' => 232,
        'endLine' => 247,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'test_falls_back_to_original_url' => 
      array (
        'name' => 'test_falls_back_to_original_url',
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
 * Verify that the original URL is used when the final URL is empty.
 */',
        'startLine' => 252,
        'endLine' => 261,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'test_normalizes_relative_urls' => 
      array (
        'name' => 'test_normalizes_relative_urls',
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
 * Verify that every relative URL form is resolved into an absolute URL.
 */',
        'startLine' => 266,
        'endLine' => 298,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'test_returns_null_for_empty_html' => 
      array (
        'name' => 'test_returns_null_for_empty_html',
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
 * Verify that empty HTML yields null.
 */',
        'startLine' => 303,
        'endLine' => 306,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'aliasName' => NULL,
      ),
      'test_locator_is_deterministic' => 
      array (
        'name' => 'test_locator_is_deterministic',
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
 * Verify that repeated calls with the same context are deterministic.
 */',
        'startLine' => 311,
        'endLine' => 324,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'implementingClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
        'currentClassName' => 'Tests\\Unit\\ThemeExtraction\\WordPress\\WordPressStyleCssLocatorTest',
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