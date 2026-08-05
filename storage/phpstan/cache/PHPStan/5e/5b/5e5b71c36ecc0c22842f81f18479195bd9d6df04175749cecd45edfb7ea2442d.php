<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\WordPress\Rules\PluginPathRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\WordPress\Rules\PluginPathRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-daaf2c27240e05ede1f83bdc7010423c4aa433afce23092fd99af7f6fb7be579',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\WordPress\\Rules\\PluginPathRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/WordPress/Rules/PluginPathRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\WordPress\\Rules',
    'name' => 'App\\Modules\\Detection\\WordPress\\Rules\\PluginPathRule',
    'shortName' => 'PluginPathRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Detects WordPress plugins referenced in HTML by scanning asset URLs
 * that contain /wp-content/plugins/.
 *
 * Extracts unique plugin slugs, sorted alphabetically, preserving
 * their original spelling.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 14,
    'endLine' => 75,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Modules\\Detection\\WordPress\\Rules\\RuleInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'PLUGIN_PATH_PATTERN' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\PluginPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\PluginPathRule',
        'name' => 'PLUGIN_PATH_PATTERN',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'/\\/wp-content\\/plugins\\/([^\\/?"\\\'\\s>]+)/i\'',
          'attributes' => 
          array (
            'startLine' => 16,
            'endLine' => 16,
            'startTokenPos' => 37,
            'startFilePos' => 392,
            'endTokenPos' => 37,
            'endFilePos' => 434,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 16,
        'endLine' => 16,
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
            'startLine' => 30,
            'endLine' => 30,
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
            'startLine' => 30,
            'endLine' => 30,
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
        'startLine' => 30,
        'endLine' => 62,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\WordPress\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\PluginPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\PluginPathRule',
        'currentClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\PluginPathRule',
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
        'startLine' => 67,
        'endLine' => 74,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\WordPress\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\PluginPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\PluginPathRule',
        'currentClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\PluginPathRule',
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