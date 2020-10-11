<?php
$header = 'Copyright (c) Constantin Adrian Jeledintan';

$finder = PhpCsFixer\Finder::create()
    ->exclude([__DIR__ . '/vendor/'])
    ->in([__DIR__ . '/src/']);

$config = PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules(
        [
            '@PHP56Migration' => true,
            '@PHPUnit60Migration:risky' => true,
            '@PhpCsFixer' => true,
            '@PhpCsFixer:risky' => true,
            '@PSR2' => true,
            '@Symfony' => true,
            'header_comment' => ['header' => $header],
            'list_syntax' => ['syntax' => 'short'],
            'concat_space' => ['spacing' => 'one'],
            'cast_spaces' => ['space' => 'none'],
            'ordered_class_elements' => false,
            'array_syntax' => ['syntax' => 'short'],
            'strict_comparison' => false,
            'strict_param' => false,
            'array_indentation' => false,
            'method_chaining_indentation' => false,
            'php_unit_test_class_requires_covers' => false,
            'multiline_whitespace_before_semicolons' => false,
            'phpdoc_align' => ['align' => 'left'],
            'php_unit_strict' => false,
            'no_superfluous_phpdoc_tags' => true,
            'phpdoc_add_missing_param_annotation' => false,
            'single_line_throw' => false,
        ]
    )
    ->setUsingCache(false)
    ->setFinder($finder);

return $config;
