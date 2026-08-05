<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\Core\ApplicationTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\Core\ApplicationTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-ea4ee36b457f0fd5b0082267d5ab66a37c0a1ae0e9abc5327f3fbe405d5d958a',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\Core\\ApplicationTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/Core/ApplicationTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\Core',
    'name' => 'Tests\\Unit\\Core\\ApplicationTest',
    'shortName' => 'ApplicationTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Unit tests for the Kernel Framework Application composition root.
 *
 * Verifies the complete public contract of Application: creation of the
 * owned container, access to the same container instance, framework
 * bootstrapping, and idempotent boot behaviour.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Fast, deterministic, and independent.
 * - No external dependencies beyond the application itself.
 * - Each test verifies exactly one behaviour.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 25,
    'endLine' => 83,
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
      'test_creates_container_on_construction' => 
      array (
        'name' => 'test_creates_container_on_construction',
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
        'endLine' => 32,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'aliasName' => NULL,
      ),
      'test_container_returns_same_instance' => 
      array (
        'name' => 'test_container_returns_same_instance',
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
        'startLine' => 34,
        'endLine' => 39,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'aliasName' => NULL,
      ),
      'test_boot_registers_container_service' => 
      array (
        'name' => 'test_boot_registers_container_service',
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
        'startLine' => 41,
        'endLine' => 50,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'aliasName' => NULL,
      ),
      'test_boot_is_idempotent' => 
      array (
        'name' => 'test_boot_is_idempotent',
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
        'startLine' => 52,
        'endLine' => 63,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'aliasName' => NULL,
      ),
      'test_container_can_resolve_itself_after_boot' => 
      array (
        'name' => 'test_container_can_resolve_itself_after_boot',
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
        'startLine' => 65,
        'endLine' => 74,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'aliasName' => NULL,
      ),
      'test_new_application_creates_new_container' => 
      array (
        'name' => 'test_new_application_creates_new_container',
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
        'startLine' => 76,
        'endLine' => 82,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Core',
        'declaringClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'implementingClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
        'currentClassName' => 'Tests\\Unit\\Core\\ApplicationTest',
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