<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Webflow\ConfidenceCalculator.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Webflow\ConfidenceCalculator
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-9cf670fd7a3e1fa244d6d2e716e7a42217fb9af3b0973d3ddf56e1e2e0b17521',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Webflow\\ConfidenceCalculator',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Webflow/ConfidenceCalculator.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Webflow',
    'name' => 'App\\Modules\\Detection\\Webflow\\ConfidenceCalculator',
    'shortName' => 'ConfidenceCalculator',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Calculates the final confidence score for Webflow detection.
 *
 * Receives evaluation results from every Webflow rule, sums the
 * confidence contributions of matched rules, and clamps the result
 * to 0–100.
 *
 * Contains no HTML parsing, no regex, and no HTTP logic — pure
 * score aggregation only.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 17,
    'endLine' => 54,
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
      'MAX_SCORE' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Webflow\\ConfidenceCalculator',
        'implementingClassName' => 'App\\Modules\\Detection\\Webflow\\ConfidenceCalculator',
        'name' => 'MAX_SCORE',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '100',
          'attributes' => 
          array (
            'startLine' => 19,
            'endLine' => 19,
            'startTokenPos' => 35,
            'startFilePos' => 468,
            'endTokenPos' => 35,
            'endFilePos' => 470,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 19,
        'endLine' => 19,
        'startColumn' => 5,
        'endColumn' => 34,
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
            'startLine' => 32,
            'endLine' => 32,
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
 * @param list<array{
 *     matched: bool,
 *     confidence: int,
 *     metadata: array<string, mixed>
 * }> $ruleResults
 *
 * @return int The calculated confidence score (0–100).
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
        'namespace' => 'App\\Modules\\Detection\\Webflow',
        'declaringClassName' => 'App\\Modules\\Detection\\Webflow\\ConfidenceCalculator',
        'implementingClassName' => 'App\\Modules\\Detection\\Webflow\\ConfidenceCalculator',
        'currentClassName' => 'App\\Modules\\Detection\\Webflow\\ConfidenceCalculator',
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