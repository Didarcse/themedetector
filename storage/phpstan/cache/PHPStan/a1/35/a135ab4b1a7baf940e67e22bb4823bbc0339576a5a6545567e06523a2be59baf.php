<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\PluginDetection\WordPress\WordPressPluginDetectorComponentTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\PluginDetection\WordPress\WordPressPluginDetectorComponentTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-055e869abd889b2f652dfee9bd91a3247b2bbf476704ab65cf56a91764c23286',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/PluginDetection/WordPress/WordPressPluginDetectorComponentTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
    'name' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
    'shortName' => 'WordPressPluginDetectorComponentTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Component tests for the WordPressPluginDetector orchestration.
 *
 * This suite is a Component Test, not a pure Unit Test: it executes the
 * complete WordPress plugin detection pipeline using the real
 * implementations of every collaborator. It verifies the collaboration
 * between
 *
 * - PluginPathRule,
 * - PluginSlugExtractor, and
 * - PluginMetadataMapper
 *
 * by exercising their real implementations through WordPressPluginDetector
 * and observing the assembled PluginDetectionResult.
 *
 * WordPressPluginDetector is a pure orchestrator. It delegates rule
 * evaluation to PluginPathRule, raw metadata extraction to
 * PluginSlugExtractor, and metadata normalization to PluginMetadataMapper,
 * and it wires their outputs into the assembled PluginDetectionResult. It
 * performs no mapping, no parsing, no confidence calculation, and no
 * business logic of its own.
 *
 * The three collaborators are final readonly classes and therefore cannot
 * be doubled by PHPUnit; they are exercised as real, deterministic
 * objects. Unlike WordPressThemeExtractorComponentTest, this pipeline
 * exposes no interface transport boundary, so per-collaborator invocation
 * counts cannot be observed directly. Orchestration is verified
 * behaviourally through the assembled result only: rule evaluation is
 * proven by the outcome being driven exclusively by the context HTML,
 * slug extraction is proven by the detected plugin slug, and metadata
 * mapping is proven by the normalized PluginMetadata carried by the
 * result.
 *
 * The suite verifies orchestration, collaboration, the assembled
 * PluginDetectionResult, deterministic behaviour, and the immutability of
 * the DetectionContext. It does not test the internals of the individual
 * collaborators, which are covered by their own dedicated test suites.
 *
 * The tests are component tests: behaviour-driven, fast, independent,
 * deterministic, and repeatable.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 57,
    'endLine' => 372,
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
      'URL' => 
      array (
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'name' => 'URL',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'https://example.com\'',
          'attributes' => 
          array (
            'startLine' => 59,
            'endLine' => 59,
            'startTokenPos' => 77,
            'startFilePos' => 2552,
            'endTokenPos' => 77,
            'endFilePos' => 2572,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 59,
        'endLine' => 59,
        'startColumn' => 5,
        'endColumn' => 46,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'detector' => 
      array (
        'name' => 'detector',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\PluginDetection\\WordPress\\WordPressPluginDetector',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Assemble the detector under test from its three real collaborators.
 *
 * @return WordPressPluginDetector The detector under test.
 */',
        'startLine' => 66,
        'endLine' => 73,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'htmlWithPlugins' => 
      array (
        'name' => 'htmlWithPlugins',
        'parameters' => 
        array (
          'slugs' => 
          array (
            'name' => 'slugs',
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
            'isVariadic' => true,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 83,
            'endLine' => 83,
            'startColumn' => 38,
            'endColumn' => 53,
            'parameterIndex' => 0,
            'isOptional' => true,
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
 * Build the HTML of a page referencing the given plugin directories.
 *
 * @param string ...$slugs The plugin directory names referenced by the
 *                         page.
 *
 * @return string HTML referencing /wp-content/plugins/ asset URLs.
 */',
        'startLine' => 83,
        'endLine' => 93,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => true,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'contextWithPlugins' => 
      array (
        'name' => 'contextWithPlugins',
        'parameters' => 
        array (
          'slugs' => 
          array (
            'name' => 'slugs',
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
            'isVariadic' => true,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 103,
            'endLine' => 103,
            'startColumn' => 41,
            'endColumn' => 56,
            'parameterIndex' => 0,
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
 * Create a detection context referencing the given plugin directories.
 *
 * @param string ...$slugs The plugin directory names referenced by the
 *                         page.
 *
 * @return DetectionContext The immutable detection context.
 */',
        'startLine' => 103,
        'endLine' => 111,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => true,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'context' => 
      array (
        'name' => 'context',
        'parameters' => 
        array (
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
 * Create a detection context referencing the default plugin.
 *
 * @return DetectionContext The immutable detection context.
 */',
        'startLine' => 118,
        'endLine' => 121,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'contextWithoutPlugins' => 
      array (
        'name' => 'contextWithoutPlugins',
        'parameters' => 
        array (
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
 * Create a detection context with no plugin path references.
 *
 * @return DetectionContext The immutable detection context.
 */',
        'startLine' => 128,
        'endLine' => 136,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'contextForUrl' => 
      array (
        'name' => 'contextForUrl',
        'parameters' => 
        array (
          'finalUrl' => 
          array (
            'name' => 'finalUrl',
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
            'startLine' => 145,
            'endLine' => 145,
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
            'name' => 'App\\Modules\\Detection\\DetectionContext',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a detection context whose final URL differs from the default.
 *
 * @param string $finalUrl The final URL after redirects.
 *
 * @return DetectionContext The immutable detection context.
 */',
        'startLine' => 145,
        'endLine' => 153,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'test_supports_returns_true_when_plugin_detected' => 
      array (
        'name' => 'test_supports_returns_true_when_plugin_detected',
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
 * Verify that supports() returns true when the pipeline detects a
 * plugin.
 *
 * A context referencing plugin paths yields a successful support
 * decision from the assembled pipeline.
 */',
        'startLine' => 162,
        'endLine' => 165,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'test_supports_returns_false_when_no_plugin_detected' => 
      array (
        'name' => 'test_supports_returns_false_when_no_plugin_detected',
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
 * Verify that supports() returns false when no plugin is detected.
 *
 * A context without plugin path references yields a negative support
 * decision from the assembled pipeline.
 */',
        'startLine' => 173,
        'endLine' => 176,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'test_supports_derives_result_from_plugin_path_rule' => 
      array (
        'name' => 'test_supports_derives_result_from_plugin_path_rule',
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
 * Verify that the support decision is derived from the context.
 *
 * The same detector answers differently for contexts with and without
 * plugin path references, proving the outcome is driven by the
 * supplied context rather than by any fixed value.
 */',
        'startLine' => 185,
        'endLine' => 191,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'test_supports_consumes_context_html' => 
      array (
        'name' => 'test_supports_consumes_context_html',
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
 * Verify that the context HTML drives the support decision.
 *
 * Replacing the context HTML with plugin path references changes the
 * supports() outcome, proving the context HTML is consumed by the
 * pipeline rather than being ignored.
 */',
        'startLine' => 200,
        'endLine' => 206,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'test_supports_handles_varying_context_final_urls' => 
      array (
        'name' => 'test_supports_handles_varying_context_final_urls',
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
 * Verify that the support decision is unaffected by the final URL.
 *
 * Contexts carrying different final URLs are all supported as long as
 * their HTML references plugin paths. The PluginPathRule matches
 * exclusively on the HTML, so varying the final URL does not alter the
 * outcome. Argument-level verification of the final URL handoff would
 * require an observable transport boundary, which this
 * pure-orchestrator pipeline does not expose; this suite therefore
 * verifies the assembled behaviour only.
 */',
        'startLine' => 219,
        'endLine' => 225,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'test_detect_returns_successful_result' => 
      array (
        'name' => 'test_detect_returns_successful_result',
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
 * Verify that a successful pipeline run produces a successful result.
 *
 * The assembled PluginDetectionResult reports the detection and
 * carries the normalized plugin metadata.
 */',
        'startLine' => 233,
        'endLine' => 240,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'test_detect_returns_detected_false_when_no_plugin_detected' => 
      array (
        'name' => 'test_detect_returns_detected_false_when_no_plugin_detected',
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
 * Verify that a failed pipeline run reports detected = false.
 *
 * A context without plugin path references makes the pipeline assemble
 * a failed result.
 */',
        'startLine' => 248,
        'endLine' => 254,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'test_detect_returns_plugin_null_when_detection_fails' => 
      array (
        'name' => 'test_detect_returns_plugin_null_when_detection_fails',
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
 * Verify that a failed pipeline run carries a null plugin.
 */',
        'startLine' => 259,
        'endLine' => 264,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'test_detect_returns_rule_confidence_unchanged' => 
      array (
        'name' => 'test_detect_returns_rule_confidence_unchanged',
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
 * Verify that the rule-provided confidence is carried unchanged.
 *
 * The PluginPathRule reports a fixed confidence of 30, and the
 * assembled result carries that score without any confidence
 * calculation of its own.
 */',
        'startLine' => 273,
        'endLine' => 278,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'test_detect_assembles_normalized_plugin_metadata' => 
      array (
        'name' => 'test_detect_assembles_normalized_plugin_metadata',
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
 * Verify that the assembled result carries normalized plugin metadata.
 *
 * The name and slug mirror the detected plugin slug, and the raw rule
 * metadata is preserved unchanged inside extra(), proving the raw
 * metadata extracted by the slug extractor reached the metadata mapper
 * during the pipeline run.
 */',
        'startLine' => 288,
        'endLine' => 297,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'test_detect_reports_single_primary_plugin_for_multiple_references' => 
      array (
        'name' => 'test_detect_reports_single_primary_plugin_for_multiple_references',
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
 * Verify that multiple plugin references yield a single primary plugin.
 *
 * A page referencing several plugin directories produces a single
 * assembled result carrying one primary plugin: the alphabetically
 * first referenced slug, as produced by the collaborator chain. The
 * selection mechanism itself belongs to PluginPathRule and
 * PluginSlugExtractor and is covered by their dedicated test suites;
 * this suite observes the assembled result only.
 */',
        'startLine' => 309,
        'endLine' => 316,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'test_supports_and_detect_agree' => 
      array (
        'name' => 'test_supports_and_detect_agree',
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
 * Verify that supports() and detect() agree on the same context.
 *
 * A context the detector supports is also detected, and a context the
 * detector does not support is not detected.
 */',
        'startLine' => 324,
        'endLine' => 333,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'test_detect_never_modifies_detection_context' => 
      array (
        'name' => 'test_detect_never_modifies_detection_context',
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
 * Verify that the detection context is never modified.
 *
 * The immutable context carries the same values before and after a
 * full detection run, proving the detector treats it as read-only.
 */',
        'startLine' => 341,
        'endLine' => 351,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'aliasName' => NULL,
      ),
      'test_detect_produces_deterministic_results' => 
      array (
        'name' => 'test_detect_produces_deterministic_results',
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
 * Verify that repeated detection runs are deterministic.
 *
 * Two independently wired detectors over the same context produce
 * equivalent results in every observable field.
 */',
        'startLine' => 359,
        'endLine' => 371,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorComponentTest',
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