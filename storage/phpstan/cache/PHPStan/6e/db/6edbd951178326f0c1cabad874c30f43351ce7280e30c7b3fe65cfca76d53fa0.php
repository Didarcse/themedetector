<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Integration\Core\ApplicationBootstrapTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Integration\Core\ApplicationBootstrapTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-693f7079218e9b589632774ef727e490e4ecd0efe662528ad423358fa0d3ce9a',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Integration/Core/ApplicationBootstrapTest.php',
      ),
    ),
    'namespace' => 'Tests\\Integration\\Core',
    'name' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
    'shortName' => 'ApplicationBootstrapTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Integration tests for the Kernel Framework bootstrap process.
 *
 * Verifies that Application correctly coordinates service providers and
 * exposes the expected services through the dependency injection
 * container after boot().
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Integration: verifies collaboration between Application and its
 *   service providers.
 * - Fast, deterministic, and independent.
 * - Each test verifies exactly one behaviour.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 31,
    'endLine' => 189,
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
      'test_boot_registers_container' => 
      array (
        'name' => 'test_boot_registers_container',
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
        'startLine' => 33,
        'endLine' => 42,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Core',
        'declaringClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'implementingClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'currentClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'aliasName' => NULL,
      ),
      'test_boot_registers_http_client' => 
      array (
        'name' => 'test_boot_registers_http_client',
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
        'startLine' => 44,
        'endLine' => 53,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Core',
        'declaringClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'implementingClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'currentClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'aliasName' => NULL,
      ),
      'test_boot_registers_detection_manager' => 
      array (
        'name' => 'test_boot_registers_detection_manager',
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
        'startLine' => 55,
        'endLine' => 64,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Core',
        'declaringClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'implementingClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'currentClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'aliasName' => NULL,
      ),
      'test_boot_registers_detector_registry' => 
      array (
        'name' => 'test_boot_registers_detector_registry',
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
        'startLine' => 66,
        'endLine' => 75,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Core',
        'declaringClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'implementingClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'currentClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
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
        'startLine' => 77,
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Core',
        'declaringClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'implementingClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'currentClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'aliasName' => NULL,
      ),
      'test_application_container_is_singleton' => 
      array (
        'name' => 'test_application_container_is_singleton',
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
        'startLine' => 101,
        'endLine' => 110,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Core',
        'declaringClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'implementingClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'currentClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'aliasName' => NULL,
      ),
      'test_http_client_is_singleton' => 
      array (
        'name' => 'test_http_client_is_singleton',
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
        'startLine' => 112,
        'endLine' => 124,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Core',
        'declaringClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'implementingClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'currentClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'aliasName' => NULL,
      ),
      'test_detection_manager_is_singleton' => 
      array (
        'name' => 'test_detection_manager_is_singleton',
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
        'endLine' => 138,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Core',
        'declaringClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'implementingClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'currentClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'aliasName' => NULL,
      ),
      'test_boot_registers_detection_context_factory' => 
      array (
        'name' => 'test_boot_registers_detection_context_factory',
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
        'startLine' => 140,
        'endLine' => 149,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Core',
        'declaringClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'implementingClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'currentClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'aliasName' => NULL,
      ),
      'test_boot_registers_website_detector' => 
      array (
        'name' => 'test_boot_registers_website_detector',
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
        'startLine' => 151,
        'endLine' => 160,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Core',
        'declaringClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'implementingClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'currentClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'aliasName' => NULL,
      ),
      'test_detection_context_factory_is_singleton' => 
      array (
        'name' => 'test_detection_context_factory_is_singleton',
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
        'startLine' => 162,
        'endLine' => 174,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Core',
        'declaringClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'implementingClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'currentClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'aliasName' => NULL,
      ),
      'test_website_detector_is_singleton' => 
      array (
        'name' => 'test_website_detector_is_singleton',
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
        'startLine' => 176,
        'endLine' => 188,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Core',
        'declaringClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'implementingClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
        'currentClassName' => 'Tests\\Integration\\Core\\ApplicationBootstrapTest',
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