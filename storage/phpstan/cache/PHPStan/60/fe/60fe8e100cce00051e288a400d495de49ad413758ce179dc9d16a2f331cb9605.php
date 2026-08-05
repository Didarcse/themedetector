<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Core\Exceptions\ServiceNotFoundException.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Core\Exceptions\ServiceNotFoundException
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-02f0c6ff35063de583b89de0a62d5309071409fb24de617a438cd6843f4a8e2f',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Core\\Exceptions\\ServiceNotFoundException',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Core/Exceptions/ServiceNotFoundException.php',
      ),
    ),
    'namespace' => 'App\\Core\\Exceptions',
    'name' => 'App\\Core\\Exceptions\\ServiceNotFoundException',
    'shortName' => 'ServiceNotFoundException',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Thrown when a requested service identifier does not exist in the
 * dependency injection container.
 *
 * The exception is thrown exclusively by Container::get() when the
 * requested service has not been registered. It indicates a container
 * configuration or composition error rather than a runtime application
 * failure.
 *
 * Responsibilities:
 *
 * - Represent a missing service registration.
 * - Signal a wiring defect at composition root time.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: it represents a missing service
 *   registration and nothing else.
 * - Marker exception: it carries no state and provides no behaviour.
 * - Stateless and side-effect free.
 * - Designed to be thrown by the dependency injection container.
 * - Future PSR-11 compatible.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 30,
    'endLine' => 32,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'App\\Core\\Exceptions\\ContainerException',
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