<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Ghost\Rules\AssetPathRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Ghost\Rules\AssetPathRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-21a1bcfeba24e32305c5b3b14a160c09073f7fb33fabfec8abc9a09f3c93c500',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Ghost\\Rules\\AssetPathRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Ghost/Rules/AssetPathRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Ghost\\Rules',
    'name' => 'App\\Modules\\Detection\\Ghost\\Rules\\AssetPathRule',
    'shortName' => 'AssetPathRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects Ghost via well-known asset paths in HTML element attributes.
 *
 * Detection strategy:
 *
 * - The HTML is parsed with DOMDocument and only <link href>, <script
 *   src>, and <img src> attributes are inspected.
 * - Each attribute value is lowered and searched, case-insensitively, for
 *   a known Ghost asset path. The first matching path wins and is
 *   recorded in the metadata.
 *
 * Design philosophy:
 *
 * - Single responsibility: detection is confined to asset URLs only. No
 *   JavaScript detection, no meta tag inspection, and no HTTP requests
 *   are performed.
 * - Parser warnings are suppressed during DOM construction, errors are
 *   cleared, and the previous libxml error state is always restored,
 *   keeping the rule side-effect free for the surrounding process.
 * - An empty response body short-circuits to a no-match before any DOM
 *   work, since loadHTML() rejects an empty source on PHP 8.2.
 * - The rule is stateless and deterministic: given the same input, it
 *   always returns the same result.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 33,
    'endLine' => 113,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Modules\\Detection\\Ghost\\Rules\\RuleInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'WEIGHT' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\AssetPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\AssetPathRule',
        'name' => 'WEIGHT',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '20',
          'attributes' => 
          array (
            'startLine' => 35,
            'endLine' => 35,
            'startTokenPos' => 44,
            'startFilePos' => 1237,
            'endTokenPos' => 44,
            'endFilePos' => 1238,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 35,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 30,
      ),
      'PATHS' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\AssetPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\AssetPathRule',
        'name' => 'PATHS',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'/content/themes/\', \'/content/images/\', \'/assets/built/\']',
          'attributes' => 
          array (
            'startLine' => 37,
            'endLine' => 41,
            'startTokenPos' => 55,
            'startFilePos' => 1268,
            'endTokenPos' => 66,
            'endFilePos' => 1356,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 37,
        'endLine' => 41,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
      'TAG_ATTRIBUTE_MAP' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\AssetPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\AssetPathRule',
        'name' => 'TAG_ATTRIBUTE_MAP',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'link\' => \'href\', \'script\' => \'src\', \'img\' => \'src\']',
          'attributes' => 
          array (
            'startLine' => 43,
            'endLine' => 47,
            'startTokenPos' => 77,
            'startFilePos' => 1398,
            'endTokenPos' => 100,
            'endFilePos' => 1481,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 43,
        'endLine' => 47,
        'startColumn' => 5,
        'endColumn' => 6,
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
            'startLine' => 57,
            'endLine' => 57,
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
            'startLine' => 57,
            'endLine' => 57,
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
 * Evaluate the HTML content for Ghost asset paths.
 *
 * @param string $html The raw HTML response body.
 * @param string $url  The final request URL (unused in this rule).
 *
 * @return array{matched: bool, weight: int, metadata: array<string,mixed>}
 */',
        'startLine' => 57,
        'endLine' => 100,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Ghost\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\AssetPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\AssetPathRule',
        'currentClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\AssetPathRule',
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
 * @return array{matched: false, weight: 20, metadata: array<string, mixed>}
 */',
        'startLine' => 105,
        'endLine' => 112,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Ghost\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\AssetPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\AssetPathRule',
        'currentClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\AssetPathRule',
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