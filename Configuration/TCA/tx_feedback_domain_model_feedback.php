<?php

use In2code\Feedback\Domain\Model\Comment;
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
                answers,
                fe_user,
                be_user
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
        'answers' => [
            'label' => $languageFilePrefix . Feedback::TABLE_NAME . '.answers',
            'config' => [
                'type' => 'inline',
                'foreign_table' => Comment::TABLE_NAME,
                'foreign_field' => 'feedback',
                'minitems' => 0,
                'maxitems' => 9999,
            ],
        ],
        'data' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'fe_user' => [
            'label' => $languageFilePrefix . Feedback::TABLE_NAME . '.fe_user',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'items' => [
                    [$languageFilePrefix . Feedback::TABLE_NAME . '.fe_user.I.0', 0]
                ],
                'default' => 0,
            ],
        ],
        'be_user' => [
            'label' => $languageFilePrefix . Feedback::TABLE_NAME . '.be_user',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'be_users',
                'items' => [
                    [$languageFilePrefix . Feedback::TABLE_NAME . '.be_user.I.0', 0]
                ],
                'default' => 0,
            ],
        ],
    ],
];
