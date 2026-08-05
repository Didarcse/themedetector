<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\vendor\phpunit\phpunit\src\Framework\MockObject\Runtime\Builder\ParametersMatch.php-PHPStan\BetterReflection\Reflection\ReflectionClass-PHPUnit\Framework\MockObject\Builder\ParametersMatch
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-a38732ba636f5dcaf358f1c01b02ff7557e900822aaf14978ec99b3062791b4a',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'PHPUnit\\Framework\\MockObject\\Builder\\ParametersMatch',
        'filename' => 'C:/xampp/htdocs/themedetector/vendor/phpunit/phpunit/src/Framework/MockObject/Runtime/Builder/ParametersMatch.php',
      ),
    ),
    'namespace' => 'PHPUnit\\Framework\\MockObject\\Builder',
    'name' => 'PHPUnit\\Framework\\MockObject\\Builder\\ParametersMatch',
    'shortName' => 'ParametersMatch',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * @internal This interface is not covered by the backward compatibility promise for PHPUnit
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 15,
    'endLine' => 51,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'PHPUnit\\Framework\\MockObject\\Builder\\Stub',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'after' => 
      array (
        'name' => 'after',
        'parameters' => 
        array (
          'id' => 
          array (
            'name' => 'id',
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
            'startLine' => 20,
            'endLine' => 20,
            'startColumn' => 27,
            'endColumn' => 36,
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
            'name' => 'PHPUnit\\Framework\\MockObject\\Builder\\Stub',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Defines the expectation which must occur before the current is valid.
 */',
        'startLine' => 20,
        'endLine' => 20,
        'startColumn' => 5,
        'endColumn' => 44,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPUnit\\Framework\\MockObject\\Builder',
        'declaringClassName' => 'PHPUnit\\Framework\\MockObject\\Builder\\ParametersMatch',
        'implementingClassName' => 'PHPUnit\\Framework\\MockObject\\Builder\\ParametersMatch',
        'currentClassName' => 'PHPUnit\\Framework\\MockObject\\Builder\\ParametersMatch',
        'aliasName' => NULL,
      ),
      'with' => 
      array (
        'name' => 'with',
        'parameters' => 
        array (
          'arguments' => 
          array (
            'name' => 'arguments',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'mixed',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => true,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 37,
            'endLine' => 37,
            'startColumn' => 26,
            'endColumn' => 44,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'self',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Sets the parameters to match for, each parameter to this function will
 * be part of match. To perform specific matches or constraints create a
 * new PHPUnit\\Framework\\Constraint\\Constraint and use it for the parameter.
 * If the parameter value is not a constraint it will use the
 * PHPUnit\\Framework\\Constraint\\IsEqual for the value.
 *
 * Some examples:
 * <code>
 * // match first parameter with value 2
 * $b->with(2);
 * // match first parameter with value \'smock\' and second identical to 42
 * $b->with(\'smock\', new PHPUnit\\Framework\\Constraint\\IsEqual(42));
 * </code>
 */',
        'startLine' => 37,
        'endLine' => 37,
        'startColumn' => 5,
        'endColumn' => 52,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => true,
        'modifiers' => 1,
        'namespace' => 'PHPUnit\\Framework\\MockObject\\Builder',
        'declaringClassName' => 'PHPUnit\\Framework\\MockObject\\Builder\\ParametersMatch',
        'implementingClassName' => 'PHPUnit\\Framework\\MockObject\\Builder\\ParametersMatch',
        'currentClassName' => 'PHPUnit\\Framework\\MockObject\\Builder\\ParametersMatch',
        'aliasName' => NULL,
      ),
      'withAnyParameters' => 
      array (
        'name' => 'withAnyParameters',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'self',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Sets a rule which allows any kind of parameters.
 *
 * Some examples:
 * <code>
 * // match any number of parameters
 * $b->withAnyParameters();
 * </code>
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */',
        'startLine' => 50,
        'endLine' => 50,
        'startColumn' => 5,
        'endColumn' => 46,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPUnit\\Framework\\MockObject\\Builder',
        'declaringClassName' => 'PHPUnit\\Framework\\MockObject\\Builder\\ParametersMatch',
        'implementingClassName' => 'PHPUnit\\Framework\\MockObject\\Builder\\ParametersMatch',
        'currentClassName' => 'PHPUnit\\Framework\\MockObject\\Builder\\ParametersMatch',
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