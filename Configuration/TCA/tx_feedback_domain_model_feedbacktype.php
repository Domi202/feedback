<?php

use In2code\Feedback\Domain\Model\FeedbackType;

$languageFilePrefix = 'LLL:EXT:feedback/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => [
        'title' => $languageFilePrefix . FeedbackType::TABLE_NAME,
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'sortby' => 'sorting',
        'adminOnly' => true,
        'rootLevel' => 1,
        'iconfile' => 'EXT:feedback/Resources/Public/Icons/Type.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => 'title',
        ],
    ],
    'columns' => [
        'title' => [
            'label' => $languageFilePrefix . FeedbackType::TABLE_NAME . '.title',
            'config' => [
                'type' => 'input',
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
    ],
];
