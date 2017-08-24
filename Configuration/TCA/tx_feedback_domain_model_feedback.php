<?php
use In2code\Feedback\Domain\Model\Feedback;

$languageFilePrefix = 'LLL:EXT:feedback/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => [
        'title' => $languageFilePrefix . Feedback::TABLE_NAME,
        'label' => 'comment',
        // 'type' => 'type',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                type,
                url,
                comment,
                user
            ',
        ],
    ],
    'columns' => [
        'crdate' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'tstamp' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'type' => [
            'label' => $languageFilePrefix . Feedback::TABLE_NAME . '.type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [],
            ],
        ],
        'url' => [
            'label' => $languageFilePrefix . Feedback::TABLE_NAME . '.url',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'comment' => [
            'label' => $languageFilePrefix . Feedback::TABLE_NAME . '.comment',
            'config' => [
                'type' => 'text',
                'eval' => 'trim',
            ],
        ],
        'user' => [
            'label' => $languageFilePrefix . Feedback::TABLE_NAME . '.user',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'items' => [
                    [$languageFilePrefix . Feedback::TABLE_NAME . '.I.0', 0]
                ],
            ],
        ]
    ],
];
