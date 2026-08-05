<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\TYPO3\Rules\HtmlSignatureRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\TYPO3\Rules\HtmlSignatureRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-9f5d3c53d3c35397719f3b511a84852c9ab0669d2658340c2adb6509918e0baa',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\TYPO3\\Rules\\HtmlSignatureRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/TYPO3/Rules/HtmlSignatureRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\TYPO3\\Rules',
    'name' => 'App\\Modules\\Detection\\TYPO3\\Rules\\HtmlSignatureRule',
    'shortName' => 'HtmlSignatureRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects TYPO3 by identifying well-known HTML signatures embedded in
 * the HTML source.
 *
 * Detection strategy:
 *
 * - The raw HTML source is normalized and searched for a fixed set of
 *   TYPO3-specific HTML identifiers using simple string matching only.
 * - The comparison is case-insensitive and the first matching signature
 *   wins; the matched signature is recorded in the metadata.
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
    'startLine' => 28,
    'endLine' => 81,
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
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\HtmlSignatureRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\HtmlSignatureRule',
        'name' => 'WEIGHT',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '15',
          'attributes' => 
          array (
            'startLine' => 30,
            'endLine' => 30,
            'startTokenPos' => 39,
            'startFilePos' => 1007,
            'endTokenPos' => 39,
            'endFilePos' => 1008,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 30,
        'endLine' => 30,
        'startColumn' => 5,
        'endColumn' => 30,
      ),
      'SIGNATURES' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\HtmlSignatureRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\HtmlSignatureRule',
        'name' => 'SIGNATURES',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'data-typo3\', \'typo3-login\', \'typo3-backend\', \'typo3-adminpanel\']',
          'attributes' => 
          array (
            'startLine' => 32,
            'endLine' => 37,
            'startTokenPos' => 50,
            'startFilePos' => 1043,
            'endTokenPos' => 64,
            'endFilePos' => 1147,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 32,
        'endLine' => 37,
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
            'startLine' => 47,
            'endLine' => 47,
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
            'startLine' => 47,
            'endLine' => 47,
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
 * Evaluate the HTML for TYPO3 HTML signatures.
 *
 * @param string $html The raw HTML response body.
 * @param string $url  The final request URL (unused in this rule).
 *
 * @return array{matched: bool, weight: int, metadata: array<string,mixed>}
 */',
        'startLine' => 47,
        'endLine' => 68,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\TYPO3\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\HtmlSignatureRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\HtmlSignatureRule',
        'currentClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\HtmlSignatureRule',
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
        'startLine' => 73,
        'endLine' => 80,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\TYPO3\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\HtmlSignatureRule',
        'implementingClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\HtmlSignatureRule',
        'currentClassName' => 'App\\Modules\\Detection\\TYPO3\\Rules\\HtmlSignatureRule',
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