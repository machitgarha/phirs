<?php

return [
    'target_php_version' => '7.4',
    'directory_list' => [
        'src/',
        'tests/unit',
        'vendor/phan/phan/src/Phan',
        'vendor/symfony/filesystem',
        'vendor/phpunit/phpunit',
    ],
    'exclude_analysis_directory_list' => [
        'vendor/',
    ],
    'color_issue_messages_if_supported' => true,
];
