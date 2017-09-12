<?php
defined('TYPO3_MODE') or die('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
    \In2code\Feedback\Domain\Model\Feedback::TABLE_NAME
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
    \In2code\Feedback\Domain\Model\Comment::TABLE_NAME
);

if (TYPO3_MODE === 'BE') {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'In2code.feedback',
        'web',
        'feedback',
        '',
        [
            'Backend' => 'index',
        ],
        [
            'access' => 'user,group',
            'icon' => 'EXT:feedback/Resources/Public/Icons/icon.svg',
            'labels' => 'LLL:EXT:feedback/Resources/Private/Language/locallang_mod.xlf',
        ]
    );
}
