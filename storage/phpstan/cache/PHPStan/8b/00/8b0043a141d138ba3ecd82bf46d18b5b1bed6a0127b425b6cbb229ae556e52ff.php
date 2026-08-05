<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Joomla\ConfidenceCalculator.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Joomla\ConfidenceCalculator
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-6570f7cdabf58b65d515989b0eab4a34d5168f71c458244233507729ea5878d9',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Joomla\\ConfidenceCalculator',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Joomla/ConfidenceCalculator.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Joomla',
    'name' => 'App\\Modules\\Detection\\Joomla\\ConfidenceCalculator',
    'shortName' => 'ConfidenceCalculator',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Calculates the final Joomla detection confidence score.
 *
 * The calculator aggregates the weights of every matched detection rule
 * into a single, deterministic confidence score clamped to the inclusive
 * range 0–100.
 *
 * Responsibilities:
 *
 * - Accept the evaluation results produced by every Joomla rule.
 * - Sum the weights of all matched rules and clamp the total to the
 *   inclusive range 0–100.
 *
 * Design philosophy:
 *
 * - This class performs score aggregation and nothing else. It contains
 *   no HTML parsing, no DOM manipulation, no regular expressions, no HTTP
 *   requests, and no Joomla-specific detection logic.
 * - Each rule result is treated independently: unmatched rules are
 *   ignored, and the weights of matched rules are accumulated. The final
 *   total is clamped on both ends so callers always receive a valid
 *   percentage score, even in the presence of unexpected negative weights.
 * - The calculator is stateless and side-effect free. Given identical
 *   input, it always returns identical output, which keeps detection
 *   reproducible and trivially testable.
 *
 * The class must never be extended or subclassed.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 35,
    'endLine' => 72,
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
        'declaringClassName' => 'App\\Modules\\Detection\\Joomla\\ConfidenceCalculator',
        'implementingClassName' => 'App\\Modules\\Detection\\Joomla\\ConfidenceCalculator',
        'name' => 'MAX_SCORE',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '100',
          'attributes' => 
          array (
            'startLine' => 40,
            'endLine' => 40,
            'startTokenPos' => 37,
            'startFilePos' => 1394,
            'endTokenPos' => 37,
            'endFilePos' => 1396,
          ),
        ),
        'docComment' => '/**
 * The maximum achievable confidence score.
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 40,
        'endLine' => 40,
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
            'startLine' => 58,
            'endLine' => 58,
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
        'startLine' => 58,
        'endLine' => 71,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Joomla',
        'declaringClassName' => 'App\\Modules\\Detection\\Joomla\\ConfidenceCalculator',
        'implementingClassName' => 'App\\Modules\\Detection\\Joomla\\ConfidenceCalculator',
        'currentClassName' => 'App\\Modules\\Detection\\Joomla\\ConfidenceCalculator',
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