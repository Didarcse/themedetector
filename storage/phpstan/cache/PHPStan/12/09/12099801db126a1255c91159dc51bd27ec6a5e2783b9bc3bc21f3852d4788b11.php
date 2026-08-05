<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\ThemeExtraction\WordPress\WordPressStyleCssParser.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\ThemeExtraction\WordPress\WordPressStyleCssParser
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-0f351acf152547fb1d25211006460dc87f8093650802ff04ef8080935f661bc1',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/ThemeExtraction/WordPress/WordPressStyleCssParser.php',
      ),
    ),
    'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
    'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
    'shortName' => 'WordPressStyleCssParser',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Parses the metadata header from a WordPress theme style.css file.
 *
 * WordPressStyleCssParser is responsible only for extracting the raw
 * metadata fields declared in the opening header comment of a WordPress
 * theme stylesheet. It reads the stylesheet line by line, inspects only
 * the metadata header, and returns the extracted key/value pairs wrapped
 * in a RawWordPressThemeMetadata transport object. It never parses CSS
 * rules, never validates or normalizes values, and never performs any
 * mapping.
 *
 * Responsibilities:
 *
 * - Read the style.css contents line by line.
 * - Inspect only the metadata header (the opening comment block).
 * - Extract the recognized metadata field names and their values.
 * - Stop parsing as soon as the metadata header ends.
 * - Return the extracted fields as a RawWordPressThemeMetadata.
 *
 * Design philosophy:
 *
 * - Parser: it extracts raw data only and performs no interpretation.
 * - Single Responsibility Principle: extracting the raw metadata header is
 *   the only concern. It performs no validation, no normalization, no
 *   mapping, no HTTP requests, and no confidence calculation.
 * - Line-by-line processing: lightweight matching is applied per header
 *   line only; the stylesheet is never parsed with one large regular
 *   expression, and CSS rules, declarations, and selectors are never
 *   inspected.
 * - Stateless, deterministic, and side-effect free: given the same
 *   style.css contents, it always returns the same fields.
 * - Dependency Injection friendly: it needs no collaborators and depends
 *   only on the style.css string it receives.
 *
 * The class creates no ThemeMetadata, knows nothing about
 * ThemeExtractionResult, and contains no WordPress business rules.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 46,
    'endLine' => 176,
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
      'FIELD_LOOKUP' => 
      array (
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
        'name' => 'FIELD_LOOKUP',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'theme name\' => \'Theme Name\', \'theme uri\' => \'Theme URI\', \'author\' => \'Author\', \'author uri\' => \'Author URI\', \'description\' => \'Description\', \'version\' => \'Version\', \'license\' => \'License\', \'license uri\' => \'License URI\', \'tags\' => \'Tags\', \'text domain\' => \'Text Domain\', \'requires php\' => \'Requires PHP\', \'requires at least\' => \'Requires at least\', \'tested up to\' => \'Tested up to\', \'template\' => \'Template\']',
          'attributes' => 
          array (
            'startLine' => 57,
            'endLine' => 72,
            'startTokenPos' => 42,
            'startFilePos' => 2327,
            'endTokenPos' => 142,
            'endFilePos' => 2855,
          ),
        ),
        'docComment' => '/**
 * The recognized WordPress style.css header fields.
 *
 * Maps the lowercase field name as found in the file to the canonical
 * field name used as the array key, allowing case-insensitive
 * recognition while producing stable, predictable keys.
 *
 * @var array<string, string>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 57,
        'endLine' => 72,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
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
            'startLine' => 83,
            'endLine' => 83,
            'startColumn' => 27,
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
            'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\RawWordPressThemeMetadata',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Parse the metadata header from the given style.css contents.
 *
 * @param string $styleCss The full contents of a WordPress theme
 *                         style.css file.
 *
 * @return RawWordPressThemeMetadata The raw metadata fields extracted
 *                                   from the stylesheet header.
 */',
        'startLine' => 83,
        'endLine' => 86,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
        'aliasName' => NULL,
      ),
      'extractFields' => 
      array (
        'name' => 'extractFields',
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
            'startLine' => 104,
            'endLine' => 104,
            'startColumn' => 36,
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
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Extract the recognized metadata fields from the stylesheet header.
 *
 * Reads the stylesheet line by line. Parsing begins at the first
 * opening comment marker and ends as soon as the comment is closed;
 * everything outside the metadata header — CSS rules, declarations,
 * selectors, and other comments — is ignored. Each header line is
 * examined for a recognized field; only the first occurrence of each
 * field is retained.
 *
 * @param string $styleCss The full contents of a WordPress theme
 *                         style.css file.
 *
 * @return array<string, string> The recognized fields keyed by their
 *                               canonical field name.
 */',
        'startLine' => 104,
        'endLine' => 138,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
        'aliasName' => NULL,
      ),
      'extractFieldLine' => 
      array (
        'name' => 'extractFieldLine',
        'parameters' => 
        array (
          'line' => 
          array (
            'name' => 'line',
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
            'startLine' => 154,
            'endLine' => 154,
            'startColumn' => 39,
            'endColumn' => 50,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
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
            'byRef' => true,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 154,
            'endLine' => 154,
            'startColumn' => 53,
            'endColumn' => 66,
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
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Extract a single recognized field from one metadata header line.
 *
 * Removes decorative comment markers and surrounding whitespace, splits
 * the line at the first colon, and stores the value under its canonical
 * field name when the field is recognized and not already present.
 * Surrounding whitespace is removed from the value; internal whitespace
 * and all other characters are preserved exactly as found in the file.
 *
 * @param string              $line   A single metadata header line.
 * @param array<string,string> $fields The fields collected so far.
 *
 * @return void
 */',
        'startLine' => 154,
        'endLine' => 175,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssParser',
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