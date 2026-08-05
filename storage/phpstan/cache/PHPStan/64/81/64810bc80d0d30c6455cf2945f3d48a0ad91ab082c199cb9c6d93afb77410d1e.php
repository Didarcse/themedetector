<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\TYPO3\Rules\MetaGeneratorRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\TYPO3\Rules\MetaGeneratorRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-b0cc0c4b36855382691b8c6d0c576ea59b88742a3c53ce4ddc6c3843405c99a4',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\TYPO3\\Rules\\MetaGeneratorRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/TYPO3/Rules/MetaGeneratorRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\TYPO3\\Rules',
    'name' => 'App\\Modules\\Detection\\TYPO3\\Rules\\MetaGeneratorRule',
    'shortName' => 'MetaGeneratorRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects TYPO3 via the generator meta tag.
 *
 * Searches all <meta> elements for name="generator" and checks
 * whether its content value contains "TYPO3" (case-insensitive).
 * Accepts values such as "TYPO3", "TYPO3 CMS",
 * "Powered by TYPO3", and "Built with TYPO3".
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
    'startLine' => 38,
    'endLine' => 106,
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
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\MetaGeneratorRule',
        'name' => 'WEIGHT',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '35',
          'attributes' => 
          array (
            'startLine' => 40,
            'endLine' => 40,
            'startTokenPos' => 44,
            'startFilePos' => 1432,
            'endTokenPos' => 44,
            'endFilePos' => 1433,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 40,
        'endLine' => 40,
        'startColumn' => 5,
        'endColumn' => 30,
      ),
      'GENERATOR_NAME' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\MetaGeneratorRule',
        'name' => 'GENERATOR_NAME',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'generator\'',
          'attributes' => 
          array (
            'startLine' => 42,
            'endLine' => 42,
            'startTokenPos' => 55,
            'startFilePos' => 1472,
            'endTokenPos' => 55,
            'endFilePos' => 1482,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 42,
        'endLine' => 42,
        'startColumn' => 5,
        'endColumn' => 47,
      ),
      'TARGET' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\MetaGeneratorRule',
        'name' => 'TARGET',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'TYPO3\'',
          'attributes' => 
          array (
            'startLine' => 44,
            'endLine' => 44,
            'startTokenPos' => 66,
            'startFilePos' => 1513,
            'endTokenPos' => 66,
            'endFilePos' => 1519,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 44,
        'endLine' => 44,
        'startColumn' => 5,
        'endColumn' => 35,
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
 * Evaluate the HTML content for a TYPO3 generator meta tag.
 *
 * @param string $html The raw HTML response body.
 * @param string $url  The final request URL (unused in this rule).
 *
 * @return array{matched: bool, weight: int, metadata: array<string,mixed>}
 */',
        'startLine' => 54,
        'endLine' => 93,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\TYPO3\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\MetaGeneratorRule',
        'currentClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\MetaGeneratorRule',
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
        'startLine' => 98,
        'endLine' => 105,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\TYPO3\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\MetaGeneratorRule',
        'currentClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\MetaGeneratorRule',
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