<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Http\HttpClientInterface.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Http\HttpClientInterface
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-6ff42adccc17a363bd2f5ce48e0c2eaf9693bcf02b2d2f473ab2eeda02714866',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Http\\HttpClientInterface',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Http/HttpClientInterface.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Http',
    'name' => 'App\\Modules\\Http\\HttpClientInterface',
    'shortName' => 'HttpClientInterface',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Contract for every HTTP client implementation used by the
 * ThemeDetectorTool platform.
 *
 * The interface abstracts all outbound HTTP communication. It allows the
 * Detection Engine, Theme Extraction Engine, Plugin Detection Engine, and
 * future Website Intelligence modules to retrieve remote resources
 * without depending on a concrete HTTP implementation.
 *
 * Responsibilities:
 *
 * - Perform HTTP GET requests against a given absolute URL.
 * - Return the response as an immutable HttpResponse value object.
 * - Signal transport-level failures through HttpException.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: the interface covers only outbound
 *   HTTP communication. It knows nothing about CMS detection, HTML
 *   parsing, theme extraction, or plugin extraction.
 * - Dependency Inversion Principle: consumers depend on this abstraction
 *   rather than on a concrete transport (cURL, Guzzle, sockets, etc.).
 * - Every implementation is stateless, deterministic, and side-effect
 *   free except for the network I/O inherent to performing a request.
 * - Every implementation must honour the same contract: given the same
 *   URL it produces the same shape of response, and it must never expose
 *   any technology-specific knowledge (WordPress, Joomla, Drupal, Ghost,
 *   TYPO3, etc.).
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 36,
    'endLine' => 48,
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
      'get' => 
      array (
        'name' => 'get',
        'parameters' => 
        array (
          'url' => 
          array (
            'name' => 'url',
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
            'startLine' => 47,
            'endLine' => 47,
            'startColumn' => 25,
            'endColumn' => 35,
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
            'name' => 'App\\Modules\\Http\\HttpResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Send an HTTP GET request.
 *
 * @param string $url The absolute URL to request.
 *
 * @return HttpResponse The immutable HTTP response.
 *
 * @throws HttpException On invalid URL or transport-level failure.
 */',
        'startLine' => 47,
        'endLine' => 47,
        'startColumn' => 5,
        'endColumn' => 51,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Http',
        'declaringClassName' => 'App\\Modules\\Http\\HttpClientInterface',
        'implementingClassName' => 'App\\Modules\\Http\\HttpClientInterface',
        'currentClassName' => 'App\\Modules\\Http\\HttpClientInterface',
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