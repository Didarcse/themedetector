<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\TYPO3\Rules\AssetPathRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\TYPO3\Rules\AssetPathRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-529ff1ed569a52a1ad7452806fac9b45c27c74192600af02492fa5f7b4fbb4a0',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\TYPO3\\Rules\\AssetPathRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/TYPO3/Rules/AssetPathRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\TYPO3\\Rules',
    'name' => 'App\\Modules\\Detection\\TYPO3\\Rules\\AssetPathRule',
    'shortName' => 'AssetPathRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects TYPO3 via well-known asset paths in HTML element attributes.
 *
 * Detection strategy:
 *
 * - The HTML is parsed with DOMDocument and only <link href>, <script
 *   src>, and <img src> attributes are inspected.
 * - Each attribute value is lowered and searched, case-insensitively, for
 *   a known TYPO3 asset path. The first matching path wins and is
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
    'endLine' => 115,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Modules\\Detection\\TYPO3\\Rules\\RuleInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'WEIGHT' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\AssetPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\AssetPathRule',
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
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\AssetPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\AssetPathRule',
        'name' => 'PATHS',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'/typo3/\', \'/typo3conf/\', \'/typo3temp/\', \'/fileadmin/\', \'/typo3/sysext/\']',
          'attributes' => 
          array (
            'startLine' => 37,
            'endLine' => 43,
            'startTokenPos' => 55,
            'startFilePos' => 1268,
            'endTokenPos' => 72,
            'endFilePos' => 1388,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 37,
        'endLine' => 43,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
      'TAG_ATTRIBUTE_MAP' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\AssetPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\AssetPathRule',
        'name' => 'TAG_ATTRIBUTE_MAP',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'link\' => \'href\', \'script\' => \'src\', \'img\' => \'src\']',
          'attributes' => 
          array (
            'startLine' => 45,
            'endLine' => 49,
            'startTokenPos' => 83,
            'startFilePos' => 1430,
            'endTokenPos' => 106,
            'endFilePos' => 1513,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 45,
        'endLine' => 49,
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
            'startLine' => 59,
            'endLine' => 59,
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
            'startLine' => 59,
            'endLine' => 59,
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
 * Evaluate the HTML content for TYPO3 asset paths.
 *
 * @param string $html The raw HTML response body.
 * @param string $url  The final request URL (unused in this rule).
 *
 * @return array{matched: bool, weight: int, metadata: array<string,mixed>}
 */',
        'startLine' => 59,
        'endLine' => 102,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\TYPO3\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\AssetPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\AssetPathRule',
        'currentClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\AssetPathRule',
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
        'startLine' => 107,
        'endLine' => 114,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\TYPO3\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\AssetPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\AssetPathRule',
        'currentClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\AssetPathRule',
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