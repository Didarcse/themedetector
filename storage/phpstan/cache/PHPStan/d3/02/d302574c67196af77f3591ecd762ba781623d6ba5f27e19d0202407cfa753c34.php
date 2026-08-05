<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\WordPress\ConfidenceCalculator.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\WordPress\ConfidenceCalculator
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-555940595af932ad0c92de3bde51a3068021e2cee646b68d1cd9efda96cfa703',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\WordPress\\ConfidenceCalculator',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/WordPress/ConfidenceCalculator.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\WordPress',
    'name' => 'App\\Modules\\Detection\\WordPress\\ConfidenceCalculator',
    'shortName' => 'ConfidenceCalculator',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Calculates the final WordPress confidence score from multiple rule
 * evaluation results.
 *
 * Strong evidence rules (ThemeStyleRule, WPJsonRule) impose a minimum
 * confidence floor when matched.  Normal evidence rules contribute
 * their individual confidence values to the accumulated total.
 * The final score is capped at 100.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 16,
    'endLine' => 65,
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
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\ConfidenceCalculator',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\ConfidenceCalculator',
        'name' => 'MAX_CONFIDENCE',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '100',
          'attributes' => 
          array (
            'startLine' => 18,
            'endLine' => 18,
            'startTokenPos' => 33,
            'startFilePos' => 491,
            'endTokenPos' => 33,
            'endFilePos' => 493,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 18,
        'endLine' => 18,
        'startColumn' => 5,
        'endColumn' => 39,
      ),
      'STRONG_EVIDENCE' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\ConfidenceCalculator',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\ConfidenceCalculator',
        'name' => 'STRONG_EVIDENCE',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'style_css_url\' => 95, \'rest_api_url\' => 90]',
          'attributes' => 
          array (
            'startLine' => 20,
            'endLine' => 23,
            'startTokenPos' => 44,
            'startFilePos' => 533,
            'endTokenPos' => 60,
            'endFilePos' => 600,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 20,
        'endLine' => 23,
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
 * @param list<array{matched: bool, confidence: int, metadata: array<string, mixed>}> $ruleResults
 *
 * @return int The calculated confidence score (0–100).
 */',
        'startLine' => 32,
        'endLine' => 64,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\WordPress',
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\ConfidenceCalculator',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\ConfidenceCalculator',
        'currentClassName' => 'App\\Modules\\Detection\\WordPress\\ConfidenceCalculator',
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