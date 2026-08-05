<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\DetectorInterface.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\DetectorInterface
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-6a57943708c55527b471e00b78e462e223a650554a5b3dbfe8da557c52e33fb1',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\DetectorInterface',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/DetectorInterface.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection',
    'name' => 'App\\Modules\\Detection\\DetectorInterface',
    'shortName' => 'DetectorInterface',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Contract for all technology detectors.
 *
 * Every detector (WordPress, Shopify, Webflow, Wix, Joomla, Drupal,
 * Squarespace, etc.) must implement this interface.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 13,
    'endLine' => 21,
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
      'detect' => 
      array (
        'name' => 'detect',
        'parameters' => 
        array (
          'context' => 
          array (
            'name' => 'context',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Detection\\DetectionContext',
                'isIdentifier' => false,
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
            'startColumn' => 28,
            'endColumn' => 52,
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
            'name' => 'App\\Modules\\Detection\\DetectionResult',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Detect whether a specific technology is present in the given context.
 *
 * @param DetectionContext $context The immutable HTTP response context.
 */',
        'startLine' => 20,
        'endLine' => 20,
        'startColumn' => 5,
        'endColumn' => 71,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection',
        'declaringClassName' => 'App\\Modules\\Detection\\DetectorInterface',
        'implementingClassName' => 'App\\Modules\\Detection\\DetectorInterface',
        'currentClassName' => 'App\\Modules\\Detection\\DetectorInterface',
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