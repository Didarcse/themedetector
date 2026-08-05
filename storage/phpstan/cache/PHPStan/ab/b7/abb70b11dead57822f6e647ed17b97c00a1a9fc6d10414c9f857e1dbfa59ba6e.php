<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Ghost\Rules\ScriptFingerprintRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Ghost\Rules\ScriptFingerprintRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-046cd03053ce2ffa08a45dd8e1278bd6f3ee80963a2f1cd350a623b8993bf2bc',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Ghost\\Rules\\ScriptFingerprintRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Ghost/Rules/ScriptFingerprintRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Ghost\\Rules',
    'name' => 'App\\Modules\\Detection\\Ghost\\Rules\\ScriptFingerprintRule',
    'shortName' => 'ScriptFingerprintRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects Ghost by identifying well-known JavaScript fingerprints
 * embedded in the HTML source.
 *
 * Detection strategy:
 *
 * - The raw HTML source is normalized and searched for a fixed set of
 *   Ghost-specific JavaScript identifiers using simple string matching
 *   only.
 * - The comparison is case-insensitive and the first matching fingerprint
 *   wins; the matched fingerprint is recorded in the metadata.
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
      0 => 'App\\Modules\\Detection\\Ghost\\Rules\\RuleInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'WEIGHT' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\ScriptFingerprintRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\ScriptFingerprintRule',
        'name' => 'WEIGHT',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '25',
          'attributes' => 
          array (
            'startLine' => 31,
            'endLine' => 31,
            'startTokenPos' => 39,
            'startFilePos' => 1034,
            'endTokenPos' => 39,
            'endFilePos' => 1035,
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
      'FINGERPRINTS' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\ScriptFingerprintRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\ScriptFingerprintRule',
        'name' => 'FINGERPRINTS',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'window.Ghost\', \'ghost.init\', \'ghost-sdk\', \'Ghost\']',
          'attributes' => 
          array (
            'startLine' => 33,
            'endLine' => 38,
            'startTokenPos' => 50,
            'startFilePos' => 1072,
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
 * Evaluate the HTML for Ghost JavaScript fingerprints.
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
        'namespace' => 'App\\Modules\\Detection\\Ghost\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\ScriptFingerprintRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\ScriptFingerprintRule',
        'currentClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\ScriptFingerprintRule',
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
 * @return array{matched: false, weight: 25, metadata: array<string, mixed>}
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
        'namespace' => 'App\\Modules\\Detection\\Ghost\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\ScriptFingerprintRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\ScriptFingerprintRule',
        'currentClassName' => 'App\\Modules\\Detection\\Ghost\\Rules\\ScriptFingerprintRule',
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