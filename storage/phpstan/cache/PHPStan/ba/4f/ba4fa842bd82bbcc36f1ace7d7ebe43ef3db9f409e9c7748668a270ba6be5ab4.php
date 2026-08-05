<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\ThemeExtraction\WordPress\RawWordPressThemeMetadata.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\ThemeExtraction\WordPress\RawWordPressThemeMetadata
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-9e7af1ad8fb1e4d241c104401d9ea0e7385c25fae7a46524bcfcb73268f8aae2',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\RawWordPressThemeMetadata',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/ThemeExtraction/WordPress/RawWordPressThemeMetadata.php',
      ),
    ),
    'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
    'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\RawWordPressThemeMetadata',
    'shortName' => 'RawWordPressThemeMetadata',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Raw metadata extracted directly from a WordPress style.css file.
 *
 * RawWordPressThemeMetadata is a temporary transport object exchanged
 * between WordPressStyleCssParser and WordPressThemeMetadataMapper. It
 * carries the style.css header fields exactly as they were read from the
 * file, without interpretation of any kind.
 *
 * Responsibilities:
 *
 * - Store the raw style.css metadata fields.
 * - Expose them through the fields() accessor.
 *
 * Design philosophy:
 *
 * - Transport Object: it exists only to carry data from the parser to the
 *   mapper and performs no processing of its own.
 * - No validation, no normalization, no mapping, and no business logic:
 *   values are stored and returned exactly as supplied.
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Stateless, deterministic, and side-effect free.
 *
 * The class knows nothing about ThemeMetadata, WordPress, or any other
 * platform; it is a plain, platform-neutral field container.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 32,
    'endLine' => 53,
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
      'rawFields' => 
      array (
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\RawWordPressThemeMetadata',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\RawWordPressThemeMetadata',
        'name' => 'rawFields',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 39,
        'endLine' => 39,
        'startColumn' => 9,
        'endColumn' => 32,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'rawFields' => 
          array (
            'name' => 'rawFields',
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
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 39,
            'endLine' => 39,
            'startColumn' => 9,
            'endColumn' => 32,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param array<string, string> $rawFields The raw style.css metadata
 *                                         fields keyed by field name.
 */',
        'startLine' => 38,
        'endLine' => 41,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\RawWordPressThemeMetadata',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\RawWordPressThemeMetadata',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\RawWordPressThemeMetadata',
        'aliasName' => NULL,
      ),
      'fields' => 
      array (
        'name' => 'fields',
        'parameters' => 
        array (
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
 * Return the raw style.css metadata fields.
 *
 * @return array<string, string> The raw metadata fields keyed by field
 *                               name, exactly as supplied.
 */',
        'startLine' => 49,
        'endLine' => 52,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\RawWordPressThemeMetadata',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\RawWordPressThemeMetadata',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\RawWordPressThemeMetadata',
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