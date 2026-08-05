<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\ThemeExtraction\ThemeExtractionResult.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\ThemeExtraction\ThemeExtractionResult
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-be55d880e41d217a6740d000c5683e1ada3db6a7a4c3cb524769fce272d092e1',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/ThemeExtraction/ThemeExtractionResult.php',
      ),
    ),
    'namespace' => 'App\\Modules\\ThemeExtraction',
    'name' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
    'shortName' => 'ThemeExtractionResult',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 65568,
    'docComment' => '/**
 * Immutable value object representing the result of a theme extraction.
 *
 * ThemeExtractionResult is the canonical result returned by every
 * ThemeExtractor implementation. It contains the outcome of a theme
 * extraction attempt — whether a theme was extracted, the confidence of
 * that outcome, and the normalized ThemeMetadata describing the extracted
 * theme when extraction succeeded.
 *
 * Responsibilities:
 *
 * - Represent the outcome of a theme extraction attempt.
 * - Carry the normalized theme metadata and confidence score.
 *
 * Design philosophy:
 *
 * - Immutable Value Object: once constructed, its state cannot be altered.
 * - Single Responsibility Principle: it stores result data only and
 *   performs no extraction logic.
 * - Stateless, deterministic, and side-effect free.
 * - It contains no parsing logic and knows nothing about WordPress,
 *   Shopify, Ghost, Joomla, Drupal, TYPO3, or any other platform.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 30,
    'endLine' => 88,
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
      'extracted' => 
      array (
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'name' => 'extracted',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 41,
        'endLine' => 41,
        'startColumn' => 9,
        'endColumn' => 31,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'theme' => 
      array (
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'name' => 'theme',
        'modifiers' => 4,
        'type' => 
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
                  'name' => 'App\\Modules\\ThemeExtraction\\ThemeMetadata',
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
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 42,
        'endLine' => 42,
        'startColumn' => 9,
        'endColumn' => 37,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'confidence' => 
      array (
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'name' => 'confidence',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 43,
        'endLine' => 43,
        'startColumn' => 9,
        'endColumn' => 31,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'metadata' => 
      array (
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'name' => 'metadata',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 44,
            'endLine' => 44,
            'startTokenPos' => 66,
            'startFilePos' => 1728,
            'endTokenPos' => 67,
            'endFilePos' => 1729,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 44,
        'endLine' => 44,
        'startColumn' => 9,
        'endColumn' => 36,
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
          'extracted' => 
          array (
            'name' => 'extracted',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 41,
            'endLine' => 41,
            'startColumn' => 9,
            'endColumn' => 31,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'theme' => 
          array (
            'name' => 'theme',
            'default' => NULL,
            'type' => 
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
                      'name' => 'App\\Modules\\ThemeExtraction\\ThemeMetadata',
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
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 42,
            'endLine' => 42,
            'startColumn' => 9,
            'endColumn' => 37,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'confidence' => 
          array (
            'name' => 'confidence',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 43,
            'endLine' => 43,
            'startColumn' => 9,
            'endColumn' => 31,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
          'metadata' => 
          array (
            'name' => 'metadata',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 44,
                'endLine' => 44,
                'startTokenPos' => 66,
                'startFilePos' => 1728,
                'endTokenPos' => 67,
                'endFilePos' => 1729,
              ),
            ),
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
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 44,
            'endLine' => 44,
            'startColumn' => 9,
            'endColumn' => 36,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param bool                 $extracted Whether a theme was extracted.
 * @param ?ThemeMetadata       $theme     The normalized theme metadata,
 *                                        null when no theme was extracted.
 * @param int                  $confidence The confidence score (0–100).
 * @param array<string, mixed> $metadata   Additional information (evidence,
 *                                         sources, extraction details).
 */',
        'startLine' => 40,
        'endLine' => 46,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'aliasName' => NULL,
      ),
      'isExtracted' => 
      array (
        'name' => 'isExtracted',
        'parameters' => 
        array (
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
 * Return whether a theme was extracted.
 *
 * @return bool True when the extraction identified a theme.
 */',
        'startLine' => 53,
        'endLine' => 56,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'aliasName' => NULL,
      ),
      'theme' => 
      array (
        'name' => 'theme',
        'parameters' => 
        array (
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
                  'name' => 'App\\Modules\\ThemeExtraction\\ThemeMetadata',
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
        'docComment' => '/**
 * Return the normalized theme metadata.
 *
 * @return ThemeMetadata|null The extracted theme metadata, or null when
 *                            no theme was extracted.
 */',
        'startLine' => 64,
        'endLine' => 67,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'aliasName' => NULL,
      ),
      'confidence' => 
      array (
        'name' => 'confidence',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return the confidence score of the extraction.
 *
 * @return int The confidence score (0–100).
 */',
        'startLine' => 74,
        'endLine' => 77,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'aliasName' => NULL,
      ),
      'metadata' => 
      array (
        'name' => 'metadata',
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
 * Return additional extraction information.
 *
 * @return array<string, mixed> The additional metadata.
 */',
        'startLine' => 84,
        'endLine' => 87,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\ThemeExtraction',
        'declaringClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'implementingClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
        'currentClassName' => 'App\\Modules\\ThemeExtraction\\ThemeExtractionResult',
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