<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Shopify\Rules\ThemeAssetsRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Shopify\Rules\ThemeAssetsRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-4a0d79ba53aaabe1af00dcdd2b451f7a7d8530e0cacb6e5ca1d5156b6d6d30ee',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Shopify\\Rules\\ThemeAssetsRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Shopify/Rules/ThemeAssetsRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Shopify\\Rules',
    'name' => 'App\\Modules\\Detection\\Shopify\\Rules\\ThemeAssetsRule',
    'shortName' => 'ThemeAssetsRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Detects Shopify by identifying common Shopify Online Store 2.0 theme
 * asset filenames referenced in HTML.
 *
 * Complements ShopifyAssetsRule by matching well-known theme filenames
 * rather than path structures.
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
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\ThemeAssetsRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\ThemeAssetsRule',
        'name' => 'CONFIDENCE',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '15',
          'attributes' => 
          array (
            'startLine' => 16,
            'endLine' => 16,
            'startTokenPos' => 37,
            'startFilePos' => 393,
            'endTokenPos' => 37,
            'endFilePos' => 394,
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
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\ThemeAssetsRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\ThemeAssetsRule',
        'name' => 'PATTERN',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'/\\b(?:base\\.css|theme\\.css|theme\\.min\\.css|theme\\.js|theme\\.min\\.js|global\\.js|vendor\\.js|constants\\.js|animations\\.js|details-disclosure\\.js|details-modal\\.js|predictive-search\\.js|component-card\\.css|component-price\\.css|component-slider\\.css|component-cart\\.css|component-search\\.css|quick-add\\.js|cart\\.js|product-form\\.js)\\b/i\'',
          'attributes' => 
          array (
            'startLine' => 18,
            'endLine' => 18,
            'startTokenPos' => 48,
            'startFilePos' => 426,
            'endTokenPos' => 48,
            'endFilePos' => 758,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 18,
        'endLine' => 18,
        'startColumn' => 5,
        'endColumn' => 362,
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
 * Evaluate the HTML for Shopify theme asset filename references.
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
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\ThemeAssetsRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\ThemeAssetsRule',
        'currentClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\ThemeAssetsRule',
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
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\ThemeAssetsRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\ThemeAssetsRule',
        'currentClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\ThemeAssetsRule',
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