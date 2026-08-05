<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Wix\Rules\ThunderboltRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Wix\Rules\ThunderboltRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-2573d6ad0ac9bfea33324ec05a85be3cf07f9b9c095ac5e0f0ac37d0ee322ee9',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Wix\\Rules\\ThunderboltRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Wix/Rules/ThunderboltRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Wix\\Rules',
    'name' => 'App\\Modules\\Detection\\Wix\\Rules\\ThunderboltRule',
    'shortName' => 'ThunderboltRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects Wix by identifying Thunderbolt runtime fingerprints embedded in
 * the HTML source.
 *
 * Detection strategy:
 *
 * - The raw HTML source is searched for a fixed set of Wix Thunderbolt
 *   runtime fingerprints using simple string matching only.
 * - The comparison is case-insensitive and the first matching fingerprint
 *   wins; the matched fingerprint is recorded in the metadata.
 *
 * Design philosophy:
 *
 * - This rule performs no HTML parsing, no DOM manipulation, no regex and
 *   no HTTP. It is a pure, deterministic string scan, which keeps it fast
 *   and independent of any markup quirks in the response body.
 * - The rule is stateless and side-effect free: given the same input, it
 *   always returns the same result.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 26,
    'endLine' => 75,
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
        'declaringClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\ThunderboltRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\ThunderboltRule',
        'name' => 'WEIGHT',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '15',
          'attributes' => 
          array (
            'startLine' => 28,
            'endLine' => 28,
            'startTokenPos' => 39,
            'startFilePos' => 925,
            'endTokenPos' => 39,
            'endFilePos' => 926,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 28,
        'endLine' => 28,
        'startColumn' => 5,
        'endColumn' => 30,
      ),
      'FINGERPRINTS' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\ThunderboltRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\ThunderboltRule',
        'name' => 'FINGERPRINTS',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'wix-thunderbolt\', \'tbReady\', \'tbInit\', \'thunderbolt\']',
          'attributes' => 
          array (
            'startLine' => 30,
            'endLine' => 35,
            'startTokenPos' => 50,
            'startFilePos' => 963,
            'endTokenPos' => 64,
            'endFilePos' => 1056,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 30,
        'endLine' => 35,
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
            'startLine' => 45,
            'endLine' => 45,
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
            'startLine' => 45,
            'endLine' => 45,
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
 * Evaluate the HTML for Wix Thunderbolt fingerprints.
 *
 * @param string $html The raw HTML response body.
 * @param string $url  The final request URL (unused in this rule).
 *
 * @return array{matched: bool, weight: int, metadata: array<string,mixed>}
 */',
        'startLine' => 45,
        'endLine' => 62,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Wix\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\ThunderboltRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\ThunderboltRule',
        'currentClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\ThunderboltRule',
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
        'startLine' => 67,
        'endLine' => 74,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Wix\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\ThunderboltRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\ThunderboltRule',
        'currentClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\ThunderboltRule',
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