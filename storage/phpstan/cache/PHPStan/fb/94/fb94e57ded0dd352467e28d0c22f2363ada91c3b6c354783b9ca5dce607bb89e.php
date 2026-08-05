<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\PluginDetection\WordPress\RawPluginMetadata.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\PluginDetection\WordPress\RawPluginMetadata
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-da89f1325d649f897ff58e905eae98631982d118b8701e96255196af16abf234',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/PluginDetection/WordPress/RawPluginMetadata.php',
      ),
    ),
    'namespace' => 'App\\Modules\\PluginDetection\\WordPress',
    'name' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
    'shortName' => 'RawPluginMetadata',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Raw metadata extracted directly from the WordPress plugin detection
 * rules.
 *
 * RawPluginMetadata is an immutable transport object exchanged between
 * the plugin detection rules and PluginMetadataMapper. It carries the raw
 * plugin metadata exactly as it was produced by the detection rules,
 * without interpretation of any kind.
 *
 * Responsibilities:
 *
 * - Store raw plugin metadata (slug, confidence, and additional
 *   platform-specific data).
 * - Expose it through typed getters.
 * - Nothing else.
 *
 * Design philosophy:
 *
 * - Transport Object: it exists only to carry data from the detection
 *   rules to the mapper and performs no processing of its own.
 * - No validation, no normalization, no mapping, no parsing, and no
 *   business logic: values are stored and returned exactly as supplied.
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Stateless, deterministic, and side-effect free.
 *
 * Future Compatibility:
 *
 * - Future rules may populate additional metadata through the extra()
 *   array without changing the responsibility of this object.
 *
 * The class knows nothing about PluginMetadata, PluginDetectionResult, or
 * the detection workflow that surrounds it; it is a plain,
 * platform-neutral field container.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 41,
    'endLine' => 86,
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
      'slug' => 
      array (
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'name' => 'slug',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 50,
        'endLine' => 50,
        'startColumn' => 9,
        'endColumn' => 28,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'confidence' => 
      array (
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'name' => 'confidence',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '0',
          'attributes' => 
          array (
            'startLine' => 51,
            'endLine' => 51,
            'startTokenPos' => 51,
            'startFilePos' => 1813,
            'endTokenPos' => 51,
            'endFilePos' => 1813,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 51,
        'endLine' => 51,
        'startColumn' => 9,
        'endColumn' => 35,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'extra' => 
      array (
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'name' => 'extra',
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
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 52,
            'endLine' => 52,
            'startTokenPos' => 62,
            'startFilePos' => 1847,
            'endTokenPos' => 63,
            'endFilePos' => 1848,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 52,
        'endLine' => 52,
        'startColumn' => 9,
        'endColumn' => 33,
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
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 50,
            'endLine' => 50,
            'startColumn' => 9,
            'endColumn' => 28,
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
                'startLine' => 51,
                'endLine' => 51,
                'startTokenPos' => 51,
                'startFilePos' => 1813,
                'endTokenPos' => 51,
                'endFilePos' => 1813,
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
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 51,
            'endLine' => 51,
            'startColumn' => 9,
            'endColumn' => 35,
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
                'startLine' => 52,
                'endLine' => 52,
                'startTokenPos' => 62,
                'startFilePos' => 1847,
                'endTokenPos' => 63,
                'endFilePos' => 1848,
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
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 52,
            'endLine' => 52,
            'startColumn' => 9,
            'endColumn' => 33,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param string               $slug       The detected plugin slug.
 * @param int                  $confidence The rule-provided confidence
 *                                         score.
 * @param array<string, mixed> $extra      Additional raw metadata.
 */',
        'startLine' => 49,
        'endLine' => 54,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection\\WordPress',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'currentClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'aliasName' => NULL,
      ),
      'slug' => 
      array (
        'name' => 'slug',
        'parameters' => 
        array (
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
 * Return the detected plugin slug.
 *
 * @return string The detected plugin slug, exactly as supplied.
 */',
        'startLine' => 61,
        'endLine' => 64,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection\\WordPress',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'currentClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'aliasName' => NULL,
      ),
      'confidence' => 
      array (
        'name' => 'confidence',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return the rule-provided confidence score.
 *
 * @return int The rule-provided confidence score, exactly as supplied.
 */',
        'startLine' => 71,
        'endLine' => 74,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection\\WordPress',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'currentClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'aliasName' => NULL,
      ),
      'extra' => 
      array (
        'name' => 'extra',
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
 * Return the additional raw metadata.
 *
 * @return array<string, mixed> The additional raw metadata, exactly as
 *                              supplied.
 */',
        'startLine' => 82,
        'endLine' => 85,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection\\WordPress',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
        'currentClassName' => 'App\\Modules\\PluginDetection\\WordPress\\RawPluginMetadata',
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