<?php

$header = <<<EOF
This file is part of the ArmenianLocaleBundle.
Symfony Framework Bundle

@author Tigran Azatyan <tigran@azatyan.info>

@copyright Tigran Azatyan  2013 - 2016
EOF;

Symfony\CS\Fixer\Contrib\HeaderCommentFixer::setHeader($header);

return Symfony\CS\Config\Config::create()
    ->fixers([
        'header_comment',
        'short_array_syntax',
        'ordered_use',
        'php_unit_construct',
        'php_unit_strict'
    ])
    ->finder(
        Symfony\CS\Finder\DefaultFinder::create()
            ->in(__DIR__)
    )
;