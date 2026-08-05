<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\DetectionContextFactory.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\DetectionContextFactory
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-e2d43f7faa56c70fe1e8351ddba5360f98b8ac0174a0046168ff4acbe8e4cf3f',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\DetectionContextFactory',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/DetectionContextFactory.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection',
    'name' => 'App\\Modules\\Detection\\DetectionContextFactory',
    'shortName' => 'DetectionContextFactory',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65536,
    'docComment' => '/**
 * Creates immutable DetectionContext instances from HttpResponse objects.
 *
 * DetectionContextFactory centralizes all DetectionContext creation and
 * acts as the single translation layer between the HTTP module and the
 * Detection Engine. It performs object creation only.
 *
 * Responsibilities:
 *
 * - Create DetectionContext objects from HttpResponse instances.
 * - Preserve the original URL, final URL, HTML body, and status code
 *   across the translation.
 *
 * Design philosophy:
 *
 * - Factory: object creation is centralized and reusable.
 * - Value Object creation: the produced context is immutable.
 * - Single Responsibility Principle: a pure translation layer. It performs
 *   no HTTP requests, no CMS detection, no confidence calculation, and no
 *   HTML parsing.
 * - Dependency Injection friendly: stateless, side-effect free, and
 *   deterministic. Given the same response it always produces the same
 *   context.
 * - It knows nothing about WordPress, Joomla, Drupal, Ghost, TYPO3, theme
 *   extraction, or plugin detection.
 *
 * Future architecture:
 *
 * - Future versions may populate DetectionContext with headers, cookies,
 *   content type, redirect chain, response time, encoding, language, and
 *   TLS information.
 * - The factory must remain the only class that translates HttpResponse
 *   into DetectionContext; WebsiteDetector must never construct
 *   DetectionContext directly.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 44,
    'endLine' => 65,
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
      'create' => 
      array (
        'name' => 'create',
        'parameters' => 
        array (
          'response' => 
          array (
            'name' => 'response',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Http\\HttpResponse',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 56,
            'endLine' => 56,
            'startColumn' => 28,
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
            'name' => 'App\\Modules\\Detection\\DetectionContext',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Convert an HttpResponse into an immutable DetectionContext.
 *
 * Values are copied verbatim: no validation, modification, or
 * transformation is applied.
 *
 * @param HttpResponse $response The immutable HTTP response.
 *
 * @return DetectionContext The immutable detection context.
 */',
        'startLine' => 56,
        'endLine' => 64,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection',
        'declaringClassName' => 'App\\Modules\\Detection\\DetectionContextFactory',
        'implementingClassName' => 'App\\Modules\\Detection\\DetectionContextFactory',
        'currentClassName' => 'App\\Modules\\Detection\\DetectionContextFactory',
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