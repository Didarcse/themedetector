<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Joomla\Rules\MetaGeneratorRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Joomla\Rules\MetaGeneratorRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-fa9fbadde676639e88bb41a3ff6e4c8289a095cda71303c0f8210d6d504dcee5',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Joomla\\Rules\\MetaGeneratorRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Joomla/Rules/MetaGeneratorRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Joomla\\Rules',
    'name' => 'App\\Modules\\Detection\\Joomla\\Rules\\MetaGeneratorRule',
    'shortName' => 'MetaGeneratorRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects Joomla via the generator meta tag.
 *
 * Searches all <meta> elements for name="generator" and checks
 * whether its content value contains "Joomla" (case-insensitive).
 * Accepts values such as "Joomla!", "Joomla! Open Source CMS",
 * "Powered by Joomla!", "Built with Joomla", "Joomla 5", and
 * "Joomla 4".
 *
 * Detection strategy:
 *
 * - The HTML is parsed with DOMDocument and every <meta> element is
 *   inspected.
 * - Only the generator meta tag is considered: elements whose name
 *   differs from "generator" (case-insensitive) are skipped.
 * - A match occurs when the content value contains the target string,
 *   matched as a case-insensitive substring.
 *
 * Design philosophy:
 *
 * - Single responsibility: detection is confined to the generator meta
 *   tag. No other markup, JavaScript, regex, or HTTP is involved.
 * - Parser warnings are suppressed during DOM construction and the
 *   previous libxml error state is always restored, keeping the rule
 *   side-effect free for the surrounding process.
 * - An empty response body short-circuits to a no-match before any DOM
 *   work, since loadHTML() rejects an empty source on PHP 8.2.
 * - The rule is stateless and deterministic: given the same input, it
 *   always returns the same result.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 39,
    'endLine' => 107,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Modules\\Detection\\Joomla\\Rules\\RuleInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'WEIGHT' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Joomla\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Joomla\\Rules\\MetaGeneratorRule',
        'name' => 'WEIGHT',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '35',
          'attributes' => 
          array (
            'startLine' => 41,
            'endLine' => 41,
            'startTokenPos' => 44,
            'startFilePos' => 1481,
            'endTokenPos' => 44,
            'endFilePos' => 1482,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 41,
        'endLine' => 41,
        'startColumn' => 5,
        'endColumn' => 30,
      ),
      'GENERATOR_NAME' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Joomla\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Joomla\\Rules\\MetaGeneratorRule',
        'name' => 'GENERATOR_NAME',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'generator\'',
          'attributes' => 
          array (
            'startLine' => 43,
            'endLine' => 43,
            'startTokenPos' => 55,
            'startFilePos' => 1521,
            'endTokenPos' => 55,
            'endFilePos' => 1531,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 43,
        'endLine' => 43,
        'startColumn' => 5,
        'endColumn' => 47,
      ),
      'TARGET' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Joomla\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Joomla\\Rules\\MetaGeneratorRule',
        'name' => 'TARGET',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'Joomla\'',
          'attributes' => 
          array (
            'startLine' => 45,
            'endLine' => 45,
            'startTokenPos' => 66,
            'startFilePos' => 1562,
            'endTokenPos' => 66,
            'endFilePos' => 1569,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 45,
        'endLine' => 45,
        'startColumn' => 5,
        'endColumn' => 36,
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
            'startLine' => 55,
            'endLine' => 55,
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
            'startLine' => 55,
            'endLine' => 55,
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
 * Evaluate the HTML content for a Joomla generator meta tag.
 *
 * @param string $html The raw HTML response body.
 * @param string $url  The final request URL (unused in this rule).
 *
 * @return array{matched: bool, weight: int, metadata: array<string,mixed>}
 */',
        'startLine' => 55,
        'endLine' => 94,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Joomla\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Joomla\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Joomla\\Rules\\MetaGeneratorRule',
        'currentClassName' => 'App\\Modules\\Detection\\Joomla\\Rules\\MetaGeneratorRule',
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
        'startLine' => 99,
        'endLine' => 106,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Joomla\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Joomla\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Joomla\\Rules\\MetaGeneratorRule',
        'currentClassName' => 'App\\Modules\\Detection\\Joomla\\Rules\\MetaGeneratorRule',
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