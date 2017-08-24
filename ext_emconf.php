<?php
/***************************************************************
 * Extension Manager/Repository config file for ext "feedback".
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'feedback',
    'description' => 'Provides a feedback formular on all pages',
    'category' => 'plugin',
    'shy' => 0,
    'version' => '0.1.0',
    'state' => 'stable',
    'author' => 'Dominique Kreemers',
    'author_email' => 'info@in2code.de',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-8.7.99',
            'php' => '7.0.0-7.0.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ]
];