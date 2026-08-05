<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\TYPO3\Rules\ApiEndpointRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\TYPO3\Rules\ApiEndpointRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-50ec8ab34a858242306d1b59b637e5b396aee293b71a93fb2d66310b67ef1988',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\TYPO3\\Rules\\ApiEndpointRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/TYPO3/Rules/ApiEndpointRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\TYPO3\\Rules',
    'name' => 'App\\Modules\\Detection\\TYPO3\\Rules\\ApiEndpointRule',
    'shortName' => 'ApiEndpointRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects TYPO3 by identifying well-known API endpoint fingerprints
 * embedded in the HTML source.
 *
 * Detection strategy:
 *
 * - The raw HTML source is normalized and searched for a fixed set of
 *   TYPO3-specific API endpoint identifiers using simple string matching
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
      0 => 'App\\Modules\\Detection\\TYPO3\\Rules\\RuleInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'WEIGHT' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\ApiEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\ApiEndpointRule',
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
            'startFilePos' => 1026,
            'endTokenPos' => 39,
            'endFilePos' => 1027,
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
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\ApiEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\ApiEndpointRule',
        'name' => 'ENDPOINTS',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'/typo3/\', \'/typo3/index.php\', \'/typo3/ajax\', \'/typo3/module\']',
          'attributes' => 
          array (
            'startLine' => 33,
            'endLine' => 38,
            'startTokenPos' => 50,
            'startFilePos' => 1061,
            'endTokenPos' => 64,
            'endFilePos' => 1162,
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
 * Evaluate the HTML for TYPO3 API endpoint fingerprints.
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
        'namespace' => 'App\\Modules\\Detection\\TYPO3\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\ApiEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\ApiEndpointRule',
        'currentClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\ApiEndpointRule',
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
        'namespace' => 'App\\Modules\\Detection\\TYPO3\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\ApiEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\ApiEndpointRule',
        'currentClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\ApiEndpointRule',
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