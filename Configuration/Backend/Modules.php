<?php

/**
 * Definitions for modules provided by EXT:examples
 */
return [
    'admin_monitoring' => [
        'parent' => 'system',
        'position' => ['top'],
        'access' => 'admin',
        'workspaces' => 'live',
        'path' => '/module/system/monitoring',
        'labels' => 'LLL:EXT:t3_monitoring/Resources/Private/Language/locallang_be.xlf',
        'extensionName' => 't3_monitoring',
        'controllerActions' => [
            \FloPe\T3Monitoring\Controller\ErrorController::class => [
                'index',
            ],
        ],
    ],
];