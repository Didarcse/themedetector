<?php declare(strict_types = 1);

// odsl-C:\xampp\htdocs\themedetector\app\Modules\Detection\Joomla\Rules\RuleInterface.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Modules\Detection\Joomla\Rules\RuleInterface
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2-5bf63ade12aadb0e392ec93e9d6048b5d4a1019df44beed27bba3d5f2f0691cc',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Modules\\Detection\\Joomla\\Rules\\RuleInterface',
        'filename' => 'C:/xampp/htdocs/themedetector/app/Modules/Detection/Joomla/Rules/RuleInterface.php',
      ),
    ),
    'namespace' => 'App\\Modules\\Detection\\Joomla\\Rules',
    'name' => 'App\\Modules\\Detection\\Joomla\\Rules\\RuleInterface',
    'shortName' => 'RuleInterface',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Contract for every Joomla detection rule.
 *
 * A rule is a single, focused detection signal used to determine whether
 * a given website is built with Joomla. Each implementation inspects the
 * supplied HTML source and URL independently of other rules, keeping
 * detection modular, extensible, testable, deterministic, and easy to
 * maintain.
 *
 * Responsibilities:
 *
 * - Evaluate exactly one Joomla detection signal and report its outcome
 *   as a structured result array.
 * - Contribute its weight to the overall confidence score and attach any
 *   rule-specific evidence to the result metadata.
 * - Remain fully self-contained so rules can be added, removed, or
 *   reordered without impacting the rest of the detection pipeline.
 *
 * Design philosophy:
 *
 * - A rule must be stateless and deterministic: given the same input, it
 *   must always return the same output.
 * - A rule must perform no side effects. It must never emit output, mutate
 *   global state, persist data, or interact with external services.
 * - Each rule evaluates one detection signal independently; results are
 *   consumed by the JoomlaDetector and its ConfidenceCalculator.
 * - The interface itself remains completely free of Joomla-specific
 *   implementation details. Concrete rules are free to inspect HTML, parse
 *   the DOM, interrogate asset URLs, analyse JavaScript or API endpoints,
 *   or rely on any other detection strategy without violating the contract.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 38,
    'endLine' => 60,
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
            'startLine' => 59,
            'endLine' => 59,
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
            'startLine' => 59,
            'endLine' => 59,
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
 * Evaluate the supplied HTML and URL for a single Joomla detection
 * signal.
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
        'startLine' => 59,
        'endLine' => 59,
        'startColumn' => 5,
        'endColumn' => 63,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Modules\\Detection\\Joomla\\Rules',
        'declaringClassName' => 'App\\Modules\\Detection\\Joomla\\Rules\\RuleInterface',
        'implementingClassName' => 'App\\Modules\\Detection\\Joomla\\Rules\\RuleInterface',
        'currentClassName' => 'App\\Modules\\Detection\\Joomla\\Rules\\RuleInterface',
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