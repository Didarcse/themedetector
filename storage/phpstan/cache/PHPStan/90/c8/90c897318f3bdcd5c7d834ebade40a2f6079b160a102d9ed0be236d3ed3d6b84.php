<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\PluginDetection\WordPress\Rules\PluginPathRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\PluginDetection\WordPress\Rules\PluginPathRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-cc6760ed7f53dd5e82e57ca7df4a30497291322b0e4ed6aef656a697e4ab87e0',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\PluginDetection\\WordPress\\Rules\\PluginPathRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/PluginDetection/WordPress/Rules/PluginPathRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\PluginDetection\\WordPress\\Rules',
    'name' => 'App\\Modules\\PluginDetection\\WordPress\\Rules\\PluginPathRule',
    'shortName' => 'PluginPathRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects WordPress plugins referenced in HTML by scanning asset URLs
 * that contain /wp-content/plugins/.
 *
 * PluginPathRule is the canonical plugin-path detection rule for the
 * Plugin Detection Engine. It inspects the HTML already carried by the
 * detection context, extracts the unique plugin slugs referenced by
 * /wp-content/plugins/ asset URLs, and returns them sorted
 * alphabetically, preserving their original spelling.
 *
 * Responsibilities:
 *
 * - Scan the HTML for asset URLs that contain /wp-content/plugins/.
 * - Extract the referenced plugin slugs.
 * - Return the unique slugs, sorted alphabetically.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: evaluating the HTML for WordPress
 *   plugin path references is the only concern. It performs no HTTP
 *   requests, no metadata mapping, no confidence calculation, and no
 *   business rules.
 * - Stateless, deterministic, and side-effect free: given the same HTML
 *   and URL, it always returns the same result.
 * - Platform-specific implementation: this rule knows it targets
 *   WordPress plugin paths.
 *
 * The class belongs to the Plugin Detection module and knows nothing
 * about PluginMetadata, PluginDetectionResult, or the detection workflow
 * that surrounds it.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 38,
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
      'PLUGIN_PATH_PATTERN' => 
      array (
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\Rules\\PluginPathRule',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\Rules\\PluginPathRule',
        'name' => 'PLUGIN_PATH_PATTERN',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'/\\/wp-content\\/plugins\\/([^\\/?"\\\'\\s>]+)/i\'',
          'attributes' => 
          array (
            'startLine' => 40,
            'endLine' => 40,
            'startTokenPos' => 35,
            'startFilePos' => 1450,
            'endTokenPos' => 35,
            'endFilePos' => 1492,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 40,
        'endLine' => 40,
        'startColumn' => 5,
        'endColumn' => 84,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'evaluate' => 
      array (
        'name' => 'evaluate',
        'parameters' => 
        array (
          'html' => 
          array (
            'name' => 'html',
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
            'startLine' => 54,
            'endLine' => 54,
            'startColumn' => 30,
            'endColumn' => 41,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'url' => 
          array (
            'name' => 'url',
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
            'startLine' => 54,
            'endLine' => 54,
            'startColumn' => 44,
            'endColumn' => 54,
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
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Evaluate the HTML for WordPress plugin path references.
 *
 * @param string $html The complete HTML source of the target website.
 * @param string $url  The original website URL.
 *
 * @return array{
 *     matched: bool,
 *     confidence: int,
 *     metadata: array<string, mixed>
 * }
 */',
        'startLine' => 54,
        'endLine' => 86,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\PluginDetection\\WordPress\\Rules',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\Rules\\PluginPathRule',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\Rules\\PluginPathRule',
        'currentClassName' => 'App\\Modules\\PluginDetection\\WordPress\\Rules\\PluginPathRule',
        'aliasName' => NULL,
      ),
      'noMatch' => 
      array (
        'name' => 'noMatch',
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
 * @return array{matched: false, confidence: 0, metadata: array<string, mixed>}
 */',
        'startLine' => 91,
        'endLine' => 98,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\PluginDetection\\WordPress\\Rules',
        'declaringClassName' => 'App\\Modules\\PluginDetection\\WordPress\\Rules\\PluginPathRule',
        'implementingClassName' => 'App\\Modules\\PluginDetection\\WordPress\\Rules\\PluginPathRule',
        'currentClassName' => 'App\\Modules\\PluginDetection\\WordPress\\Rules\\PluginPathRule',
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