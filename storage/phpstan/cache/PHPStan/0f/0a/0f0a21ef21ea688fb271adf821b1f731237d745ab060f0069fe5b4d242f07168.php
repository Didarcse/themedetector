<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\PluginDetection\WordPress\PluginMetadataMapper.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\PluginDetection\WordPress\PluginMetadataMapper
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-a61f5f6bfbaa50ebc6734583830430f8c1b4d3fdd47d0df23793f210cfe7a362',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\PluginDetection\\WordPress\\PluginMetadataMapper',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/PluginDetection/WordPress/PluginMetadataMapper.php',
      ),
    ),
    'namespace' => 'App\\Modules\\PluginDetection\\WordPress',
    'name' => 'App\\Modules\\PluginDetection\\WordPress\\PluginMetadataMapper',
    'shortName' => 'PluginMetadataMapper',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Converts RawPluginMetadata into the PluginMetadata domain object.
 *
 * PluginMetadataMapper is the metadata translation layer between the raw
 * plugin detection pipeline and the normalized domain model. It is
 * responsible only for translating the raw plugin metadata into the
 * canonical, CMS-agnostic PluginMetadata value object. It applies a
 * direct translation and nothing else: no value inference, no name
 * normalization, no version validation, and no business logic.
 *
 * Mapping:
 *
 * RawPluginMetadata
 *   ↓
 * slug
 *   ↓
 * PluginMetadata::slug
 *   ↓
 * PluginMetadata::name
 *   ↓
 * extra
 *   ↓
 * PluginMetadata::extra
 *
 * Responsibilities:
 *
 * - Translate the raw plugin metadata into a PluginMetadata value object.
 * - Map the plugin slug.
 * - Populate PluginMetadata using the available raw metadata.
 * - Preserve all platform-specific metadata inside extra().
 * - Treat missing metadata as null.
 * - Nothing else.
 *
 * Mapping rules:
 *
 * - The slug is mapped directly onto PluginMetadata::slug and
 *   PluginMetadata::name without inference or normalization.
 * - The extra array is preserved unchanged inside PluginMetadata::extra.
 * - The mapper never infers values, never normalizes plugin names, never
 *   validates versions, never splits tags, and never modifies the
 *   supplied metadata.
 *
 * Design philosophy:
 *
 * - Mapper: it translates data between two representations and nothing
 *   more.
 * - Single Responsibility Principle: translating raw metadata is the only
 *   concern. It performs no detection, no parsing, no validation, no
 *   confidence calculation, and no WordPress business rules.
 * - Immutable Mapping: the supplied RawPluginMetadata is never modified,
 *   and the produced PluginMetadata is a fresh, immutable value object.
 * - Stateless, deterministic, and side-effect free: given the same raw
 *   metadata, it always produces the same PluginMetadata.
 * - Dependency Injection friendly: it needs no collaborators and depends
 *   only on the RawPluginMetadata it receives.
 *
 * Future Compatibility:
 *
 * - Future metadata fields — version, author, description, license, tags,
 *   PHP requirements, CMS requirements, and other platform-specific
 *   metadata — may be mapped without changing the responsibility of this
 *   class.
 *
 * The class creates no PluginDetectionResult and knows nothing about the
 * detection workflow that surrounds it.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 75,
    'endLine' => 99,
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
            'startLine' => 89,
            'endLine' => 89,
            'startColumn' => 25,
            'endColumn' => 46,
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
 * Map the raw metadata to a PluginMetadata value object.
 *
 * The plugin slug becomes the plugin name and, when present, the
 * plugin slug; an empty slug is treated as missing and maps to null
 * for the nullable slug property. The additional raw metadata is
 * preserved unchanged inside the extra() array.
 *
 * @param RawPluginMetadata $raw The raw plugin metadata.
 *
 * @return PluginMetadata The normalized PluginMetadata value object.
 */',
        'startLine' => 89,
        'endLine' => 98,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection\\WordPress',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\PluginMetadataMapper',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\PluginMetadataMapper',
        'currentClassName' => 'App\\Modules\\PluginDetection\\WordPress\\PluginMetadataMapper',
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