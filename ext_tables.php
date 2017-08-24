<?php
defined('TYPO3_MODE') or die('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(\In2code\Feedback\Domain\Model\Feedback::TABLE_NAME);

//if (TYPO3_MODE === 'BE') {
//    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
//        'Domi202.' . $_EXTKEY,
//        'system',
//        'mailcatcher',
//        '',
//        [
//            'Mbox' => 'index,view',
//        ],
//        [
//            'access' => 'user,group',
//            'icon' => 'EXT:mailcatcher/Resources/Public/Icons/icon.svg',
//            'labels' => 'LLL:EXT:mailcatcher/Resources/Private/Language/locallang_mod.xml',
//        ]
//    );
//}
