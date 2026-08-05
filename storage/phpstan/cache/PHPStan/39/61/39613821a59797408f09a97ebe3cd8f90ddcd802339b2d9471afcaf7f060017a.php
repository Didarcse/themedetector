<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\PluginDetection\WordPress\WordPressPluginDetectorTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\PluginDetection\WordPress\WordPressPluginDetectorTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-7a579d086ea135d1b8d4344e081c50c4c7b91d6153e3384b49626d1836105ef0',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/PluginDetection/WordPress/WordPressPluginDetectorTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
    'name' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
    'shortName' => 'WordPressPluginDetectorTest',
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
 * by exercising their real implementations through
 * WordPressPluginDetector and observing the assembled
 * PluginDetectionResult.
 *
 * The detector is a pure orchestrator: it delegates rule evaluation,
 * slug extraction, and metadata mapping to its collaborators and wires
 * the assembled result together, performing no business logic of its own.
 *
 * The three collaborators are exercised as real, deterministic objects;
 * they are final readonly classes and therefore cannot be doubled by
 * PHPUnit. This suite therefore cannot observe per-collaborator
 * invocation counts directly, since the pipeline exposes no mocked
 * transport boundary. Orchestration is verified behaviourally through
 * the assembled result: rule evaluation is proven by the outcome being
 * driven exclusively by the context HTML, slug extraction is proven by
 * the detected plugin slug, and metadata mapping is proven by the
 * normalized PluginMetadata carried by the result.
 *
 * The tests are component tests: behaviour-driven, fast, independent,
 * deterministic, and repeatable. They verify collaboration and
 * orchestration only; they never test the internals of the individual
 * collaborators, which are covered by their own dedicated test suites.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 51,
    'endLine' => 365,
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
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'name' => 'URL',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'https://example.com\'',
          'attributes' => 
          array (
            'startLine' => 53,
            'endLine' => 53,
            'startTokenPos' => 77,
            'startFilePos' => 2229,
            'endTokenPos' => 77,
            'endFilePos' => 2249,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 53,
        'endLine' => 53,
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
 * Assemble the detector under test from its three collaborators.
 *
 * @return WordPressPluginDetector The detector under test.
 */',
        'startLine' => 60,
        'endLine' => 67,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
            'startLine' => 77,
            'endLine' => 77,
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
        'startLine' => 77,
        'endLine' => 87,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => true,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
            'startLine' => 97,
            'endLine' => 97,
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
        'startLine' => 97,
        'endLine' => 105,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => true,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
        'startLine' => 112,
        'endLine' => 115,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
        'startLine' => 122,
        'endLine' => 130,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
            'startLine' => 139,
            'endLine' => 139,
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
        'startLine' => 139,
        'endLine' => 147,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
 * Verify that supports() returns true when the rule detects a plugin.
 *
 * The real rule evaluates the context HTML and yields raw metadata,
 * which is the observable outcome that makes the detector answer true.
 */',
        'startLine' => 155,
        'endLine' => 158,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
 * A context without plugin path references makes the real rule yield
 * no raw metadata, which makes the detector answer false.
 */',
        'startLine' => 166,
        'endLine' => 169,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
 * Verify that supports() derives its answer from the rule evaluation.
 *
 * The same detector answers differently for contexts with and without
 * plugin path references, proving the outcome is driven exclusively by
 * the PluginPathRule evaluation over the supplied context and not by
 * any fixed value.
 */',
        'startLine' => 179,
        'endLine' => 185,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
 * Verify that the context HTML is passed to the plugin path rule.
 *
 * Replacing the context HTML with plugin path references changes the
 * supports() outcome, proving the context HTML flows into the rule
 * evaluation rather than being ignored.
 */',
        'startLine' => 194,
        'endLine' => 200,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'aliasName' => NULL,
      ),
      'test_supports_accepts_context_final_url' => 
      array (
        'name' => 'test_supports_accepts_context_final_url',
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
 * Verify that the context final URL is accepted by the plugin path
 * rule.
 *
 * Contexts carrying different final URLs are all supported as long as
 * their HTML references plugin paths. The current PluginPathRule
 * matches exclusively on the HTML, so the final URL is handed through
 * the pipeline without altering the outcome; argument-level
 * verification of the URL would require an observable transport
 * boundary, which this pure-orchestrator architecture does not expose.
 */',
        'startLine' => 213,
        'endLine' => 219,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
 * The rule detects the plugin path, the extractor produces raw
 * metadata, the mapper normalizes it, and the detector assembles a
 * PluginDetectionResult reporting the detection.
 */',
        'startLine' => 228,
        'endLine' => 235,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
 * A context without plugin path references yields no raw metadata,
 * making the detector assemble a failed result.
 */',
        'startLine' => 243,
        'endLine' => 249,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
        'startLine' => 254,
        'endLine' => 259,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
 * Verify that the rule-provided confidence is preserved unchanged.
 *
 * The PluginPathRule reports a fixed confidence of 30; the detector
 * carries that score through the raw metadata into the result without
 * calculating any confidence of its own.
 */',
        'startLine' => 268,
        'endLine' => 273,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'aliasName' => NULL,
      ),
      'test_detect_maps_extracted_plugin_metadata' => 
      array (
        'name' => 'test_detect_maps_extracted_plugin_metadata',
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
 * Verify that the detected plugin metadata is mapped by the mapper.
 *
 * The normalized PluginMetadata carried by the result proves the raw
 * metadata extracted by the slug extractor was handed to the mapper:
 * the name and slug mirror the extracted slug, and the raw rule
 * metadata is preserved unchanged inside extra().
 */',
        'startLine' => 283,
        'endLine' => 292,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'aliasName' => NULL,
      ),
      'test_detect_uses_first_referenced_plugin_slug' => 
      array (
        'name' => 'test_detect_uses_first_referenced_plugin_slug',
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
 * Verify that the primary plugin slug comes from the rule output.
 *
 * When the page references several plugin directories, the rule
 * returns them sorted alphabetically and the extractor consumes the
 * first entry, so the mapped slug is the alphabetically first
 * referenced plugin.
 */',
        'startLine' => 302,
        'endLine' => 309,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
        'startLine' => 317,
        'endLine' => 326,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
        'startLine' => 334,
        'endLine' => 344,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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
        'startLine' => 352,
        'endLine' => 364,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\PluginDetection\\WordPress',
        'declaringClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'implementingClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
        'currentClassName' => 'Tests\\Unit\\PluginDetection\\WordPress\\WordPressPluginDetectorTest',
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