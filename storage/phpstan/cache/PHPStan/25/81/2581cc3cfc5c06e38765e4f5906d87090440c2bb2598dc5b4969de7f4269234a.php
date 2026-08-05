<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\WebsiteDetector.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\WebsiteDetector
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-840c3255c4c047fa246c1dcb6b1936ed45ec5abb37f25ecd4c69ec9891bf3442',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\WebsiteDetector',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/WebsiteDetector.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection',
    'name' => 'App\\Modules\\Detection\\WebsiteDetector',
    'shortName' => 'WebsiteDetector',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Public entry point for the ThemeDetectorTool Detection Engine.
 *
 * WebsiteDetector coordinates the complete website detection workflow: it
 * retrieves the target website using the HTTP client, delegates
 * DetectionContext creation to the DetectionContextFactory, hands the
 * context to the DetectionManager, and returns the DetectionResult.
 *
 * WebsiteDetector is the only class external consumers should interact
 * with for CMS detection.
 *
 * Responsibilities:
 *
 * - Retrieve the target website via the HTTP client.
 * - Delegate DetectionContext creation to the DetectionContextFactory.
 * - Delegate detection to the DetectionManager.
 * - Return the DetectionResult.
 *
 * Design philosophy:
 *
 * - Facade: it is the single public entry point for the Detection Engine.
 * - Orchestrator: it wires the workflow steps together and nothing more.
 * - Dependency Injection: collaborators are provided through the
 *   constructor.
 * - Single Responsibility Principle: coordination only; it contains no
 *   CMS detection logic, confidence calculation, or HTML parsing.
 * - Open/Closed Principle: new detection strategies are added without
 *   modifying this class.
 * - Stateless, deterministic, and side-effect free except for the
 *   delegated HTTP request.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 40,
    'endLine' => 79,
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
      'httpClient' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\WebsiteDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\WebsiteDetector',
        'name' => 'httpClient',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Http\\HttpClientInterface',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 53,
        'endLine' => 53,
        'startColumn' => 9,
        'endColumn' => 47,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'manager' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\WebsiteDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\WebsiteDetector',
        'name' => 'manager',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Detection\\DetectionManager',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 54,
        'endLine' => 54,
        'startColumn' => 9,
        'endColumn' => 41,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'factory' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\WebsiteDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\WebsiteDetector',
        'name' => 'factory',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Detection\\DetectionContextFactory',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 55,
        'endLine' => 55,
        'startColumn' => 9,
        'endColumn' => 48,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'httpClient' => 
          array (
            'name' => 'httpClient',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Http\\HttpClientInterface',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 53,
            'endLine' => 53,
            'startColumn' => 9,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'manager' => 
          array (
            'name' => 'manager',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Detection\\DetectionManager',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 54,
            'endLine' => 54,
            'startColumn' => 9,
            'endColumn' => 41,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'factory' => 
          array (
            'name' => 'factory',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Modules\\Detection\\DetectionContextFactory',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 55,
            'endLine' => 55,
            'startColumn' => 9,
            'endColumn' => 48,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a new WebsiteDetector.
 *
 * @param HttpClientInterface       $httpClient The HTTP client used to
 *                                              retrieve target websites.
 * @param DetectionManager          $manager    The DetectionManager that
 *                                              performs CMS detection.
 * @param DetectionContextFactory   $factory    The factory that creates
 *                                              DetectionContext objects.
 */',
        'startLine' => 52,
        'endLine' => 57,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection',
        'declaringClassName' => 'App\\Modules\\Detection\\WebsiteDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\WebsiteDetector',
        'currentClassName' => 'App\\Modules\\Detection\\WebsiteDetector',
        'aliasName' => NULL,
      ),
      'detect' => 
      array (
        'name' => 'detect',
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
            'startLine' => 71,
            'endLine' => 71,
            'startColumn' => 28,
            'endColumn' => 38,
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
 * Detect the CMS of the website at the given URL.
 *
 * Retrieves the website via the HTTP client, creates the
 * DetectionContext through the DetectionContextFactory, delegates
 * detection to the DetectionManager, and returns the resulting
 * DetectionResult.
 *
 * @param string $url The absolute URL of the website to detect.
 *
 * @return DetectionResult The detection result.
 */',
        'startLine' => 71,
        'endLine' => 78,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection',
        'declaringClassName' => 'App\\Modules\\Detection\\WebsiteDetector',
        'implementingClassName' => 'App\\Modules\\Detection\\WebsiteDetector',
        'currentClassName' => 'App\\Modules\\Detection\\WebsiteDetector',
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