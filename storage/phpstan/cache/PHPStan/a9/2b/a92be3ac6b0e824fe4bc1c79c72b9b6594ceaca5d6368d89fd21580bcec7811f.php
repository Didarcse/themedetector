<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Http\Exceptions\HttpClientException.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Http\Exceptions\HttpClientException
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-63ccccf502fe96b25e58b84eeaefb0b791432121b87d78789e081a50c74ff112',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Http\\Exceptions\\HttpClientException',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Http/Exceptions/HttpClientException.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Http\\Exceptions',
    'name' => 'App\\Modules\\Http\\Exceptions\\HttpClientException',
    'shortName' => 'HttpClientException',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Base exception for every HTTP client failure in the ThemeDetectorTool
 * platform.
 *
 * Every HTTP-related exception must extend this class. Examples include
 * InvalidUrlException, TransportException, TimeoutException,
 * TooManyRedirectsException, and SSLException. The base exception
 * represents failures occurring while performing outbound HTTP
 * communication.
 *
 * The class extends HttpException so that every client failure remains
 * catchable through the legacy HttpException contract, in addition to
 * the more specific HttpClientException family.
 *
 * Responsibilities:
 *
 * - Represent HTTP client failures.
 * - Serve as the common parent exception for all HTTP-related
 *   exceptions.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: this is an exception base class
 *   only. It performs no HTTP requests, contains no HTTP logic, and
 *   stores no request data.
 * - The class is stateless and side-effect free, and it is designed for
 *   inheritance: future exceptions must extend this class.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 37,
    'endLine' => 39,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'App\\Modules\\Http\\HttpException',
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