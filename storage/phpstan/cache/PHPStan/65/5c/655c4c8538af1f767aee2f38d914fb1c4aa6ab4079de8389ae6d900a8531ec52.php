<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\tests\Unit\Detection\Joomla\HtmlSignatureRuleTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Unit\Detection\Joomla\HtmlSignatureRuleTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-6a94bf5fb987d15ecbd3b6f5de122fee6136ba77aa7589cd875beee0c40742eb',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'filename' => 'C:/xampp/htdocs/themedetector/tests/Unit/Detection/Joomla/HtmlSignatureRuleTest.php',
      ),
    ),
    'namespace' => 'Tests\\Unit\\Detection\\Joomla',
    'name' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
    'shortName' => 'HtmlSignatureRuleTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 10,
    'endLine' => 133,
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
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'name' => 'URL',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'https://example.com\'',
          'attributes' => 
          array (
            'startLine' => 12,
            'endLine' => 12,
            'startTokenPos' => 45,
            'startFilePos' => 241,
            'endTokenPos' => 45,
            'endFilePos' => 261,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 12,
        'endLine' => 12,
        'startColumn' => 5,
        'endColumn' => 46,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'createRule' => 
      array (
        'name' => 'createRule',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Modules\\Detection\\Joomla\\Rules\\HtmlSignatureRule',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 14,
        'endLine' => 17,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
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
            'startLine' => 22,
            'endLine' => 22,
            'startColumn' => 31,
            'endColumn' => 42,
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
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return array{matched: bool, weight: int, metadata: array<string, mixed>}
 */',
        'startLine' => 22,
        'endLine' => 25,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_option_com_signature' => 
      array (
        'name' => 'test_detects_option_com_signature',
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
        'startLine' => 27,
        'endLine' => 36,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_com_content_signature' => 
      array (
        'name' => 'test_detects_com_content_signature',
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
        'startLine' => 38,
        'endLine' => 47,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_com_users_signature' => 
      array (
        'name' => 'test_detects_com_users_signature',
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
        'startLine' => 49,
        'endLine' => 58,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_com_contact_signature' => 
      array (
        'name' => 'test_detects_com_contact_signature',
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
        'startLine' => 60,
        'endLine' => 69,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_joomla_toolbar_button_signature' => 
      array (
        'name' => 'test_detects_joomla_toolbar_button_signature',
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
        'startLine' => 71,
        'endLine' => 80,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'aliasName' => NULL,
      ),
      'test_detects_case_insensitively' => 
      array (
        'name' => 'test_detects_case_insensitively',
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
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_first_matching_signature' => 
      array (
        'name' => 'test_returns_first_matching_signature',
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
        'startLine' => 89,
        'endLine' => 100,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_no_match_when_no_signature_exists' => 
      array (
        'name' => 'test_returns_no_match_when_no_signature_exists',
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
        'startLine' => 102,
        'endLine' => 108,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'aliasName' => NULL,
      ),
      'test_handles_empty_html' => 
      array (
        'name' => 'test_handles_empty_html',
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
        'startLine' => 110,
        'endLine' => 115,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_expected_weight' => 
      array (
        'name' => 'test_returns_expected_weight',
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
        'startLine' => 117,
        'endLine' => 122,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'aliasName' => NULL,
      ),
      'test_returns_html_signature_metadata' => 
      array (
        'name' => 'test_returns_html_signature_metadata',
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
        'startLine' => 124,
        'endLine' => 132,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Unit\\Detection\\Joomla',
        'declaringClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'implementingClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
        'currentClassName' => 'Tests\\Unit\\Detection\\Joomla\\HtmlSignatureRuleTest',
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