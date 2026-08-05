<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Drupal\Rules\ApiEndpointRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Drupal\Rules\ApiEndpointRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-8705e663336ed4ed520f2077ba7930cbe405868fdbfd5a8321e7c1916ef5ebd3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Drupal\\Rules\\ApiEndpointRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Drupal/Rules/ApiEndpointRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Drupal\\Rules',
    'name' => 'App\\Modules\\Detection\\Drupal\\Rules\\ApiEndpointRule',
    'shortName' => 'ApiEndpointRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects Drupal by identifying well-known API endpoint fingerprints
 * embedded in the HTML source.
 *
 * Detection strategy:
 *
 * - The raw HTML source is normalized and searched for a fixed set of
 *   Drupal-specific API endpoint identifiers using simple string matching
 *   only.
 * - The comparison is case-insensitive and the first matching endpoint
 *   wins; the matched endpoint is recorded in the metadata.
 *
 * Design philosophy:
 *
 * - Single responsibility: this rule is a pure string scan. It performs
 *   no HTML parsing, no DOM construction, no HTML traversal, no regular
 *   expressions, and no HTTP requests.
 * - An empty response body short-circuits to a no-match before any
 *   scanning work.
 * - The rule is stateless, side-effect free, and deterministic: given the
 *   same input, it always returns the same result.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 29,
    'endLine' => 82,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Modules\\Detection\\Drupal\\Rules\\RuleInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'WEIGHT' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Drupal\\Rules\\ApiEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Drupal\\Rules\\ApiEndpointRule',
        'name' => 'WEIGHT',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '15',
          'attributes' => 
          array (
            'startLine' => 31,
            'endLine' => 31,
            'startTokenPos' => 39,
            'startFilePos' => 1029,
            'endTokenPos' => 39,
            'endFilePos' => 1030,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 31,
        'endLine' => 31,
        'startColumn' => 5,
        'endColumn' => 30,
      ),
      'ENDPOINTS' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Drupal\\Rules\\ApiEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Drupal\\Rules\\ApiEndpointRule',
        'name' => 'ENDPOINTS',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'/jsonapi/\', \'/entity/\', \'/node/\', \'/user/login\']',
          'attributes' => 
          array (
            'startLine' => 33,
            'endLine' => 38,
            'startTokenPos' => 50,
            'startFilePos' => 1064,
            'endTokenPos' => 64,
            'endFilePos' => 1152,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 33,
        'endLine' => 38,
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
            'startLine' => 48,
            'endLine' => 48,
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
            'startLine' => 48,
            'endLine' => 48,
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
 * Evaluate the HTML for Drupal API endpoint fingerprints.
 *
 * @param string $html The raw HTML response body.
 * @param string $url  The final request URL (unused in this rule).
 *
 * @return array{matched: bool, weight: int, metadata: array<string,mixed>}
 */',
        'startLine' => 48,
        'endLine' => 69,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Drupal\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Drupal\\Rules\\ApiEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Drupal\\Rules\\ApiEndpointRule',
        'currentClassName' => 'App\\Modules\\Detection\\Drupal\\Rules\\ApiEndpointRule',
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
        'startLine' => 74,
        'endLine' => 81,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Drupal\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Drupal\\Rules\\ApiEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Drupal\\Rules\\ApiEndpointRule',
        'currentClassName' => 'App\\Modules\\Detection\\Drupal\\Rules\\ApiEndpointRule',
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