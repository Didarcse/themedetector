<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Squarespace\Rules\DataAttributesRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Squarespace\Rules\DataAttributesRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-6dbb1d32a0ef7e450df40e36f7777a12957d07c7bea4cf2b1abed3d51b5737f3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Squarespace\\Rules\\DataAttributesRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Squarespace/Rules/DataAttributesRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Squarespace\\Rules',
    'name' => 'App\\Modules\\Detection\\Squarespace\\Rules\\DataAttributesRule',
    'shortName' => 'DataAttributesRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects Squarespace by identifying well-known HTML data attributes
 * embedded in the document.
 *
 * Detection strategy:
 *
 * - The HTML is parsed with DOMDocument and every element is inspected.
 * - Each element is checked for the presence of any known
 *   Squarespace-specific data attribute. The first matching attribute
 *   wins and is recorded in the metadata.
 *
 * Design philosophy:
 *
 * - Single responsibility: detection is confined to HTML attributes. No
 *   JavaScript parsing, no meta tag inspection, no regular expressions,
 *   and no HTTP requests are performed.
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
    'endLine' => 97,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Modules\\Detection\\Squarespace\\Rules\\RuleInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'WEIGHT' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Squarespace\\Rules\\DataAttributesRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Squarespace\\Rules\\DataAttributesRule',
        'name' => 'WEIGHT',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '15',
          'attributes' => 
          array (
            'startLine' => 35,
            'endLine' => 35,
            'startTokenPos' => 44,
            'startFilePos' => 1248,
            'endTokenPos' => 44,
            'endFilePos' => 1249,
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
      'ATTRIBUTES' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Squarespace\\Rules\\DataAttributesRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Squarespace\\Rules\\DataAttributesRule',
        'name' => 'ATTRIBUTES',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'data-animation-role\', \'data-section-id\', \'data-current-styles\']',
          'attributes' => 
          array (
            'startLine' => 37,
            'endLine' => 41,
            'startTokenPos' => 55,
            'startFilePos' => 1284,
            'endTokenPos' => 66,
            'endFilePos' => 1379,
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
            'startLine' => 51,
            'endLine' => 51,
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
            'startLine' => 51,
            'endLine' => 51,
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
 * Evaluate the HTML content for Squarespace data attributes.
 *
 * @param string $html The raw HTML response body.
 * @param string $url  The final request URL (unused in this rule).
 *
 * @return array{matched: bool, weight: int, metadata: array<string,mixed>}
 */',
        'startLine' => 51,
        'endLine' => 84,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Squarespace\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Squarespace\\Rules\\DataAttributesRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Squarespace\\Rules\\DataAttributesRule',
        'currentClassName' => 'App\\Modules\\Detection\\Squarespace\\Rules\\DataAttributesRule',
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
 * @return array{matched: false, weight: 15, metadata: array<string, mixed>}
 */',
        'startLine' => 89,
        'endLine' => 96,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Squarespace\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Squarespace\\Rules\\DataAttributesRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Squarespace\\Rules\\DataAttributesRule',
        'currentClassName' => 'App\\Modules\\Detection\\Squarespace\\Rules\\DataAttributesRule',
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