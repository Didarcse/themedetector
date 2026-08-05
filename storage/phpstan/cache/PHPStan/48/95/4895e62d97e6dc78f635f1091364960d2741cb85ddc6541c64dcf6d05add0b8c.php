<?php declare(strict_types = 1);

// osfsl-C:\xampp\htdocs\themedetector\app\Modules\PluginDetection\WordPress\WordPressPluginDetector.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\PluginDetection\WordPress\WordPressPluginDetector
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-63c13fdea7b4e36bcc0db818f995e9e34bf34ddbea23db1b9fd39bcd294932d3-8.2-6.70.0.3',
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
 * Orchestrates WordPress plugin detection.
 *
 * WordPressPluginDetector is the first concrete implementation of
 * PluginDetectorInterface. It coordinates the WordPress plugin detection
 * workflow: it determines whether the supplied detection context belongs
 * to a WordPress website, delegates plugin detection to dedicated rule
 * objects, and assembles the resulting PluginDetectionResult. It is a thin
 * facade: it performs no work itself other than delegating each step and
 * wiring the results together.
 *
 * Responsibilities:
 *
 * - Determine whether the supplied DetectionContext belongs to a
 *   WordPress website.
 * - Delegate plugin detection to dedicated rule objects.
 * - Return the resulting PluginDetectionResult.
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
 * - Orchestrator: it wires the dedicated rule to the given context and
 *   nothing more.
 * - Single Responsibility Principle: orchestration only. It never
 *   contains regular expressions, never parses HTML, never inspects CSS
 *   or JS assets, never performs REST API detection, never performs HTTP
 *   requests, and never calculates confidence.
 * - Dependency Injection: the plugin detection rule is provided through
 *   the constructor, making the workflow fully testable and
 *   interchangeable.
 * - Open/Closed Principle: rule behavior can evolve without modifying
 *   this class, and new workflow steps are introduced by new
 *   collaborators.
 * - Platform-specific implementation: this detector knows it targets
 *   WordPress while remaining stateless, deterministic, and side-effect
 *   free.
 *
 * Future Compatibility:
 *
 * - Future plugin detection rules — CssAssetRule, JsAssetRule,
 *   HtmlFingerprintRule, and RestApiRule — will be added through
 *   constructor dependency injection without modifying this detector.
 *
 * The class contains no regular expressions, no CSS parsing, no JS
 * parsing, no HTML fingerprint detection, no REST API detection, no HTTP
 * requests, and no confidence calculation.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 67,
    'endLine' => 196,
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
            'name' => 'App\\Modules\\Detection\\WordPress\\Rules\\PluginPathRule',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 78,
        'endLine' => 78,
        'startColumn' => 9,
        'endColumn' => 46,
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
                'name' => 'App\\Modules\\Detection\\WordPress\\Rules\\PluginPathRule',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 78,
            'endLine' => 78,
            'startColumn' => 9,
            'endColumn' => 46,
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
 * Create a new WordPressPluginDetector.
 *
 * @param PluginPathRule $pluginPathRule Detects WordPress plugins
 *                                       referenced in HTML by scanning
 *                                       asset URLs that contain
 *                                       /wp-content/plugins/.
 */',
        'startLine' => 77,
        'endLine' => 80,
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
            'startLine' => 95,
            'endLine' => 95,
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
        'startLine' => 95,
        'endLine' => 100,
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
            'startLine' => 120,
            'endLine' => 120,
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
 * Delegates plugin detection to the dedicated PluginPathRule and
 * assembles the resulting PluginDetectionResult. For the MVP, the
 * first alphabetically ordered plugin slug represents the detected
 * plugin metadata, and the complete set of detected slugs is carried
 * in extra() under the "plugins" key. The rule-provided confidence is
 * passed through unchanged; this detector never calculates confidence
 * itself. The given DetectionContext is never modified.
 *
 * @param DetectionContext $context The immutable detection context
 *                                  containing the HTTP response data.
 *
 * @return PluginDetectionResult The normalized WordPress plugin
 *                               detection result, or a failed result
 *                               when no plugin was detected.
 */',
        'startLine' => 120,
        'endLine' => 145,
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
      'extractPlugins' => 
      array (
        'name' => 'extractPlugins',
        'parameters' => 
        array (
          'result' => 
          array (
            'name' => 'result',
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
            'startLine' => 161,
            'endLine' => 161,
            'startColumn' => 37,
            'endColumn' => 49,
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
 * Extract the detected plugin list from the rule result metadata.
 *
 * Only string entries are retained, guaranteeing the result is a
 * list<string> regardless of the metadata content.
 *
 * @param array{
 *     matched: bool,
 *     confidence: int,
 *     metadata: array<string, mixed>
 * } $result The rule evaluation result.
 *
 * @return list<string> The detected plugin names.
 */',
        'startLine' => 161,
        'endLine' => 178,
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
        'startLine' => 188,
        'endLine' => 195,
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