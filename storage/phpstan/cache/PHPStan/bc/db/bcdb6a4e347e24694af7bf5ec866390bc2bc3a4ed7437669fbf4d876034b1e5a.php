<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Core\Contracts\ServiceProviderInterface.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Core\Contracts\ServiceProviderInterface
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-a894556a566d5cceda49e5d02fbbdb40003cbfffa9ed108c84df8866cf012381',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Core\\Contracts\\ServiceProviderInterface',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Core/Contracts/ServiceProviderInterface.php',
      ),
    ),
    'namespace' => 'App\\Core\\Contracts',
    'name' => 'App\\Core\\Contracts\\ServiceProviderInterface',
    'shortName' => 'ServiceProviderInterface',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Contract for every service provider in the Kernel Framework.
 *
 * A service provider is responsible for registering related services into
 * the dependency injection container. Service providers enable modular
 * framework bootstrapping by grouping service registrations into cohesive
 * units.
 *
 * The interface defines only the registration contract.
 *
 * Responsibilities:
 *
 * - Register related services into the container.
 *
 * Design philosophy:
 *
 * - Dependency Injection and Inversion of Control: providers wire services
 *   into the container; consumers never construct them directly.
 * - Single Responsibility Principle: a provider groups related service
 *   registrations and nothing else.
 * - Open/Closed Principle: framework bootstrapping grows by adding
 *   providers, never by modifying existing ones.
 * - Stateless and side-effect free.
 * - Designed for implementation.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 34,
    'endLine' => 45,
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
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'register' => 
      array (
        'name' => 'register',
        'parameters' => 
        array (
          'container' => 
          array (
            'name' => 'container',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Core\\Container',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 44,
            'endLine' => 44,
            'startColumn' => 30,
            'endColumn' => 49,
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
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Register related services with the given container.
 *
 * @param Container $container The application dependency injection
 *                             container receiving the registrations.
 *
 * @return void
 */',
        'startLine' => 44,
        'endLine' => 44,
        'startColumn' => 5,
        'endColumn' => 57,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Core\\Contracts',
        'declaringClassName' => 'App\\Core\\Contracts\\ServiceProviderInterface',
        'implementingClassName' => 'App\\Core\\Contracts\\ServiceProviderInterface',
        'currentClassName' => 'App\\Core\\Contracts\\ServiceProviderInterface',
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