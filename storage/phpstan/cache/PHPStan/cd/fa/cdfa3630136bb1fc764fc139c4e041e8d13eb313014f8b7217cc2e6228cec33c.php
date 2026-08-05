<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\WordPress\Parsers\StyleCssParser.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\WordPress\Parsers\StyleCssParser
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-801317ae40df457f605e5ca41d5e0cda9bfe55c6f7e5be2292f987de3bc21dee',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\WordPress\\Parsers\\StyleCssParser',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/WordPress/Parsers/StyleCssParser.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\WordPress\\Parsers',
    'name' => 'App\\Modules\\Detection\\WordPress\\Parsers\\StyleCssParser',
    'shortName' => 'StyleCssParser',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Parses a WordPress style.css header block and extracts theme metadata.
 *
 * Operates exclusively on the provided CSS string, reading only the
 * opening comment block.  All CSS rules below the header are ignored.
 * Field names are treated case-insensitively; only the first occurrence
 * of each field is retained.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 15,
    'endLine' => 121,
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
      'FIELD_MAP' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\Parsers\\StyleCssParser',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\Parsers\\StyleCssParser',
        'name' => 'FIELD_MAP',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'theme name\' => \'theme_name\', \'theme uri\' => \'theme_uri\', \'version\' => \'version\', \'author\' => \'author\', \'author uri\' => \'author_uri\']',
          'attributes' => 
          array (
            'startLine' => 17,
            'endLine' => 23,
            'startTokenPos' => 33,
            'startFilePos' => 472,
            'endTokenPos' => 70,
            'endFilePos' => 652,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 17,
        'endLine' => 23,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'parse' => 
      array (
        'name' => 'parse',
        'parameters' => 
        array (
          'css' => 
          array (
            'name' => 'css',
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
            'startLine' => 38,
            'endLine' => 38,
            'startColumn' => 27,
            'endColumn' => 37,
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
 * Parse theme metadata from a style.css source.
 *
 * @param string $css The full content of a WordPress style.css file.
 *
 * @return array{
 *     theme_name: string|null,
 *     theme_uri: string|null,
 *     version: string|null,
 *     author: string|null,
 *     author_uri: string|null,
 * }
 */',
        'startLine' => 38,
        'endLine' => 96,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\WordPress\\Parsers',
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\Parsers\\StyleCssParser',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\Parsers\\StyleCssParser',
        'currentClassName' => 'App\\Modules\\Detection\\WordPress\\Parsers\\StyleCssParser',
        'aliasName' => NULL,
      ),
      'extractHeader' => 
      array (
        'name' => 'extractHeader',
        'parameters' => 
        array (
          'css' => 
          array (
            'name' => 'css',
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
            'startLine' => 105,
            'endLine' => 105,
            'startColumn' => 36,
            'endColumn' => 46,
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
        'docComment' => '/**
 * Extract the raw header comment block from CSS.
 *
 * @param string $css The full CSS string.
 *
 * @return string|null The header content, or null when no comment is found.
 */',
        'startLine' => 105,
        'endLine' => 120,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\WordPress\\Parsers',
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\Parsers\\StyleCssParser',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\Parsers\\StyleCssParser',
        'currentClassName' => 'App\\Modules\\Detection\\WordPress\\Parsers\\StyleCssParser',
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