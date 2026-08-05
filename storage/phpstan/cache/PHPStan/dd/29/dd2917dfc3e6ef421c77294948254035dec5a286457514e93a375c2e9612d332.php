<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\Core\ContainerTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\Core\ContainerTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-47d9aed4a60b2e0d96c1185b877384d518e1775ef6f0b91628d594f2f22661dd',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\Core\\ContainerTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/Core/ContainerTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\Core',
    'name' => 'Tests\\Unit\\Core\\ContainerTest',
    'shortName' => 'ContainerTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Unit tests for the Kernel Framework dependency injection container.
 *
 * Verifies the complete public contract of Container: registration of
 * object instances and factory callables, lazy resolution, singleton
 * caching, identifier probing, and exception behaviour.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Fast, deterministic, and independent.
 * - No external dependencies beyond the container itself.
 * - Each test verifies exactly one behaviour.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 25,
    'endLine' => 208,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'PHPUnit\\Framework\\TestCase',
    'implementsClassNames' => 
    array (
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
      'test_registers_object_instance' => 
      array (
        'name' => 'test_registers_object_instance',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 27,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'aliasName' => NULL,
      ),
      'test_registers_factory' => 
      array (
        'name' => 'test_registers_factory',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 37,
        'endLine' => 47,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'aliasName' => NULL,
      ),
      'test_factory_is_lazy' => 
      array (
        'name' => 'test_factory_is_lazy',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 49,
        'endLine' => 65,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'aliasName' => NULL,
      ),
      'test_factory_executes_only_once' => 
      array (
        'name' => 'test_factory_executes_only_once',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 67,
        'endLine' => 83,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'aliasName' => NULL,
      ),
      'test_returns_same_singleton_instance' => 
      array (
        'name' => 'test_returns_same_singleton_instance',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 85,
        'endLine' => 98,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'aliasName' => NULL,
      ),
      'test_has_returns_true_for_registered_service' => 
      array (
        'name' => 'test_has_returns_true_for_registered_service',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 100,
        'endLine' => 107,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'aliasName' => NULL,
      ),
      'test_has_returns_false_for_unknown_service' => 
      array (
        'name' => 'test_has_returns_false_for_unknown_service',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 109,
        'endLine' => 114,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'aliasName' => NULL,
      ),
      'test_get_throws_service_not_found_exception' => 
      array (
        'name' => 'test_get_throws_service_not_found_exception',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 116,
        'endLine' => 124,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'aliasName' => NULL,
      ),
      'test_factory_receives_container' => 
      array (
        'name' => 'test_factory_receives_container',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 126,
        'endLine' => 140,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'aliasName' => NULL,
      ),
      'test_object_registration_is_returned_directly' => 
      array (
        'name' => 'test_object_registration_is_returned_directly',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 142,
        'endLine' => 153,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'aliasName' => NULL,
      ),
      'test_reregistering_service_replaces_previous_instance' => 
      array (
        'name' => 'test_reregistering_service_replaces_previous_instance',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 155,
        'endLine' => 168,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'aliasName' => NULL,
      ),
      'test_reregistering_factory_discards_cached_instance' => 
      array (
        'name' => 'test_reregistering_factory_discards_cached_instance',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 170,
        'endLine' => 188,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'aliasName' => NULL,
      ),
      'test_multiple_services_can_be_registered' => 
      array (
        'name' => 'test_multiple_services_can_be_registered',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 190,
        'endLine' => 207,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ContainerTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ContainerTest',
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