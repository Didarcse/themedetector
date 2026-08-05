<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Shopify\Rules\CartEndpointRule.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Shopify\Rules\CartEndpointRule
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-9869b22cd99b822d462ec386fc0ac76d4f7d372ddea704647d5ef8f2e267c3d5',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Shopify/Rules/CartEndpointRule.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Shopify\\Rules',
    'name' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
    'shortName' => 'CartEndpointRule',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Detects Shopify by verifying the official /cart.js endpoint.
 *
 * Builds the cart.js URL from the supplied website URL, performs a GET
 * request, validates the JSON response contains expected Shopify cart
 * fields with a weighted scoring model, and returns a matched result
 * when the minimum score threshold is met.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 20,
    'endLine' => 188,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Modules\\Detection\\Shopify\\Rules\\RuleInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'CONFIDENCE' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'name' => 'CONFIDENCE',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '40',
          'attributes' => 
          array (
            'startLine' => 22,
            'endLine' => 22,
            'startTokenPos' => 57,
            'startFilePos' => 624,
            'endTokenPos' => 57,
            'endFilePos' => 625,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 22,
        'endLine' => 22,
        'startColumn' => 5,
        'endColumn' => 34,
      ),
      'ENDPOINT' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'name' => 'ENDPOINT',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'/cart.js\'',
          'attributes' => 
          array (
            'startLine' => 24,
            'endLine' => 24,
            'startTokenPos' => 68,
            'startFilePos' => 658,
            'endTokenPos' => 68,
            'endFilePos' => 667,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 24,
        'endLine' => 24,
        'startColumn' => 5,
        'endColumn' => 40,
      ),
      'FIELD_WEIGHTS' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'name' => 'FIELD_WEIGHTS',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'token\' => 3, \'items\' => 3, \'item_count\' => 2, \'total_price\' => 2, \'currency\' => 1]',
          'attributes' => 
          array (
            'startLine' => 26,
            'endLine' => 32,
            'startTokenPos' => 79,
            'startFilePos' => 705,
            'endTokenPos' => 116,
            'endFilePos' => 835,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 26,
        'endLine' => 32,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
      'MIN_SCORE' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'name' => 'MIN_SCORE',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '5',
          'attributes' => 
          array (
            'startLine' => 34,
            'endLine' => 34,
            'startTokenPos' => 127,
            'startFilePos' => 869,
            'endTokenPos' => 127,
            'endFilePos' => 869,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 34,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 32,
      ),
    ),
    'immediateProperties' => 
    array (
      'httpClient' => 
      array (
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'name' => 'httpClient',
        'modifiers' => 132,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Http\\HttpClient',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 37,
        'endLine' => 37,
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
                'name' => 'App\\Modules\\Http\\HttpClient',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 37,
            'endLine' => 37,
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
        'docComment' => NULL,
        'startLine' => 36,
        'endLine' => 39,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Shopify\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'currentClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'aliasName' => NULL,
      ),
      'evaluate' => 
      array (
        'name' => 'evaluate',
        'parameters' => 
        array (
          'html' => 
          array (
            'name' => 'html',
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
            'startLine' => 53,
            'endLine' => 53,
            'startColumn' => 30,
            'endColumn' => 41,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
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
            'startLine' => 53,
            'endLine' => 53,
            'startColumn' => 44,
            'endColumn' => 54,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Evaluate the target by querying the Shopify cart endpoint.
 *
 * @param string $html The complete HTML source of the target website.
 * @param string $url  The original website URL.
 *
 * @return array{
 *     matched: bool,
 *     confidence: int,
 *     metadata: array<string, mixed>
 * }
 */',
        'startLine' => 53,
        'endLine' => 89,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Shopify\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'currentClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'aliasName' => NULL,
      ),
      'buildCartUrl' => 
      array (
        'name' => 'buildCartUrl',
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
            'startLine' => 96,
            'endLine' => 96,
            'startColumn' => 35,
            'endColumn' => 45,
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
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Build the /cart.js URL using only the scheme, host, and optional
 * port from the supplied URL.  Any existing path, query, or fragment
 * is ignored.
 */',
        'startLine' => 96,
        'endLine' => 105,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Shopify\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'currentClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'aliasName' => NULL,
      ),
      'fetchCart' => 
      array (
        'name' => 'fetchCart',
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
            'startLine' => 107,
            'endLine' => 107,
            'startColumn' => 32,
            'endColumn' => 42,
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
                  'name' => 'App\\Modules\\Http\\HttpResponse',
                  'isIdentifier' => false,
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
        'docComment' => NULL,
        'startLine' => 107,
        'endLine' => 130,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Shopify\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'currentClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'aliasName' => NULL,
      ),
      'findHeader' => 
      array (
        'name' => 'findHeader',
        'parameters' => 
        array (
          'headers' => 
          array (
            'name' => 'headers',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 137,
            'endLine' => 137,
            'startColumn' => 33,
            'endColumn' => 46,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'name' => 
          array (
            'name' => 'name',
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
            'startLine' => 137,
            'endLine' => 137,
            'startColumn' => 49,
            'endColumn' => 60,
            'parameterIndex' => 1,
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
 * Return the first value for a header name, case-insensitively.
 *
 * @param array<string, list<string>> $headers
 */',
        'startLine' => 137,
        'endLine' => 154,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Shopify\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'currentClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'aliasName' => NULL,
      ),
      'isValidCartResponse' => 
      array (
        'name' => 'isValidCartResponse',
        'parameters' => 
        array (
          'payload' => 
          array (
            'name' => 'payload',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 164,
            'endLine' => 164,
            'startColumn' => 42,
            'endColumn' => 55,
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
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Validate the decoded payload using a weighted scoring model.
 *
 * A total score of at least 5 (out of 11) is required for a valid
 * Shopify cart response.
 *
 * @param array<mixed> $payload
 */',
        'startLine' => 164,
        'endLine' => 175,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Shopify\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'currentClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'aliasName' => NULL,
      ),
      'noMatch' => 
      array (
        'name' => 'noMatch',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return array{matched: false, confidence: 0, metadata: array<string, mixed>}
 */',
        'startLine' => 180,
        'endLine' => 187,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Modules\\Detection\\Shopify\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'implementingClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
        'currentClassName' => 'App\\Modules\\Detection\\Shopify\\Rules\\CartEndpointRule',
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