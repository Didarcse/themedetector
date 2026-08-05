<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\WordPress\Rules\ThemeStyleRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\WordPress\Rules\ThemeStyleRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-5840e3ae61c724f6edf5b52063f238b031787315345afe8220e189a5dbc866b0',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/WordPress/Rules/ThemeStyleRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\WordPress\\Rules',
    'name' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
    'shortName' => 'ThemeStyleRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Downloads the active WordPress theme\'s style.css and extracts metadata.
 *
 * Searches HTML for a wp-content/themes reference, constructs the
 * style.css URL, fetches it via HttpClient, and delegates parsing
 * to StyleCssParser.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 18,
    'endLine' => 123,
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
      'THEME_PATH_PATTERN' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'name' => 'THEME_PATH_PATTERN',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'/\\/wp-content\\/themes\\/([^\\/?"\\\'\\s>]+)/i\'',
          'attributes' => 
          array (
            'startLine' => 20,
            'endLine' => 20,
            'startTokenPos' => 52,
            'startFilePos' => 548,
            'endTokenPos' => 52,
            'endFilePos' => 589,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 20,
        'endLine' => 20,
        'startColumn' => 5,
        'endColumn' => 82,
      ),
    ),
    'immediateProperties' => 
    array (
      'httpClient' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'name' => 'httpClient',
        'modifiers' => 132,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Http\\HttpClient',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 23,
        'endLine' => 23,
        'startColumn' => 9,
        'endColumn' => 47,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'styleCssParser' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'name' => 'styleCssParser',
        'modifiers' => 132,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Detection\\WordPress\\Parsers\\StyleCssParser',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 24,
        'endLine' => 24,
        'startColumn' => 9,
        'endColumn' => 55,
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
          'httpClient' => 
          array (
            'name' => 'httpClient',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Http\\HttpClient',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 23,
            'endLine' => 23,
            'startColumn' => 9,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'styleCssParser' => 
          array (
            'name' => 'styleCssParser',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Detection\\WordPress\\Parsers\\StyleCssParser',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 24,
            'endLine' => 24,
            'startColumn' => 9,
            'endColumn' => 55,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 22,
        'endLine' => 26,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\WordPress\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'currentClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'aliasName' => NULL,
      ),
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
            'startLine' => 40,
            'endLine' => 40,
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
            'startLine' => 40,
            'endLine' => 40,
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
 * Evaluate the HTML for a WordPress theme and extract its metadata.
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
        'startLine' => 40,
        'endLine' => 74,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\WordPress\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'currentClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'aliasName' => NULL,
      ),
      'extractThemeSlug' => 
      array (
        'name' => 'extractThemeSlug',
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
            'startLine' => 76,
            'endLine' => 76,
            'startColumn' => 39,
            'endColumn' => 50,
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
                  'name' => 'string',
                  'isIdentifier' => true,
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
        'docComment' => NULL,
        'startLine' => 76,
        'endLine' => 85,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\WordPress\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'currentClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'aliasName' => NULL,
      ),
      'buildStyleCssUrl' => 
      array (
        'name' => 'buildStyleCssUrl',
        'parameters' => 
        array (
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
            'startLine' => 87,
            'endLine' => 87,
            'startColumn' => 39,
            'endColumn' => 49,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
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
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 87,
            'endLine' => 87,
            'startColumn' => 52,
            'endColumn' => 63,
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
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 87,
        'endLine' => 95,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\WordPress\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'currentClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'aliasName' => NULL,
      ),
      'downloadStyleCss' => 
      array (
        'name' => 'downloadStyleCss',
        'parameters' => 
        array (
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
            'startLine' => 97,
            'endLine' => 97,
            'startColumn' => 39,
            'endColumn' => 49,
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
                  'name' => 'string',
                  'isIdentifier' => true,
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
        'docComment' => NULL,
        'startLine' => 97,
        'endLine' => 110,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\WordPress\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'currentClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
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
        'startLine' => 115,
        'endLine' => 122,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\WordPress\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
        'currentClassName' => 'App\\Modules\\Detection\\WordPress\\Rules\\ThemeStyleRule',
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