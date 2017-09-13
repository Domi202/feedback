<?php

use In2code\Feedback\Domain\Model\Answer;
use In2code\Feedback\Domain\Model\Feedback;

$languageFilePrefix = 'LLL:EXT:feedback/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => [
        'title' => $languageFilePrefix . Answer::TABLE_NAME,
        'label' => 'comment',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'hideTable' => true,
        'iconfile' => 'EXT:feedback/Resources/Public/Icons/Answer.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                feedback,
                comment,
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
        'feedback' => [
            'label' => $languageFilePrefix . Feedback::TABLE_NAME,
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => Feedback::TABLE_NAME,
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'comment' => [
            'label' => $languageFilePrefix . Answer::TABLE_NAME . '.comment',
            'config' => [
                'type' => 'text',
                'eval' => 'trim',
            ],
        ],
        'fe_user' => [
            'label' => $languageFilePrefix . Answer::TABLE_NAME . '.fe_user',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'items' => [
                    [$languageFilePrefix . Answer::TABLE_NAME . '.fe_user.I.0', 0]
                ],
                'default' => 0,
            ],
        ],
        'be_user' => [
            'label' => $languageFilePrefix . Answer::TABLE_NAME . '.be_user',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'be_users',
                'items' => [
                    [$languageFilePrefix . Answer::TABLE_NAME . '.be_user.I.0', 0]
                ],
                'default' => 0,
            ],
        ],
    ],
];
