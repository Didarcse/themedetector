<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\PluginDetection\WordPress\PluginSlugExtractor.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\PluginDetection\WordPress\PluginSlugExtractor
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-b80e959b646fe6e8166e3409ca437734c61cf6c39e1893029f97592f301c7f52',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\PluginDetection\\WordPress\\PluginSlugExtractor',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/PluginDetection/WordPress/PluginSlugExtractor.php',
      ),
    ),
    'namespace' => 'App\\Modules\\PluginDetection\\WordPress',
    'name' => 'App\\Modules\\PluginDetection\\WordPress\\PluginSlugExtractor',
    'shortName' => 'PluginSlugExtractor',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Converts the PluginPathRule evaluation result into a RawPluginMetadata
 * transport object.
 *
 * PluginSlugExtractor is the transformation layer between the rule
 * system and the metadata mapping layer. It consumes the evaluation
 * result produced by PluginPathRule, extracts the primary plugin slug,
 * and preserves the confidence score together with all remaining rule
 * metadata inside the resulting RawPluginMetadata.
 *
 * Responsibilities:
 *
 * - Read the PluginPathRule evaluation result.
 * - Extract the primary plugin slug.
 * - Preserve the confidence score.
 * - Preserve all remaining rule metadata inside extra().
 * - Return a RawPluginMetadata object.
 * - Return null when no plugin slug can be extracted.
 * - Nothing else.
 *
 * Input:
 *
 * - The extractor accepts the evaluation result returned by
 *   PluginPathRule.
 * - The rule result structure is never modified and is treated as
 *   immutable input.
 *
 * Design philosophy:
 *
 * - Transformer: it converts one representation into another and nothing
 *   more.
 * - Single Responsibility Principle: producing a RawPluginMetadata from a
 *   rule evaluation result is the only concern. It never constructs
 *   PluginMetadata, never performs mapping, never performs detection,
 *   never performs HTTP, never applies regex, and never calculates
 *   confidence.
 * - Stateless, deterministic, and side-effect free: given the same rule
 *   result, it always produces the same RawPluginMetadata.
 *
 * Future Compatibility:
 *
 * - The extractor operates on the rule evaluation result abstraction
 *   rather than relying on the current array implementation details. A
 *   future PluginPathRuleResult value object may replace the array shape
 *   without changing this extractor\'s responsibility.
 * - Future rule implementations may provide richer metadata while this
 *   extractor remains responsible only for producing RawPluginMetadata;
 *   additional rule metadata flows into extra() without modification.
 *
 * The class knows nothing about PluginMetadata, PluginDetectionResult, or
 * the detection workflow that surrounds it.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 59,
    'endLine' => 125,
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
            'startLine' => 80,
            'endLine' => 80,
            'startColumn' => 29,
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
 * Extract raw plugin metadata from a rule evaluation result.
 *
 * Returns null when the rule did not match or yielded no plugin
 * slugs. The first plugin slug in the detected list becomes the
 * primary slug; the list is consumed exactly as provided by the rule
 * and is never reordered by this extractor. The confidence score and
 * the remaining rule metadata are preserved inside the returned
 * RawPluginMetadata. The given rule result is never modified.
 *
 * @param array{
 *     matched: bool,
 *     confidence: int,
 *     metadata: array<string, mixed>
 * } $ruleResult The rule evaluation result produced by PluginPathRule.
 *
 * @return RawPluginMetadata|null The raw plugin metadata, or null when
 *                                no plugin slug was detected.
 */',
        'startLine' => 80,
        'endLine' => 97,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection\\WordPress',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\PluginSlugExtractor',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\PluginSlugExtractor',
        'currentClassName' => 'App\\Modules\\PluginDetection\\WordPress\\PluginSlugExtractor',
        'aliasName' => NULL,
      ),
      'extractPlugins' => 
      array (
        'name' => 'extractPlugins',
        'parameters' => 
        array (
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
            'startLine' => 109,
            'endLine' => 109,
            'startColumn' => 37,
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
 * Extract the detected plugin slug list from the rule metadata.
 *
 * Only string entries are retained, guaranteeing the result is a
 * list<string> regardless of the metadata content.
 *
 * @param array<string, mixed> $metadata The rule metadata array.
 *
 * @return list<string> The detected plugin slugs.
 */',
        'startLine' => 109,
        'endLine' => 124,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\PluginDetection\\WordPress',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\PluginSlugExtractor',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\PluginSlugExtractor',
        'currentClassName' => 'App\\Modules\\PluginDetection\\WordPress\\PluginSlugExtractor',
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