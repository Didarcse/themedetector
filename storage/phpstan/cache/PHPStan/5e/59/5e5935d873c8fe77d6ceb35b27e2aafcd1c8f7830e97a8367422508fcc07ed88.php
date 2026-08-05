<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\ThemeExtraction\WordPress\WordPressThemeMetadataMapper.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\ThemeExtraction\WordPress\WordPressThemeMetadataMapper
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-b1af224ce4656b15f6eed995b204f55fe0150ac3274dd0a02790cd36658c9e78',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapper',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/ThemeExtraction/WordPress/WordPressThemeMetadataMapper.php',
      ),
    ),
    'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
    'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapper',
    'shortName' => 'WordPressThemeMetadataMapper',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Converts RawWordPressThemeMetadata into the ThemeMetadata domain object.
 *
 * WordPressThemeMetadataMapper is responsible only for translating the raw
 * style.css header fields into the canonical, CMS-agnostic ThemeMetadata
 * value object. It applies lightweight normalization (missing fields become
 * null, surrounding whitespace is trimmed) and nothing else: no version or
 * URL validation, no tag splitting, no value inference, and no business
 * logic.
 *
 * Responsibilities:
 *
 * - Translate the recognized raw fields into the corresponding
 *   ThemeMetadata properties.
 * - Normalize each value by trimming surrounding whitespace.
 * - Treat missing fields as null.
 * - Preserve the raw Tags value without splitting it.
 * - Store fields without a dedicated ThemeMetadata property (such as
 *   Tested up to) in the platform-specific extra() array.
 *
 * Design philosophy:
 *
 * - Mapper: it translates data between two representations and nothing
 *   more.
 * - Single Responsibility Principle: translating raw metadata is the only
 *   concern. It performs no HTTP requests, no CSS parsing, no HTML
 *   parsing, no confidence calculation, and no WordPress business rules.
 * - Stateless, deterministic, and side-effect free: given the same raw
 *   metadata, it always produces the same ThemeMetadata.
 * - Dependency Injection friendly: it needs no collaborators and depends
 *   only on the RawWordPressThemeMetadata it receives.
 *
 * The class creates no ThemeExtractionResult and knows nothing about the
 * extraction workflow that surrounds it.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 44,
    'endLine' => 117,
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
                'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\RawWordPressThemeMetadata',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 61,
            'endLine' => 61,
            'startColumn' => 25,
            'endColumn' => 54,
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
            'name' => 'App\\Modules\\ThemeExtraction\\ThemeMetadata',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Map the raw metadata to a ThemeMetadata value object.
 *
 * Recognized fields are translated to their ThemeMetadata counterpart.
 * Fields that are missing from the raw metadata map to null (or the
 * empty string for the required theme name). The Tags value is
 * preserved as a single-element array without splitting, and Tested up
 * to is stored under the \'tested_up_to\' key of the extra() array since
 * ThemeMetadata exposes no dedicated property for it.
 *
 * @param RawWordPressThemeMetadata $raw The raw metadata extracted from
 *                                       the style.css header.
 *
 * @return ThemeMetadata The normalized ThemeMetadata value object.
 */',
        'startLine' => 61,
        'endLine' => 90,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapper',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapper',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapper',
        'aliasName' => NULL,
      ),
      'value' => 
      array (
        'name' => 'value',
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
            'startLine' => 105,
            'endLine' => 105,
            'startColumn' => 28,
            'endColumn' => 40,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'key' => 
          array (
            'name' => 'key',
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
            'startLine' => 105,
            'endLine' => 105,
            'startColumn' => 43,
            'endColumn' => 53,
            'parameterIndex' => 1,
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
 * Return the trimmed value for the given field, or null.
 *
 * Missing fields, as well as fields that are empty after trimming, are
 * treated as null. Surrounding whitespace is removed; internal
 * whitespace and casing are preserved exactly as found.
 *
 * @param array<string, string> $fields The raw metadata fields.
 * @param string                $key    The canonical field name.
 *
 * @return string|null The trimmed field value, or null when the field
 *                     is missing or empty.
 */',
        'startLine' => 105,
        'endLine' => 116,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapper',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapper',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressThemeMetadataMapper',
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