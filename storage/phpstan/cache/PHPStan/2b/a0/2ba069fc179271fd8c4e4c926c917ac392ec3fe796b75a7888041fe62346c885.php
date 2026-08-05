<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\PluginDetection\WordPress\WordPressPluginDetector.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\PluginDetection\WordPress\WordPressPluginDetector
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-61709094d3f646e1cc3e4e0b4068c573324ca8fa37261ec6f517e4a66590bd09',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/PluginDetection/WordPress/WordPressPluginDetector.php',
      ),
    ),
    'namespace' => 'App\\Modules\\PluginDetection\\WordPress',
    'name' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
    'shortName' => 'WordPressPluginDetector',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Orchestrates the complete WordPress plugin detection workflow.
 *
 * WordPressPluginDetector is the orchestration layer of the WordPress
 * plugin detection pipeline. It coordinates a fixed sequence of dedicated
 * collaborators — evaluating the PluginPathRule, extracting the plugin
 * slugs, and mapping the raw metadata — and assembles the resulting
 * PluginDetectionResult from their outputs. It is a thin facade: it
 * performs no work itself other than delegating each step and wiring the
 * results together.
 *
 * Pipeline:
 *
 * DetectionContext
 *   ↓
 * PluginPathRule
 *   ↓
 * PluginSlugExtractor
 *   ↓
 * RawPluginMetadata
 *   ↓
 * PluginMetadataMapper
 *   ↓
 * PluginMetadata
 *   ↓
 * PluginDetectionResult
 *
 * Responsibilities:
 *
 * - Determine whether the supplied DetectionContext belongs to a
 *   WordPress website.
 * - Delegate plugin detection to PluginPathRule.
 * - Delegate plugin slug extraction to PluginSlugExtractor.
 * - Delegate metadata mapping to PluginMetadataMapper.
 * - Assemble and return the resulting PluginDetectionResult.
 * - Return a failed PluginDetectionResult when no plugin was detected.
 *
 * MVP scope:
 *
 * - The only plugin detection rule used is PluginPathRule.
 * - Additional rules — CssAssetRule, JsAssetRule, HtmlFingerprintRule,
 *   and RestApiRule — must not be implemented yet.
 *
 * Design philosophy:
 *
 * - Facade: WordPressPluginDetector is the single public entry point for
 *   WordPress plugin detection.
 * - Orchestrator: it wires the workflow steps together and nothing more.
 * - Single Responsibility Principle: orchestration only. It never
 *   inspects rule metadata arrays, never interprets metadata, never maps
 *   metadata, never constructs PluginMetadata, never makes business
 *   decisions, never performs HTTP requests, never parses HTML, and never
 *   calculates confidence.
 * - Dependency Injection: every collaborator is provided through the
 *   constructor, making the pipeline fully testable and interchangeable.
 * - Open/Closed Principle: collaborator behavior can evolve without
 *   modifying this class, and new workflow steps are introduced by new
 *   collaborators.
 * - Stateless, deterministic, and side-effect free: given the same
 *   DetectionContext, it always produces the same PluginDetectionResult,
 *   and its only observable effects are the delegated collaborator calls.
 *
 * Future Compatibility:
 *
 * - Future collaborators — PluginSlugExtractor, RawPluginMetadata,
 *   PluginMetadataMapper, CssAssetRule, JsAssetRule, HtmlFingerprintRule,
 *   and RestApiRule — will be integrated through dependency injection
 *   without modifying this detector itself.
 *
 * The class contains no regular expressions, no metadata interpretation,
 * no metadata mapping, no business decisions, no confidence calculation,
 * and no HTTP requests.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 85,
    'endLine' => 185,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Modules\\PluginDetection\\Contracts\\PluginDetectorInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'pluginPathRule' => 
      array (
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'name' => 'pluginPathRule',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\PluginDetection\\WordPress\\Rules\\PluginPathRule',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 103,
        'endLine' => 103,
        'startColumn' => 9,
        'endColumn' => 46,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'pluginSlugExtractor' => 
      array (
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'name' => 'pluginSlugExtractor',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\PluginDetection\\WordPress\\PluginSlugExtractor',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 104,
        'endLine' => 104,
        'startColumn' => 9,
        'endColumn' => 56,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'pluginMetadataMapper' => 
      array (
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'name' => 'pluginMetadataMapper',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\PluginDetection\\WordPress\\PluginMetadataMapper',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 105,
        'endLine' => 105,
        'startColumn' => 9,
        'endColumn' => 58,
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
          'pluginPathRule' => 
          array (
            'name' => 'pluginPathRule',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\PluginDetection\\WordPress\\Rules\\PluginPathRule',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 103,
            'endLine' => 103,
            'startColumn' => 9,
            'endColumn' => 46,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'pluginSlugExtractor' => 
          array (
            'name' => 'pluginSlugExtractor',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\PluginDetection\\WordPress\\PluginSlugExtractor',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 104,
            'endLine' => 104,
            'startColumn' => 9,
            'endColumn' => 56,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'pluginMetadataMapper' => 
          array (
            'name' => 'pluginMetadataMapper',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\PluginDetection\\WordPress\\PluginMetadataMapper',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 105,
            'endLine' => 105,
            'startColumn' => 9,
            'endColumn' => 58,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a new WordPressPluginDetector.
 *
 * @param PluginPathRule       $pluginPathRule       Evaluates the HTML
 *                                                   for WordPress plugin
 *                                                   path references.
 * @param PluginSlugExtractor  $pluginSlugExtractor  Extracts the raw
 *                                                   plugin metadata from
 *                                                   the rule evaluation
 *                                                   result.
 * @param PluginMetadataMapper $pluginMetadataMapper Maps the raw plugin
 *                                                   metadata to a
 *                                                   normalized
 *                                                   PluginMetadata.
 */',
        'startLine' => 102,
        'endLine' => 107,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection\\WordPress',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'currentClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'aliasName' => NULL,
      ),
      'supports' => 
      array (
        'name' => 'supports',
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
            'startLine' => 122,
            'endLine' => 122,
            'startColumn' => 30,
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
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Determine whether the supplied detection context belongs to a
 * WordPress website.
 *
 * For the MVP, WordPress is recognized through the PluginPathRule:
 * when the context HTML references /wp-content/plugins/ asset URLs,
 * the website is treated as WordPress.
 *
 * @param DetectionContext $context The immutable detection context
 *                                  containing the HTTP response data.
 *
 * @return bool True when the context belongs to a WordPress website.
 */',
        'startLine' => 122,
        'endLine' => 127,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection\\WordPress',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'currentClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'aliasName' => NULL,
      ),
      'detect' => 
      array (
        'name' => 'detect',
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
            'startLine' => 152,
            'endLine' => 152,
            'startColumn' => 28,
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
            'name' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Detect a WordPress plugin from the given detection context.
 *
 * Coordinates the dedicated collaborators in order and returns the
 * assembled result:
 *
 * - Evaluate the PluginPathRule against the context HTML and URL.
 * - Extract the raw plugin metadata through PluginSlugExtractor.
 * - Map the raw metadata to a normalized PluginMetadata.
 * - Assemble the resulting PluginDetectionResult.
 *
 * When no plugin is detected, a failed PluginDetectionResult is
 * returned. The rule-provided confidence is carried through the raw
 * metadata unchanged; this detector never calculates confidence
 * itself. The given DetectionContext is never modified.
 *
 * @param DetectionContext $context The immutable detection context
 *                                  containing the HTTP response data.
 *
 * @return PluginDetectionResult The normalized WordPress plugin
 *                               detection result, or a failed result
 *                               when no plugin was detected.
 */',
        'startLine' => 152,
        'endLine' => 167,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection\\WordPress',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'currentClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'aliasName' => NULL,
      ),
      'notDetected' => 
      array (
        'name' => 'notDetected',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\PluginDetection\\PluginDetectionResult',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return a PluginDetectionResult representing a failed detection.
 *
 * Used when no WordPress plugin could be detected, so that a
 * deterministic result is always produced.
 *
 * @return PluginDetectionResult The failed plugin detection result.
 */',
        'startLine' => 177,
        'endLine' => 184,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\PluginDetection\\WordPress',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
        'currentClassName' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
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