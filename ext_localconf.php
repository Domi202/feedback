<?php
defined('TYPO3_MODE') or die('Access denied.');

TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'In2code.Feedback',
    'Main',
    [
        'Feedback' => 'index,save',
    ],
    [
        'Feedback' => 'index,save',
    ]
);
