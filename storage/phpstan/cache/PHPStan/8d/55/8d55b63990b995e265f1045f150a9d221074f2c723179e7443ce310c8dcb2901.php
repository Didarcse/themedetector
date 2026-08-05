<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Webflow\Rules\MetaGeneratorRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Webflow\Rules\MetaGeneratorRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-fa95fbfbb21e8aa15d3f007fd94cd3cc07589800051970a2d3d15739f52c50ce',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Webflow\\Rules\\MetaGeneratorRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Webflow/Rules/MetaGeneratorRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Webflow\\Rules',
    'name' => 'App\\Modules\\Detection\\Webflow\\Rules\\MetaGeneratorRule',
    'shortName' => 'MetaGeneratorRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Detects Webflow via the generator meta tag.
 *
 * Searches all <meta> elements for name="generator" and checks
 * whether its content value contains "Webflow" (case-insensitive).
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 15,
    'endLine' => 67,
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
        'declaringClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\MetaGeneratorRule',
        'name' => 'CONFIDENCE',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '35',
          'attributes' => 
          array (
            'startLine' => 17,
            'endLine' => 17,
            'startTokenPos' => 44,
            'startFilePos' => 386,
            'endTokenPos' => 44,
            'endFilePos' => 387,
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
      'GENERATOR_NAME' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\MetaGeneratorRule',
        'name' => 'GENERATOR_NAME',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'Webflow\'',
          'attributes' => 
          array (
            'startLine' => 19,
            'endLine' => 19,
            'startTokenPos' => 55,
            'startFilePos' => 426,
            'endTokenPos' => 55,
            'endFilePos' => 434,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 19,
        'endLine' => 19,
        'startColumn' => 5,
        'endColumn' => 45,
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
            'startLine' => 29,
            'endLine' => 29,
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
            'startLine' => 29,
            'endLine' => 29,
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
 * Evaluate the HTML content for a Webflow generator meta tag.
 *
 * @param string $html The raw HTML response body.
 * @param string $url  The final request URL (unused in this rule).
 *
 * @return array{matched: bool, confidence: int, metadata: array<string, mixed>}
 */',
        'startLine' => 29,
        'endLine' => 66,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Webflow\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\MetaGeneratorRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\MetaGeneratorRule',
        'currentClassName' => 'App\\Modules\\Detection\\Webflow\\Rules\\MetaGeneratorRule',
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