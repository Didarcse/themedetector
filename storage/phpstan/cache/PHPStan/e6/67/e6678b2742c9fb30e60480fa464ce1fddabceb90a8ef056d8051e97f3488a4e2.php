<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\ThemeExtraction\WordPress\WordPressStyleCssLocator.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\ThemeExtraction\WordPress\WordPressStyleCssLocator
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-ad755c17727a2114c3c2088c77a48b17cfcd719b9fe66184aa2d829fdfa55193',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/ThemeExtraction/WordPress/WordPressStyleCssLocator.php',
      ),
    ),
    'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
    'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
    'shortName' => 'WordPressStyleCssLocator',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Locates the active WordPress theme stylesheet URL from the HTML carried
 * by a DetectionContext.
 *
 * WordPressStyleCssLocator is responsible only for discovering the active
 * WordPress theme stylesheet by inspecting the HTML already available
 * inside the DetectionContext. It never guesses URLs: every result is
 * discovered from an existing <link rel="stylesheet"> reference and then
 * resolved into an absolute URL against the context\'s final URL.
 *
 * Workflow:
 *
 * DetectionContext
 *   ↓
 * Read HTML
 *   ↓
 * Load DOMDocument
 *   ↓
 * Create DOMXPath
 *   ↓
 * Locate every <link rel="stylesheet">
 *   ↓
 * Inspect href
 *   ↓
 * Find stylesheet belonging to /wp-content/themes/
 *   ↓
 * Return stylesheet URL
 *   ↓
 * Otherwise return null
 *
 * Responsibilities:
 *
 * - Read the HTML body from the given detection context.
 * - Load it into a DOMDocument and inspect every <link rel="stylesheet">.
 * - Select the first href that belongs to /wp-content/themes/ and names a
 *   style.css file.
 * - Resolve the selected href into an absolute URL against the context\'s
 *   final URL, falling back to the original URL.
 * - Return the stylesheet URL, or null when none can be found.
 *
 * Selection rules:
 *
 * A href is treated as a valid theme stylesheet only when it contains both
 * /wp-content/themes/ and style.css. This naturally excludes wp-includes
 * assets, plugin stylesheets (including Elementor and WooCommerce CSS),
 * block library CSS, Google Fonts, and all other external or unrelated
 * stylesheets, because none of them lives under /wp-content/themes/.
 *
 * Design philosophy:
 *
 * - HTML Discovery Engine: the locator discovers URLs that already exist
 *   in the markup; it never assembles or guesses a URL, never appends
 *   /wp-content/themes/, and never assumes the theme directory name.
 * - Single Responsibility Principle: locating the active theme stylesheet
 *   is the only concern. It performs no HTTP requests, no CSS parsing, no
 *   metadata extraction, no confidence calculation, and no WordPress
 *   business rules.
 * - Stateless, deterministic, and side-effect free: given the same
 *   DetectionContext, it always returns the same result.
 * - Dependency Injection friendly: it depends only on the immutable
 *   DetectionContext and the DOM extension.
 *
 * Future architecture:
 *
 * Future versions may extend this locator to also discover child theme
 * stylesheets, editor-style.css, rtl.css, theme.json, and screenshot.png
 * without changing the public API.
 *
 * The class knows nothing about ThemeMetadata or ThemeExtractionResult.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 82,
    'endLine' => 314,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
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
      'locate' => 
      array (
        'name' => 'locate',
        'parameters' => 
        array (
          'context' => 
          array (
            'name' => 'context',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Detection\\DetectionContext',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 101,
            'endLine' => 101,
            'startColumn' => 28,
            'endColumn' => 52,
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
                  'name' => 'string',
                  'isIdentifier' => true,
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
 * Locate the active WordPress theme stylesheet URL.
 *
 * Inspects the HTML already contained inside the given detection
 * context, selects the first <link rel="stylesheet"> href that belongs
 * to /wp-content/themes/ and names a style.css file, and returns that
 * href resolved into an absolute URL against the context\'s final URL
 * (falling back to the original URL). Returns null when the HTML is
 * empty, unparseable, or contains no valid theme stylesheet. The
 * stylesheet is never verified, downloaded, or parsed.
 *
 * @param DetectionContext $context The immutable detection context
 *                                  containing the HTTP response data.
 *
 * @return string|null The absolute active WordPress theme stylesheet
 *                     URL, or null when none can be located.
 */',
        'startLine' => 101,
        'endLine' => 118,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'aliasName' => NULL,
      ),
      'createXPath' => 
      array (
        'name' => 'createXPath',
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
            'startLine' => 132,
            'endLine' => 132,
            'startColumn' => 34,
            'endColumn' => 45,
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
                  'name' => 'DOMXPath',
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
 * Load the HTML into a DOMXPath instance.
 *
 * Malformed HTML warnings are suppressed while loading, and any libxml
 * error state is cleared afterwards. Returns null when the HTML is
 * empty or cannot be parsed.
 *
 * @param string $html The complete HTML source of the target website.
 *
 * @return DOMXPath|null A DOMXPath over the loaded document, or null
 *                       when parsing fails.
 */',
        'startLine' => 132,
        'endLine' => 154,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'aliasName' => NULL,
      ),
      'stylesheetLinks' => 
      array (
        'name' => 'stylesheetLinks',
        'parameters' => 
        array (
          'xpath' => 
          array (
            'name' => 'xpath',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'DOMXPath',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 167,
            'endLine' => 167,
            'startColumn' => 38,
            'endColumn' => 52,
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
            'name' => 'iterable',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Yield the href of every <link rel="stylesheet"> in the document.
 *
 * Attribute values are trimmed, and empty or missing hrefs are
 * skipped. The hrefs are yielded exactly as found in the markup.
 *
 * @param DOMXPath $xpath The DOMXPath over the loaded document.
 *
 * @return iterable<int, string> The stylesheet hrefs found in the
 *                               document.
 */',
        'startLine' => 167,
        'endLine' => 188,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => true,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'aliasName' => NULL,
      ),
      'isThemeStylesheet' => 
      array (
        'name' => 'isThemeStylesheet',
        'parameters' => 
        array (
          'href' => 
          array (
            'name' => 'href',
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
            'startLine' => 203,
            'endLine' => 203,
            'startColumn' => 40,
            'endColumn' => 51,
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
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return whether the given href belongs to an active theme stylesheet.
 *
 * A href qualifies only when it references a file that both lives
 * under the WordPress themes directory (/wp-content/themes/) and is
 * named style.css. Everything else — plugin stylesheets, wp-includes
 * assets, block library CSS, Google Fonts, and external CSS — is
 * rejected by this rule.
 *
 * @param string $href The raw stylesheet href as found in the markup.
 *
 * @return bool True when the href is an active theme stylesheet.
 */',
        'startLine' => 203,
        'endLine' => 207,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'aliasName' => NULL,
      ),
      'normalizeUrl' => 
      array (
        'name' => 'normalizeUrl',
        'parameters' => 
        array (
          'href' => 
          array (
            'name' => 'href',
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
            'startLine' => 224,
            'endLine' => 224,
            'startColumn' => 35,
            'endColumn' => 46,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'context' => 
          array (
            'name' => 'context',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Detection\\DetectionContext',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 224,
            'endLine' => 224,
            'startColumn' => 49,
            'endColumn' => 73,
            'parameterIndex' => 1,
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
 * Resolve a stylesheet href into an absolute URL.
 *
 * Absolute URLs are preserved unchanged. Protocol-relative references
 * receive the base scheme. All other relative references — including
 * root-relative /wp-content/themes/... and ../wp-content/themes/...
 * — are resolved against the context\'s final URL, falling back to the
 * original URL when the final URL is unavailable.
 *
 * @param string            $href    The stylesheet href to resolve.
 * @param DetectionContext  $context The immutable detection context
 *                                   used as the resolution base.
 *
 * @return string The absolute stylesheet URL.
 */',
        'startLine' => 224,
        'endLine' => 237,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'aliasName' => NULL,
      ),
      'resolveUrl' => 
      array (
        'name' => 'resolveUrl',
        'parameters' => 
        array (
          'baseUrl' => 
          array (
            'name' => 'baseUrl',
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
            'startLine' => 252,
            'endLine' => 252,
            'startColumn' => 33,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'href' => 
          array (
            'name' => 'href',
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
            'startLine' => 252,
            'endLine' => 252,
            'startColumn' => 50,
            'endColumn' => 61,
            'parameterIndex' => 1,
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
 * Resolve a relative reference against a base URL.
 *
 * Protocol-relative references are prefixed with the base scheme, and
 * root-relative references are joined to the base origin. All other
 * relative references are joined to the base directory path with any
 * dot segments (./ and ../) removed.
 *
 * @param string $baseUrl The absolute base URL.
 * @param string $href    The relative reference to resolve.
 *
 * @return string The resolved absolute URL.
 */',
        'startLine' => 252,
        'endLine' => 279,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'aliasName' => NULL,
      ),
      'removeDotSegments' => 
      array (
        'name' => 'removeDotSegments',
        'parameters' => 
        array (
          'path' => 
          array (
            'name' => 'path',
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
            'startLine' => 291,
            'endLine' => 291,
            'startColumn' => 40,
            'endColumn' => 51,
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
 * Remove every dot segment (./ and ../) from a path.
 *
 * A leading or trailing slash is preserved as found. Parent
 * references that would rise above the root are dropped.
 *
 * @param string $path The path to normalize.
 *
 * @return string The path with all dot segments removed.
 */',
        'startLine' => 291,
        'endLine' => 313,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssLocator',
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