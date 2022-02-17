<?php

return [
    'target_php_version' => '7.4',
    'directory_list' => [
        'src/',
        'vendor/phan/phan/src/Phan',
        'vendor/symfony/filesystem'
    ],
    'exclude_analysis_directory_list' => [
        'vendor/',
    ],
];
