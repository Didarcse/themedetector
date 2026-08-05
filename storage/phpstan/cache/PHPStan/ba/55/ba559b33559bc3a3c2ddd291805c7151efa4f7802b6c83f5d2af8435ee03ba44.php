<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Wix\ConfidenceCalculator.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Wix\ConfidenceCalculator
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-6604b83ab97371221faebf10a6c209ac8794fab0abc6e2735b0a7839486ad0bc',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Wix\\ConfidenceCalculator',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Wix/ConfidenceCalculator.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Wix',
    'name' => 'App\\Modules\\Detection\\Wix\\ConfidenceCalculator',
    'shortName' => 'ConfidenceCalculator',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Calculates the final Wix detection confidence score.
 *
 * The calculator aggregates the weights of every matched detection rule
 * into a single, deterministic confidence score clamped to the range
 * 0–100.
 *
 * Design philosophy:
 *
 * - This class is responsible for score aggregation and nothing else. It
 *   is intentionally free of HTML parsing, regular expressions, DOM
 *   manipulation, HTTP traffic, and any Wix-specific detection logic.
 * - Each rule result is treated independently: unmatched rules are
 *   ignored, and the weights of matched rules are accumulated. The final
 *   total is clamped so callers always receive a valid percentage score.
 * - The calculator is stateless and side-effect free. Given the same
 *   input, it always returns the same output, which keeps detection
 *   reproducible and trivially testable.
 *
 * The class must never be extended or subclassed.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 28,
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
      'MAX_SCORE' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Wix\\ConfidenceCalculator',
        'implementingClassName' => 'App\\Modules\\Detection\\Wix\\ConfidenceCalculator',
        'name' => 'MAX_SCORE',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '100',
          'attributes' => 
          array (
            'startLine' => 33,
            'endLine' => 33,
            'startTokenPos' => 37,
            'startFilePos' => 1124,
            'endTokenPos' => 37,
            'endFilePos' => 1126,
          ),
        ),
        'docComment' => '/**
 * The maximum achievable confidence score.
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 33,
        'endLine' => 33,
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
            'startLine' => 51,
            'endLine' => 51,
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
 * Calculate the final confidence score from rule evaluation results.
 *
 * Rules that did not match are skipped. The weights of all matched
 * rules are summed, and the resulting total is clamped to the
 * inclusive range 0–100 — guarding against both runaway totals and
 * unexpected negative weights.
 *
 * @param list<array{
 *     matched: bool,
 *     weight: int,
 *     metadata: array<string, mixed>
 * }> $ruleResults The evaluation results produced by the detection rules.
 *
 * @return int The final confidence score, always between 0 and 100.
 */',
        'startLine' => 51,
        'endLine' => 64,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Wix',
        'declaringClassName' => 'App\\Modules\\Detection\\Wix\\ConfidenceCalculator',
        'implementingClassName' => 'App\\Modules\\Detection\\Wix\\ConfidenceCalculator',
        'currentClassName' => 'App\\Modules\\Detection\\Wix\\ConfidenceCalculator',
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