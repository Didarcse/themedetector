<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Webflow\Rules\DataAttributesRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Webflow\Rules\DataAttributesRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-0f5d9aebbb056cfc357781ddc00ff469f873b39e78fa888f3ecc651339f5be80',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Webflow\\Rules\\DataAttributesRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Webflow/Rules/DataAttributesRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Webflow\\Rules',
    'name' => 'App\\Modules\\Detection\\Webflow\\Rules\\DataAttributesRule',
    'shortName' => 'DataAttributesRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects Webflow via known HTML data attributes.
 *
 * Searches every element for either data-wf-page or data-wf-site.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 15,
    'endLine' => 66,
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
        'declaringClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\DataAttributesRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\DataAttributesRule',
        'name' => 'CONFIDENCE',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '15',
          'attributes' => 
          array (
            'startLine' => 17,
            'endLine' => 17,
            'startTokenPos' => 49,
            'startFilePos' => 340,
            'endTokenPos' => 49,
            'endFilePos' => 341,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 17,
        'endLine' => 17,
        'startColumn' => 5,
        'endColumn' => 34,
      ),
      'ATTRIBUTES' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\DataAttributesRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\DataAttributesRule',
        'name' => 'ATTRIBUTES',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'data-wf-page\', \'data-wf-site\']',
          'attributes' => 
          array (
            'startLine' => 19,
            'endLine' => 22,
            'startTokenPos' => 60,
            'startFilePos' => 376,
            'endTokenPos' => 68,
            'endFilePos' => 430,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 19,
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
 * Evaluate the HTML content for Webflow data attributes.
 *
 * @param string $html The raw HTML response body.
 * @param string $url  The final request URL (unused in this rule).
 *
 * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
 */',
        'startLine' => 32,
        'endLine' => 65,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Webflow\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\DataAttributesRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\DataAttributesRule',
        'currentClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\DataAttributesRule',
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