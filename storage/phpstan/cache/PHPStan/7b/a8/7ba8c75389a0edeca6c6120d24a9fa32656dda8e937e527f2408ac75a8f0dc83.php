<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Wix\Rules\MetaGeneratorRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Wix\Rules\MetaGeneratorRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-70dd78a3922a04bb571436644bb3b12c54aad19a69ba63ba9b99f2619dae71d5',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Wix\\Rules\\MetaGeneratorRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Wix/Rules/MetaGeneratorRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Wix\\Rules',
    'name' => 'App\\Modules\\Detection\\Wix\\Rules\\MetaGeneratorRule',
    'shortName' => 'MetaGeneratorRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects Wix via the generator meta tag.
 *
 * Searches all <meta> elements for name="generator" and checks
 * whether its content value contains "Wix" (case-insensitive).
 * Accepts values such as "Wix.com Website Builder", "Wix", or
 * "Built with Wix".
 *
 * Design philosophy:
 *
 * - Detection is confined to a single, unambiguous signal: the generator
 *   meta tag. No other markup is inspected.
 * - The match is a case-insensitive substring check, so generator
 *   strings that embed "Wix" in longer phrases still match without
 *   relying on exact-value comparison.
 * - Parser warnings are suppressed during DOM construction and the
 *   previous libxml error state is always restored, keeping the rule
 *   side-effect free for the surrounding process.
 * - An empty response body short-circuits to a no-match before any DOM
 *   work, since loadHTML() rejects an empty source on PHP 8.2.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 30,
    'endLine' => 98,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Modules\\Detection\\Wix\\Rules\\RuleInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'WEIGHT' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\MetaGeneratorRule',
        'name' => 'WEIGHT',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '35',
          'attributes' => 
          array (
            'startLine' => 32,
            'endLine' => 32,
            'startTokenPos' => 44,
            'startFilePos' => 1101,
            'endTokenPos' => 44,
            'endFilePos' => 1102,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 32,
        'endLine' => 32,
        'startColumn' => 5,
        'endColumn' => 30,
      ),
      'GENERATOR_NAME' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\MetaGeneratorRule',
        'name' => 'GENERATOR_NAME',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'generator\'',
          'attributes' => 
          array (
            'startLine' => 34,
            'endLine' => 34,
            'startTokenPos' => 55,
            'startFilePos' => 1141,
            'endTokenPos' => 55,
            'endFilePos' => 1151,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 34,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 47,
      ),
      'TARGET' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\MetaGeneratorRule',
        'name' => 'TARGET',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'Wix\'',
          'attributes' => 
          array (
            'startLine' => 36,
            'endLine' => 36,
            'startTokenPos' => 66,
            'startFilePos' => 1182,
            'endTokenPos' => 66,
            'endFilePos' => 1186,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 36,
        'endLine' => 36,
        'startColumn' => 5,
        'endColumn' => 33,
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
            'startLine' => 46,
            'endLine' => 46,
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
            'startLine' => 46,
            'endLine' => 46,
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
 * Evaluate the HTML content for a Wix generator meta tag.
 *
 * @param string $html The raw HTML response body.
 * @param string $url  The final request URL (unused in this rule).
 *
 * @return array{matched: bool, weight: int, metadata: array<string,mixed>}
 */',
        'startLine' => 46,
        'endLine' => 85,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Wix\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\MetaGeneratorRule',
        'currentClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\MetaGeneratorRule',
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
 * @return array{matched: false, weight: 35, metadata: array<string, mixed>}
 */',
        'startLine' => 90,
        'endLine' => 97,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Wix\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\MetaGeneratorRule',
        'currentClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\MetaGeneratorRule',
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