<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\ThemeExtraction\WordPress\WordPressStyleCssDownloader.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\ThemeExtraction\WordPress\WordPressStyleCssDownloader
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-f1f719ec6cac38f4f9a50b2c78a348b53e57123c73c0a7f155de4f8b369c2ad1',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloader',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/ThemeExtraction/WordPress/WordPressStyleCssDownloader.php',
      ),
    ),
    'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
    'name' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloader',
    'shortName' => 'WordPressStyleCssDownloader',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Downloads the raw contents of a WordPress theme stylesheet.
 *
 * WordPressStyleCssDownloader is an HTTP adapter responsible only for
 * retrieving the raw style.css contents from a given stylesheet URL. It
 * performs exactly one HTTP GET request through the injected
 * HttpClientInterface and returns the response body on success.
 *
 * Responsibilities:
 *
 * - Perform a single HTTP GET request against the given stylesheet URL.
 * - Return the response body when the request succeeds with HTTP 200.
 * - Return null when the request fails or the response is not HTTP 200.
 *
 * Design philosophy:
 *
 * - HTTP Adapter: it is the thin network boundary of the WordPress theme
 *   extraction pipeline; all outbound traffic flows through it.
 * - Dependency Injection: the transport is injected as
 *   HttpClientInterface, so the downloader never depends on a concrete
 *   HTTP implementation and remains fully testable.
 * - Single Responsibility Principle: downloading the stylesheet is the
 *   only concern. It performs no HTML parsing, no CSS parsing, no theme
 *   locating, no metadata extraction, no confidence calculation, and no
 *   WordPress business logic.
 * - Stateless, deterministic, and side-effect free except for the
 *   delegated HTTP request: given the same stylesheet URL and HTTP layer,
 *   it always produces the same outcome.
 * - Transport failures never escape: an HttpException raised by the HTTP
 *   layer is converted into a null result, so consumers only ever observe
 *   a string or null.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 42,
    'endLine' => 84,
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
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloader',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloader',
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
        'startLine' => 52,
        'endLine' => 52,
        'startColumn' => 9,
        'endColumn' => 47,
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
            'startLine' => 52,
            'endLine' => 52,
            'startColumn' => 9,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a new WordPressStyleCssDownloader.
 *
 * @param HttpClientInterface $httpClient The HTTP client used to
 *                                        perform the stylesheet
 *                                        download.
 */',
        'startLine' => 51,
        'endLine' => 54,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloader',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloader',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloader',
        'aliasName' => NULL,
      ),
      'download' => 
      array (
        'name' => 'download',
        'parameters' => 
        array (
          'styleCssUrl' => 
          array (
            'name' => 'styleCssUrl',
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
            'startLine' => 70,
            'endLine' => 70,
            'startColumn' => 30,
            'endColumn' => 48,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
          'data' => 
          array (
            'types' => 
            array (
              0 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'string',
                  'isIdentifier' => true,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'null',
                  'isIdentifier' => true,
                ),
              ),
            ),
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Download the contents of the given stylesheet URL.
 *
 * Performs exactly one HTTP GET request. When the response status is
 * HTTP 200, the response body is returned; otherwise null is returned.
 * Transport-level failures raised by the HTTP layer are caught and
 * converted into a null result and are never rethrown. The stylesheet
 * is never parsed or inspected.
 *
 * @param string $styleCssUrl The stylesheet URL to download.
 *
 * @return string|null The raw style.css contents, or null when the
 *                     request fails or the response is not HTTP 200.
 */',
        'startLine' => 70,
        'endLine' => 83,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction\\WordPress',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloader',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloader',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\WordPress\\WordPressStyleCssDownloader',
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