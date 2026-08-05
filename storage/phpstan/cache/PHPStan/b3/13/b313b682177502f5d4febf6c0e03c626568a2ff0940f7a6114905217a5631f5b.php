<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Wix\Rules\RuleInterface.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Wix\Rules\RuleInterface
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-24da09bb27a4301345e323b9625ad94d163f01801d3fe9299ca9c190d78a1721',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Wix\\Rules\\RuleInterface',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Wix/Rules/RuleInterface.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Wix\\Rules',
    'name' => 'App\\Modules\\Detection\\Wix\\Rules\\RuleInterface',
    'shortName' => 'RuleInterface',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Contract for every Wix detection rule.
 *
 * A rule is a single, focused signal used to determine whether a given
 * website is built on Wix. Each implementation inspects the supplied HTML
 * source and URL independently of other rules, keeping detection modular,
 * testable, and composable.
 *
 * Implementations must be stateless and side-effect free: a rule should
 * never mutate global state, persist data, or emit output. The evaluated
 * evidence is returned as a structured result array consumed by the
 * Wix detector and its confidence calculator.
 *
 * The interface remains technology-agnostic: no Wix-specific knowledge is
 * encoded here. Concrete rules are free to parse markup, interrogate asset
 * URLs, or rely on any other strategy without violating the contract.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 24,
    'endLine' => 45,
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
            'startLine' => 44,
            'endLine' => 44,
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
            'startLine' => 44,
            'endLine' => 44,
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
 * Evaluate the supplied HTML and URL for a single Wix detection signal.
 *
 * Every invocation must return a fully-formed result array, regardless
 * of whether a signal was found. The `matched` flag indicates presence
 * of the signal, `weight` contributes to the overall confidence score,
 * and `metadata` carries optional, rule-specific evidence for further
 * analysis or reporting.
 *
 * @param string $html The complete HTML source of the target website.
 * @param string $url  The original website URL.
 *
 * @return array{
 *     matched: bool,
 *     weight: int,
 *     metadata: array<string, mixed>
 * } The structured result of the evaluation.
 */',
        'startLine' => 44,
        'endLine' => 44,
        'startColumn' => 5,
        'endColumn' => 63,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Wix\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\RuleInterface',
        'implementingClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\RuleInterface',
        'currentClassName' => 'App\\Modules\\Detection\\Wix\\Rules\\RuleInterface',
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