<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Squarespace\SquarespaceDetector.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Squarespace\SquarespaceDetector
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-d365d17425ffd13e3e33f9347f7e0e5ba8d0046edad05f9129cc183852e4dd5f',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Squarespace\\SquarespaceDetector',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Squarespace/SquarespaceDetector.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Squarespace',
    'name' => 'App\\Modules\\Detection\\Squarespace\\SquarespaceDetector',
    'shortName' => 'SquarespaceDetector',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Coordinates all Squarespace detection rules.
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
 *
 * Design philosophy:
 *
 * - This class performs pure orchestration only. It contains no detection
 *   logic, no HTML parsing, no DOM manipulation, no regular expressions,
 *   no HTTP requests, and no confidence calculation.
 * - The detector is stateless and deterministic: given the same context
 *   and rules, it always returns the same result.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 35,
    'endLine' => 110,
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
        'declaringClassName' => 'App\\Modules\\Detection\\Squarespace\\SquarespaceDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\Squarespace\\SquarespaceDetector',
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
        'startLine' => 41,
        'endLine' => 41,
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
        'declaringClassName' => 'App\\Modules\\Detection\\Squarespace\\SquarespaceDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\Squarespace\\SquarespaceDetector',
        'name' => 'confidenceCalculator',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Detection\\Squarespace\\ConfidenceCalculator',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 42,
        'endLine' => 42,
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
            'startLine' => 41,
            'endLine' => 41,
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
                'name' => 'App\\Modules\\Detection\\Squarespace\\ConfidenceCalculator',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 42,
            'endLine' => 42,
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
        'startLine' => 40,
        'endLine' => 44,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Squarespace',
        'declaringClassName' => 'App\\Modules\\Detection\\Squarespace\\SquarespaceDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\Squarespace\\SquarespaceDetector',
        'currentClassName' => 'App\\Modules\\Detection\\Squarespace\\SquarespaceDetector',
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
            'startLine' => 51,
            'endLine' => 51,
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
 * Execute all Squarespace detection rules against the given context.
 *
 * @param DetectionContext $context The immutable HTTP response context.
 */',
        'startLine' => 51,
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Squarespace',
        'declaringClassName' => 'App\\Modules\\Detection\\Squarespace\\SquarespaceDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\Squarespace\\SquarespaceDetector',
        'currentClassName' => 'App\\Modules\\Detection\\Squarespace\\SquarespaceDetector',
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
            'startLine' => 104,
            'endLine' => 104,
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
        'startLine' => 104,
        'endLine' => 109,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Squarespace',
        'declaringClassName' => 'App\\Modules\\Detection\\Squarespace\\SquarespaceDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\Squarespace\\SquarespaceDetector',
        'currentClassName' => 'App\\Modules\\Detection\\Squarespace\\SquarespaceDetector',
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