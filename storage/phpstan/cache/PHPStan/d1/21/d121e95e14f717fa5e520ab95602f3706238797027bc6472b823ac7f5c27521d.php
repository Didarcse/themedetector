<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Webflow\Rules\AssetPathRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Webflow\Rules\AssetPathRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-d4f75ffdb77abebb236f8693f732304c6eee5ded5b0dd81886203a02505c6833',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Webflow\\Rules\\AssetPathRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Webflow/Rules/AssetPathRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Webflow\\Rules',
    'name' => 'App\\Modules\\Detection\\Webflow\\Rules\\AssetPathRule',
    'shortName' => 'AssetPathRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects Webflow via known asset hostnames in HTML element
 * attributes.
 *
 * Inspects <link href>, <script src>, and <img src> for URLs
 * pointing to Webflow infrastructure.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 16,
    'endLine' => 84,
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
        'declaringClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\AssetPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\AssetPathRule',
        'name' => 'CONFIDENCE',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '15',
          'attributes' => 
          array (
            'startLine' => 18,
            'endLine' => 18,
            'startTokenPos' => 44,
            'startFilePos' => 380,
            'endTokenPos' => 44,
            'endFilePos' => 381,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 18,
        'endLine' => 18,
        'startColumn' => 5,
        'endColumn' => 34,
      ),
      'HOSTNAMES' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\AssetPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\AssetPathRule',
        'name' => 'HOSTNAMES',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'assets.website-files.com\', \'cdn.prod.website-files.com\', \'uploads-ssl.webflow.com\']',
          'attributes' => 
          array (
            'startLine' => 20,
            'endLine' => 24,
            'startTokenPos' => 55,
            'startFilePos' => 415,
            'endTokenPos' => 66,
            'endFilePos' => 530,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 20,
        'endLine' => 24,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
      'TAG_ATTRIBUTE_MAP' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\AssetPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\AssetPathRule',
        'name' => 'TAG_ATTRIBUTE_MAP',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'link\' => \'href\', \'script\' => \'src\', \'img\' => \'src\']',
          'attributes' => 
          array (
            'startLine' => 26,
            'endLine' => 30,
            'startTokenPos' => 77,
            'startFilePos' => 572,
            'endTokenPos' => 100,
            'endFilePos' => 655,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 26,
        'endLine' => 30,
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
            'startLine' => 40,
            'endLine' => 40,
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
            'startLine' => 40,
            'endLine' => 40,
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
 * Evaluate the HTML content for Webflow asset hostnames.
 *
 * @param string $html The raw HTML response body.
 * @param string $url  The final request URL (unused in this rule).
 *
 * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
 */',
        'startLine' => 40,
        'endLine' => 83,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Webflow\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\AssetPathRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\AssetPathRule',
        'currentClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\AssetPathRule',
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