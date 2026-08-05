<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Webflow\Rules\GlobalJsRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Webflow\Rules\GlobalJsRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-423461af519e8673b863f576a45ffd089774f3bd266e7921bd7a73eed696e8b3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Webflow\\Rules\\GlobalJsRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Webflow/Rules/GlobalJsRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Webflow\\Rules',
    'name' => 'App\\Modules\\Detection\\Webflow\\Rules\\GlobalJsRule',
    'shortName' => 'GlobalJsRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects Webflow via JavaScript fingerprints in the HTML source.
 *
 * Performs simple case-insensitive string searches for well-known
 * Webflow JS identifiers.  No DOM parsing or HTTP requests.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 13,
    'endLine' => 54,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Modules\\Detection\\Webflow\\Rules\\RuleInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'CONFIDENCE' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\GlobalJsRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\GlobalJsRule',
        'name' => 'CONFIDENCE',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '25',
          'attributes' => 
          array (
            'startLine' => 15,
            'endLine' => 15,
            'startTokenPos' => 39,
            'startFilePos' => 379,
            'endTokenPos' => 39,
            'endFilePos' => 380,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 15,
        'endLine' => 15,
        'startColumn' => 5,
        'endColumn' => 34,
      ),
      'FINGERPRINTS' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\GlobalJsRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\GlobalJsRule',
        'name' => 'FINGERPRINTS',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'webflow.js\', \'window.Webflow\', \'Webflow.require(\', \'Webflow.push(\']',
          'attributes' => 
          array (
            'startLine' => 17,
            'endLine' => 22,
            'startTokenPos' => 50,
            'startFilePos' => 417,
            'endTokenPos' => 64,
            'endFilePos' => 524,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 17,
        'endLine' => 22,
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
            'startLine' => 32,
            'endLine' => 32,
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
            'startLine' => 32,
            'endLine' => 32,
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
 * Evaluate the HTML content for Webflow JavaScript fingerprints.
 *
 * @param string $html The raw HTML response body.
 * @param string $url  The final request URL (unused in this rule).
 *
 * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
 */',
        'startLine' => 32,
        'endLine' => 53,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Webflow\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\GlobalJsRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\GlobalJsRule',
        'currentClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\GlobalJsRule',
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