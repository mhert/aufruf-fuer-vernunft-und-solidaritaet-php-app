<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->exclude([
        '.run/',
        'build/',
        'var/',
        'vendor/',
    ])
    ->ignoreDotFiles(false)
    ->in(__DIR__);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setCacheFile(__DIR__.'/build/php-cs-fixer/php-cs-fixer.cache')
    ->setFinder($finder)
    ->setRules([
        '@PSR12' => true,
        '@PSR12:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
    ]);
