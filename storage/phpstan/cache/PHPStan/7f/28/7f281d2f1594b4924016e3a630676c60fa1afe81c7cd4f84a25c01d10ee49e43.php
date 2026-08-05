<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Shopify\ConfidenceCalculator.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Shopify\ConfidenceCalculator
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-eb72cae25e5a34699254de3201faf09baf1dce0a3fd5a9c597db49f507626303',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Shopify\\ConfidenceCalculator',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Shopify/ConfidenceCalculator.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Shopify',
    'name' => 'App\\Modules\\Detection\\Shopify\\ConfidenceCalculator',
    'shortName' => 'ConfidenceCalculator',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Calculates the final Shopify confidence score from multiple rule
 * evaluation results.
 *
 * Strong evidence rules impose a minimum confidence floor when matched.
 * Normal evidence rules contribute their individual confidence values
 * to the accumulated total.  The final score is capped at 100.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 15,
    'endLine' => 63,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'MAX_CONFIDENCE' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\ConfidenceCalculator',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\ConfidenceCalculator',
        'name' => 'MAX_CONFIDENCE',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '100',
          'attributes' => 
          array (
            'startLine' => 17,
            'endLine' => 17,
            'startTokenPos' => 33,
            'startFilePos' => 455,
            'endTokenPos' => 33,
            'endFilePos' => 457,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 17,
        'endLine' => 17,
        'startColumn' => 5,
        'endColumn' => 39,
      ),
      'STRONG_EVIDENCE' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\ConfidenceCalculator',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\ConfidenceCalculator',
        'name' => 'STRONG_EVIDENCE',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'cart_endpoint\' => 95]',
          'attributes' => 
          array (
            'startLine' => 19,
            'endLine' => 21,
            'startTokenPos' => 44,
            'startFilePos' => 497,
            'endTokenPos' => 53,
            'endFilePos' => 534,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 19,
        'endLine' => 21,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'calculate' => 
      array (
        'name' => 'calculate',
        'parameters' => 
        array (
          'ruleResults' => 
          array (
            'name' => 'ruleResults',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 30,
            'endLine' => 30,
            'startColumn' => 31,
            'endColumn' => 48,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Calculate the final confidence score from rule results.
 *
 * @param list<array{matched: bool, confidence: int, metadata: array<string, mixed>}> $ruleResults
 *
 * @return int The calculated confidence score (0–100).
 */',
        'startLine' => 30,
        'endLine' => 62,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Shopify',
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\ConfidenceCalculator',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\ConfidenceCalculator',
        'currentClassName' => 'App\\Modules\\Detection\\Shopify\\ConfidenceCalculator',
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