<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Shopify\Rules\GlobalJsRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Shopify\Rules\GlobalJsRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-8ef3e4ca9ccfa27172d8ee7f7696b32635857d28dd7ee93cec3621e68591c0f6',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Shopify\\Rules\\GlobalJsRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Shopify/Rules/GlobalJsRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Shopify\\Rules',
    'name' => 'App\\Modules\\Detection\\Shopify\\Rules\\GlobalJsRule',
    'shortName' => 'GlobalJsRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Detects Shopify by identifying official Shopify JavaScript globals
 * in HTML.
 *
 * Performs a case-sensitive search for JavaScript identifiers such as
 * window.Shopify, Shopify.theme, Shopify.routes, and ShopifyAnalytics.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 14,
    'endLine' => 58,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Modules\\Detection\\Shopify\\Rules\\RuleInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'CONFIDENCE' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\GlobalJsRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\GlobalJsRule',
        'name' => 'CONFIDENCE',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '20',
          'attributes' => 
          array (
            'startLine' => 16,
            'endLine' => 16,
            'startTokenPos' => 37,
            'startFilePos' => 400,
            'endTokenPos' => 37,
            'endFilePos' => 401,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 16,
        'endLine' => 16,
        'startColumn' => 5,
        'endColumn' => 34,
      ),
      'PATTERN' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\GlobalJsRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\GlobalJsRule',
        'name' => 'PATTERN',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'/(?:window\\.Shopify|Shopify\\.theme|Shopify\\.routes|Shopify\\.designMode|Shopify\\.locale|Shopify\\.country|Shopify\\.currency|ShopifyAnalytics)/\'',
          'attributes' => 
          array (
            'startLine' => 18,
            'endLine' => 18,
            'startTokenPos' => 48,
            'startFilePos' => 433,
            'endTokenPos' => 48,
            'endFilePos' => 574,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 18,
        'endLine' => 18,
        'startColumn' => 5,
        'endColumn' => 171,
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
 * Evaluate the HTML for Shopify JavaScript fingerprints.
 *
 * @param string $html The complete HTML source of the target website.
 * @param string $url  The original website URL.
 *
 * @return array{
 *     matched: bool,
 *     confidence: int,
 *     metadata: array<string, mixed>
 * }
 */',
        'startLine' => 32,
        'endLine' => 45,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Shopify\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\GlobalJsRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\GlobalJsRule',
        'currentClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\GlobalJsRule',
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
 * @return array{matched: false, confidence: 0, metadata: array<string, mixed>}
 */',
        'startLine' => 50,
        'endLine' => 57,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Shopify\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\GlobalJsRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\GlobalJsRule',
        'currentClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\GlobalJsRule',
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