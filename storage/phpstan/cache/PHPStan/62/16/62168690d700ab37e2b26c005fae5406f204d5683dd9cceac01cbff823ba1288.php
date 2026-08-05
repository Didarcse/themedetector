<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Integration\Detection\WebsiteDetectorIntegrationTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Integration\Detection\WebsiteDetectorIntegrationTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-471b58e93968cc26c38022e1e3b5df4a96ab15ebe96a2cf884dfecc0e787209f',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Integration/Detection/WebsiteDetectorIntegrationTest.php',
      ),
    ),
    'namespace' => 'Tests\\Integration\\Detection',
    'name' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
    'shortName' => 'WebsiteDetectorIntegrationTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * End-to-end integration tests for the public WebsiteDetector API.
 *
 * Verifies the complete Detection Engine workflow using real services:
 * WebsiteDetector, the HTTP client fake, DetectionContextFactory,
 * DetectionManager, DetectorRegistry, and the real WordPressDetector with
 * its real rules. Only the HTTP client is replaced.
 *
 * Design philosophy:
 *
 * - Behaviour-driven: tests validate observable behaviour only.
 * - Integration: verifies the full collaboration chain from HTTP response
 *   through context creation to detection result.
 * - Fast, deterministic, and independent: no mocks, no stubs, no
 *   reflection, and no network I/O.
 * - Each test verifies exactly one behaviour.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 57,
    'endLine' => 125,
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
      'URL' => 
      array (
        'declaringClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'name' => 'URL',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'https://example.com\'',
          'attributes' => 
          array (
            'startLine' => 59,
            'endLine' => 59,
            'startTokenPos' => 172,
            'startFilePos' => 2026,
            'endTokenPos' => 172,
            'endFilePos' => 2046,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 59,
        'endLine' => 59,
        'startColumn' => 5,
        'endColumn' => 46,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'test_detect_returns_detection_result' => 
      array (
        'name' => 'test_detect_returns_detection_result',
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
        'startLine' => 61,
        'endLine' => 66,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Detection',
        'declaringClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'aliasName' => NULL,
      ),
      'test_detect_identifies_wordpress' => 
      array (
        'name' => 'test_detect_identifies_wordpress',
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
        'startLine' => 68,
        'endLine' => 73,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Detection',
        'declaringClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'aliasName' => NULL,
      ),
      'test_detect_reports_positive_confidence' => 
      array (
        'name' => 'test_detect_reports_positive_confidence',
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
        'startLine' => 75,
        'endLine' => 80,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Detection',
        'declaringClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'aliasName' => NULL,
      ),
      'test_detect_reports_detected' => 
      array (
        'name' => 'test_detect_reports_detected',
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
        'startLine' => 82,
        'endLine' => 87,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Integration\\Detection',
        'declaringClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'aliasName' => NULL,
      ),
      'detectWordPress' => 
      array (
        'name' => 'detectWordPress',
        'parameters' => 
        array (
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
 * Boot the application, replace the HTTP client with the fake, and
 * run the complete Detection Engine workflow.
 */',
        'startLine' => 93,
        'endLine' => 98,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Integration\\Detection',
        'declaringClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'aliasName' => NULL,
      ),
      'createBootedApplication' => 
      array (
        'name' => 'createBootedApplication',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Core\\Application',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 100,
        'endLine' => 112,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Integration\\Detection',
        'declaringClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'aliasName' => NULL,
      ),
      'createWordPressDetector' => 
      array (
        'name' => 'createWordPressDetector',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Detection\\WordPress\\WordPressDetector',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 114,
        'endLine' => 124,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Integration\\Detection',
        'declaringClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'implementingClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
        'currentClassName' => 'Tests\\Integration\\Detection\\WebsiteDetectorIntegrationTest',
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