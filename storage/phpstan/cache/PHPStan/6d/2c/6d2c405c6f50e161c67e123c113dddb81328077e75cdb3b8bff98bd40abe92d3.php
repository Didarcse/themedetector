<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Shopify\Parsers\ThemeAssetParser.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Shopify\Parsers\ThemeAssetParser
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-ca6df46378a54c22243a74954140ff54338e7fd61896a8df282c75c23936235e',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Shopify\\Parsers\\ThemeAssetParser',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Shopify/Parsers/ThemeAssetParser.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Shopify\\Parsers',
    'name' => 'App\\Modules\\Detection\\Shopify\\Parsers\\ThemeAssetParser',
    'shortName' => 'ThemeAssetParser',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Extracts structured Shopify theme asset metadata from HTML.
 *
 * This class is purely a parser — it does not perform detection.
 * Detection is handled by ThemeAssetsRule.  This parser extracts
 * the theme ID and unique asset filenames from Shopify asset paths
 * found in the HTML source.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 15,
    'endLine' => 87,
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
      'THEME_PATTERN' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Parsers\\ThemeAssetParser',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Parsers\\ThemeAssetParser',
        'name' => 'THEME_PATTERN',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'/\\/t\\/([a-zA-Z0-9_-]+)\\/assets\\//i\'',
          'attributes' => 
          array (
            'startLine' => 17,
            'endLine' => 17,
            'startTokenPos' => 33,
            'startFilePos' => 453,
            'endTokenPos' => 33,
            'endFilePos' => 488,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 17,
        'endLine' => 17,
        'startColumn' => 5,
        'endColumn' => 71,
      ),
      'ASSET_PATTERN' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Parsers\\ThemeAssetParser',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Parsers\\ThemeAssetParser',
        'name' => 'ASSET_PATTERN',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'/assets\\/([a-zA-Z0-9_\\.-]+\\.(?:css|js))/i\'',
          'attributes' => 
          array (
            'startLine' => 19,
            'endLine' => 19,
            'startTokenPos' => 44,
            'startFilePos' => 526,
            'endTokenPos' => 44,
            'endFilePos' => 568,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 19,
        'endLine' => 19,
        'startColumn' => 5,
        'endColumn' => 78,
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
            'startLine' => 31,
            'endLine' => 31,
            'startColumn' => 27,
            'endColumn' => 38,
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
 * Parse the HTML for Shopify theme asset metadata.
 *
 * @param string $html The complete HTML source.
 *
 * @return array{
 *     theme_id: string|null,
 *     asset_files: list<string>
 * }
 */',
        'startLine' => 31,
        'endLine' => 37,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Shopify\\Parsers',
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Parsers\\ThemeAssetParser',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Parsers\\ThemeAssetParser',
        'currentClassName' => 'App\\Modules\\Detection\\Shopify\\Parsers\\ThemeAssetParser',
        'aliasName' => NULL,
      ),
      'extractThemeId' => 
      array (
        'name' => 'extractThemeId',
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
            'startLine' => 47,
            'endLine' => 47,
            'startColumn' => 37,
            'endColumn' => 48,
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
 * Extract the Shopify theme identifier from asset paths.
 *
 * Looks for the pattern /t/<id>/assets/ where <id> may be numeric
 * or alphanumeric (e.g. "8", "main", "demo").
 *
 * @return string|null
 */',
        'startLine' => 47,
        'endLine' => 54,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Shopify\\Parsers',
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Parsers\\ThemeAssetParser',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Parsers\\ThemeAssetParser',
        'currentClassName' => 'App\\Modules\\Detection\\Shopify\\Parsers\\ThemeAssetParser',
        'aliasName' => NULL,
      ),
      'extractAssetFiles' => 
      array (
        'name' => 'extractAssetFiles',
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
            'startLine' => 65,
            'endLine' => 65,
            'startColumn' => 40,
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
 * Extract unique Shopify theme asset filenames from the HTML.
 *
 * Only filenames located inside /assets/ paths are extracted,
 * preserving discovery order and ignoring duplicates, query
 * strings, and hashes.
 *
 * @return list<string>
 */',
        'startLine' => 65,
        'endLine' => 86,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Shopify\\Parsers',
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Parsers\\ThemeAssetParser',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Parsers\\ThemeAssetParser',
        'currentClassName' => 'App\\Modules\\Detection\\Shopify\\Parsers\\ThemeAssetParser',
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