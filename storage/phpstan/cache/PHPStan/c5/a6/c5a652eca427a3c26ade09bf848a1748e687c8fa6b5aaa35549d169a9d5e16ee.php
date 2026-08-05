<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Drupal\DrupalDetector.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Drupal\DrupalDetector
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-7fcbe87eea6a750596d2ce0bd6a9795d64e0a24f3bbf11674ee34815c2534ccd',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Drupal\\DrupalDetector',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Drupal/DrupalDetector.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Drupal',
    'name' => 'App\\Modules\\Detection\\Drupal\\DrupalDetector',
    'shortName' => 'DrupalDetector',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Coordinates all Drupal detection rules.
 *
 * Executes every registered RuleInterface against the supplied context,
 * collects the rule results, extracts the names of matched rules, merges
 * their metadata, calculates the final confidence score via the
 * ConfidenceCalculator, and returns a DetectionResult.
 *
 * Responsibilities:
 *
 * - Iterate over every registered rule in the order it was provided.
 * - Delegate evaluation of each detection signal to the rule itself.
 * - Aggregate matched rule names and merged metadata into the result.
 * - Delegate score aggregation to the ConfidenceCalculator.
 * - Produce a fully-formed DetectionResult for both matched and
 *   unmatched outcomes.
 *
 * Design philosophy:
 *
 * - This class performs pure orchestration only. It contains no Drupal
 *   detection logic, no HTML parsing, no DOM manipulation, no regular
 *   expressions, no HTTP requests, and no confidence calculation.
 * - The detector is stateless, deterministic, and side-effect free: given
 *   the same context and rules, it always returns the same result.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 37,
    'endLine' => 112,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Modules\\Detection\\DetectorInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'rules' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Drupal\\DrupalDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\Drupal\\DrupalDetector',
        'name' => 'rules',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'iterable',
            'isIdentifier' => true,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 43,
        'endLine' => 43,
        'startColumn' => 9,
        'endColumn' => 31,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'confidenceCalculator' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Drupal\\DrupalDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\Drupal\\DrupalDetector',
        'name' => 'confidenceCalculator',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Detection\\Drupal\\ConfidenceCalculator',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 44,
        'endLine' => 44,
        'startColumn' => 9,
        'endColumn' => 58,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'rules' => 
          array (
            'name' => 'rules',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'iterable',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 43,
            'endLine' => 43,
            'startColumn' => 9,
            'endColumn' => 31,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'confidenceCalculator' => 
          array (
            'name' => 'confidenceCalculator',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Detection\\Drupal\\ConfidenceCalculator',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 44,
            'endLine' => 44,
            'startColumn' => 9,
            'endColumn' => 58,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param iterable<RuleInterface> $rules The detection rules to execute.
 */',
        'startLine' => 42,
        'endLine' => 46,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Drupal',
        'declaringClassName' => 'App\\Modules\\Detection\\Drupal\\DrupalDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\Drupal\\DrupalDetector',
        'currentClassName' => 'App\\Modules\\Detection\\Drupal\\DrupalDetector',
        'aliasName' => NULL,
      ),
      'detect' => 
      array (
        'name' => 'detect',
        'parameters' => 
        array (
          'context' => 
          array (
            'name' => 'context',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Detection\\DetectionContext',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 53,
            'endLine' => 53,
            'startColumn' => 28,
            'endColumn' => 52,
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
            'name' => 'App\\Modules\\Detection\\DetectionResult',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Execute all Drupal detection rules against the given context.
 *
 * @param DetectionContext $context The immutable HTTP response context.
 */',
        'startLine' => 53,
        'endLine' => 101,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Drupal',
        'declaringClassName' => 'App\\Modules\\Detection\\Drupal\\DrupalDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\Drupal\\DrupalDetector',
        'currentClassName' => 'App\\Modules\\Detection\\Drupal\\DrupalDetector',
        'aliasName' => NULL,
      ),
      'ruleName' => 
      array (
        'name' => 'ruleName',
        'parameters' => 
        array (
          'rule' => 
          array (
            'name' => 'rule',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'object',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 106,
            'endLine' => 106,
            'startColumn' => 31,
            'endColumn' => 42,
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
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Extract the short class name from a rule instance.
 */',
        'startLine' => 106,
        'endLine' => 111,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Drupal',
        'declaringClassName' => 'App\\Modules\\Detection\\Drupal\\DrupalDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\Drupal\\DrupalDetector',
        'currentClassName' => 'App\\Modules\\Detection\\Drupal\\DrupalDetector',
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