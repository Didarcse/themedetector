<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\vendor\phpunit\phpunit\src\Framework\Constraint\Constraint.php-PHPStan\BetterReflection\Reflection\ReflectionClass-PHPUnit\Framework\Constraint\Constraint
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-0bf94fdf226137aa3d4ccc89a56b166b60085809f8ae1435a18b78a001297201',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'filename' => 'C:/xampp/htdocs/themedetector/vendor/phpunit/phpunit/src/Framework/Constraint/Constraint.php',
      ),
    ),
    'namespace' => 'PHPUnit\\Framework\\Constraint',
    'name' => 'PHPUnit\\Framework\\Constraint\\Constraint',
    'shortName' => 'Constraint',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 64,
    'docComment' => '/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 31,
    'endLine' => 281,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'Countable',
      1 => 'PHPUnit\\Framework\\SelfDescribing',
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
      'evaluate' => 
      array (
        'name' => 'evaluate',
        'parameters' => 
        array (
          'other' => 
          array (
            'name' => 'other',
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
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 45,
            'endLine' => 45,
            'startColumn' => 30,
            'endColumn' => 41,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'description' => 
          array (
            'name' => 'description',
            'default' => 
            array (
              'code' => '\'\'',
              'attributes' => 
              array (
                'startLine' => 45,
                'endLine' => 45,
                'startTokenPos' => 145,
                'startFilePos' => 1382,
                'endTokenPos' => 145,
                'endFilePos' => 1383,
              ),
            ),
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
            'startLine' => 45,
            'endLine' => 45,
            'startColumn' => 44,
            'endColumn' => 67,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'returnResult' => 
          array (
            'name' => 'returnResult',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 45,
                'endLine' => 45,
                'startTokenPos' => 154,
                'startFilePos' => 1407,
                'endTokenPos' => 154,
                'endFilePos' => 1411,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 45,
            'endLine' => 45,
            'startColumn' => 70,
            'endColumn' => 95,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
          'data' => 
          array (
            'types' => 
            array (
              0 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'bool',
                  'isIdentifier' => true,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'null',
                  'isIdentifier' => true,
                ),
              ),
            ),
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Evaluates the constraint for parameter $other.
 *
 * If $returnResult is set to false (the default), an exception is thrown
 * in case of a failure. null is returned otherwise.
 *
 * If $returnResult is true, the result of the evaluation is returned as
 * a boolean value instead: true in case of success, false in case of a
 * failure.
 *
 * @throws ExpectationFailedException
 */',
        'startLine' => 45,
        'endLine' => 62,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPUnit\\Framework\\Constraint',
        'declaringClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'implementingClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'currentClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'aliasName' => NULL,
      ),
      'count' => 
      array (
        'name' => 'count',
        'parameters' => 
        array (
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
 * Counts the number of constraint elements.
 */',
        'startLine' => 67,
        'endLine' => 70,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PHPUnit\\Framework\\Constraint',
        'declaringClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'implementingClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'currentClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'aliasName' => NULL,
      ),
      'matches' => 
      array (
        'name' => 'matches',
        'parameters' => 
        array (
          'other' => 
          array (
            'name' => 'other',
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
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 78,
            'endLine' => 78,
            'startColumn' => 32,
            'endColumn' => 43,
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
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Evaluates the constraint for parameter $other. Returns true if the
 * constraint is met, false otherwise.
 *
 * This method can be overridden to implement the evaluation algorithm.
 */',
        'startLine' => 78,
        'endLine' => 81,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPUnit\\Framework\\Constraint',
        'declaringClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'implementingClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'currentClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'aliasName' => NULL,
      ),
      'fail' => 
      array (
        'name' => 'fail',
        'parameters' => 
        array (
          'other' => 
          array (
            'name' => 'other',
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
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 88,
            'endLine' => 88,
            'startColumn' => 29,
            'endColumn' => 40,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'description' => 
          array (
            'name' => 'description',
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
            'startLine' => 88,
            'endLine' => 88,
            'startColumn' => 43,
            'endColumn' => 61,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'comparisonFailure' => 
          array (
            'name' => 'comparisonFailure',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 88,
                'endLine' => 88,
                'startTokenPos' => 308,
                'startFilePos' => 2389,
                'endTokenPos' => 308,
                'endFilePos' => 2392,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
              'data' => 
              array (
                'types' => 
                array (
                  0 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'SebastianBergmann\\Comparator\\ComparisonFailure',
                      'isIdentifier' => false,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'null',
                      'isIdentifier' => true,
                    ),
                  ),
                ),
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 88,
            'endLine' => 88,
            'startColumn' => 64,
            'endColumn' => 107,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'never',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Throws an exception for the given compared value and test description.
 *
 * @throws ExpectationFailedException
 */',
        'startLine' => 88,
        'endLine' => 109,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPUnit\\Framework\\Constraint',
        'declaringClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'implementingClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'currentClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'aliasName' => NULL,
      ),
      'additionalFailureDescription' => 
      array (
        'name' => 'additionalFailureDescription',
        'parameters' => 
        array (
          'other' => 
          array (
            'name' => 'other',
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
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 117,
            'endLine' => 117,
            'startColumn' => 53,
            'endColumn' => 64,
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
 * Return additional failure description where needed.
 *
 * The function can be overridden to provide additional failure
 * information like a diff
 */',
        'startLine' => 117,
        'endLine' => 120,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPUnit\\Framework\\Constraint',
        'declaringClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'implementingClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'currentClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'aliasName' => NULL,
      ),
      'failureDescription' => 
      array (
        'name' => 'failureDescription',
        'parameters' => 
        array (
          'other' => 
          array (
            'name' => 'other',
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
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 131,
            'endLine' => 131,
            'startColumn' => 43,
            'endColumn' => 54,
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
 * Returns the description of the failure.
 *
 * The beginning of failure messages is "Failed asserting that" in most
 * cases. This method should return the second part of that sentence.
 *
 * To provide additional failure information additionalFailureDescription
 * can be used.
 */',
        'startLine' => 131,
        'endLine' => 134,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPUnit\\Framework\\Constraint',
        'declaringClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'implementingClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'currentClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'aliasName' => NULL,
      ),
      'toStringInContext' => 
      array (
        'name' => 'toStringInContext',
        'parameters' => 
        array (
          'operator' => 
          array (
            'name' => 'operator',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PHPUnit\\Framework\\Constraint\\Operator',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 148,
            'endLine' => 148,
            'startColumn' => 42,
            'endColumn' => 59,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'role' => 
          array (
            'name' => 'role',
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
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 148,
            'endLine' => 148,
            'startColumn' => 62,
            'endColumn' => 72,
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
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Returns a custom string representation of the constraint object when it
 * appears in context of an $operator expression.
 *
 * The purpose of this method is to provide meaningful descriptive string
 * in context of operators such as LogicalNot. Native PHPUnit constraints
 * are supported out of the box by LogicalNot, but externally developed
 * ones had no way to provide correct strings in this context.
 *
 * The method shall return empty string, when it does not handle
 * customization by itself.
 */',
        'startLine' => 148,
        'endLine' => 151,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPUnit\\Framework\\Constraint',
        'declaringClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'implementingClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'currentClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'aliasName' => NULL,
      ),
      'failureDescriptionInContext' => 
      array (
        'name' => 'failureDescriptionInContext',
        'parameters' => 
        array (
          'operator' => 
          array (
            'name' => 'operator',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PHPUnit\\Framework\\Constraint\\Operator',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 165,
            'endLine' => 165,
            'startColumn' => 52,
            'endColumn' => 69,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'role' => 
          array (
            'name' => 'role',
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
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 165,
            'endLine' => 165,
            'startColumn' => 72,
            'endColumn' => 82,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'other' => 
          array (
            'name' => 'other',
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
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 165,
            'endLine' => 165,
            'startColumn' => 85,
            'endColumn' => 96,
            'parameterIndex' => 2,
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
 * Returns the description of the failure when this constraint appears in
 * context of an $operator expression.
 *
 * The purpose of this method is to provide meaningful failure description
 * in context of operators such as LogicalNot. Native PHPUnit constraints
 * are supported out of the box by LogicalNot, but externally developed
 * ones had no way to provide correct messages in this context.
 *
 * The method shall return empty string, when it does not handle
 * customization by itself.
 */',
        'startLine' => 165,
        'endLine' => 174,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPUnit\\Framework\\Constraint',
        'declaringClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'implementingClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'currentClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'aliasName' => NULL,
      ),
      'reduce' => 
      array (
        'name' => 'reduce',
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
 * Reduces the sub-expression starting at $this by skipping degenerate
 * sub-expression and returns first descendant constraint that starts
 * a non-reducible sub-expression.
 *
 * Returns $this for terminal constraints and for operators that start
 * non-reducible sub-expression, or the nearest descendant of $this that
 * starts a non-reducible sub-expression.
 *
 * A constraint expression may be modelled as a tree with non-terminal
 * nodes (operators) and terminal nodes. For example:
 *
 *      LogicalOr           (operator, non-terminal)
 *      + LogicalAnd        (operator, non-terminal)
 *      | + IsType(\'int\')   (terminal)
 *      | + GreaterThan(10) (terminal)
 *      + LogicalNot        (operator, non-terminal)
 *        + IsType(\'array\') (terminal)
 *
 * A degenerate sub-expression is a part of the tree, that effectively does
 * not contribute to the evaluation of the expression it appears in. An example
 * of degenerate sub-expression is a BinaryOperator constructed with single
 * operand or nested BinaryOperators, each with single operand. An
 * expression involving a degenerate sub-expression is equivalent to a
 * reduced expression with the degenerate sub-expression removed, for example
 *
 *      LogicalAnd          (operator)
 *      + LogicalOr         (degenerate operator)
 *      | + LogicalAnd      (degenerate operator)
 *      |   + IsType(\'int\') (terminal)
 *      + GreaterThan(10)   (terminal)
 *
 * is equivalent to
 *
 *      LogicalAnd          (operator)
 *      + IsType(\'int\')     (terminal)
 *      + GreaterThan(10)   (terminal)
 *
 * because the subexpression
 *
 *      + LogicalOr
 *        + LogicalAnd
 *          + -
 *
 * is degenerate. Calling reduce() on the LogicalOr object above, as well
 * as on LogicalAnd, shall return the IsType(\'int\') instance.
 *
 * Other specific reductions can be implemented, for example cascade of
 * LogicalNot operators
 *
 *      + LogicalNot
 *        + LogicalNot
 *          +LogicalNot
 *           + IsTrue
 *
 * can be reduced to
 *
 *      LogicalNot
 *      + IsTrue
 */',
        'startLine' => 236,
        'endLine' => 239,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPUnit\\Framework\\Constraint',
        'declaringClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'implementingClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'currentClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'aliasName' => NULL,
      ),
      'valueToTypeStringFragment' => 
      array (
        'name' => 'valueToTypeStringFragment',
        'parameters' => 
        array (
          'value' => 
          array (
            'name' => 'value',
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
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 244,
            'endLine' => 244,
            'startColumn' => 50,
            'endColumn' => 61,
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
 * @return non-empty-string
 */',
        'startLine' => 244,
        'endLine' => 280,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PHPUnit\\Framework\\Constraint',
        'declaringClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'implementingClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
        'currentClassName' => 'PHPUnit\\Framework\\Constraint\\Constraint',
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