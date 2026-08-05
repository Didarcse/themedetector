<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\WordPress\WordPressDetector.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\WordPress\WordPressDetector
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-89752b398f364b43bab269a45c7feb972b3efebd0f5a9eb621fa3445e9ec11a7',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/WordPress/WordPressDetector.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\WordPress',
    'name' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
    'shortName' => 'WordPressDetector',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Coordinates all WordPress detection rules.
 *
 * Iterates through every registered RuleInterface, collects results,
 * merges metadata, calculates the final confidence score via
 * ConfidenceCalculator, and returns a DetectionResult.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 19,
    'endLine' => 108,
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
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
        'name' => 'rules',
        'modifiers' => 132,
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
        'startLine' => 25,
        'endLine' => 25,
        'startColumn' => 9,
        'endColumn' => 40,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'confidenceCalculator' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
        'name' => 'confidenceCalculator',
        'modifiers' => 132,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Detection\\WordPress\\ConfidenceCalculator',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 26,
        'endLine' => 26,
        'startColumn' => 9,
        'endColumn' => 67,
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
            'startLine' => 25,
            'endLine' => 25,
            'startColumn' => 9,
            'endColumn' => 40,
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
                'name' => 'App\\Modules\\Detection\\WordPress\\ConfidenceCalculator',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 26,
            'endLine' => 26,
            'startColumn' => 9,
            'endColumn' => 67,
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
 * @param iterable<RuleInterface> $rules
 */',
        'startLine' => 24,
        'endLine' => 28,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\WordPress',
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
        'currentClassName' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
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
            'startLine' => 35,
            'endLine' => 35,
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
 * Execute WordPress detection rules against the given context.
 *
 * @param DetectionContext $context The immutable HTTP response context.
 */',
        'startLine' => 35,
        'endLine' => 80,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\WordPress',
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
        'currentClassName' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
        'aliasName' => NULL,
      ),
      'extractPlugins' => 
      array (
        'name' => 'extractPlugins',
        'parameters' => 
        array (
          'metadata' => 
          array (
            'name' => 'metadata',
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
            'startLine' => 92,
            'endLine' => 92,
            'startColumn' => 37,
            'endColumn' => 51,
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
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Extract the detected plugin list from the merged rule metadata.
 *
 * Only string entries are retained, guaranteeing the result is a
 * list<string> regardless of the metadata content.
 *
 * @param array<string, mixed> $metadata The merged rule metadata.
 *
 * @return list<string> The detected plugin names.
 */',
        'startLine' => 92,
        'endLine' => 107,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\WordPress',
        'declaringClassName' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
        'currentClassName' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
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