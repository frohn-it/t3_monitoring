<?php
defined('TYPO3') or die('Access denied.');

call_user_func(function(string $extKey)
{
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'T3Monitoring',
        'system',
        'Log',
        'top',
        [
            \FloPe\T3Monitoring\Controller\ErrorController::class => 'index'
        ],
        [
            'access' => 'admin',
//            'iconIdentifier' => '',
            'labels' => 'LLL:EXT:t3_monitoring/Resources/Private/Language/locallang_be.xlf',
        ]
    );

}, 't3_monitoring');