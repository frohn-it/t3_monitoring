<?php

defined('TYPO3') or die('Access denied.');

call_user_func(function(string $extKey, string $table)
{
    $LLL = 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_db.xlf:' . $table . '.';

    $result = [
        'ctrl' => [
            'label' => 'message',
            'default_sortby' => 'sorting',
            'tstamp' => 'tstamp',
            'crdate' => 'crdate',
            'cruser_id' => 'cruser_id',
            'title' => $LLL . 'title',
            'delete' => 'deleted',
            'enablecolumns' => [
                'disabled' => 'hidden',
                'starttime' => 'starttime',
                'endtime' => 'endtime'
            ],
            'hide' => true
        ],
        'types' => [
            '0' => [
                'showitem' => 'hidden,type,browser,browser_version,level,os,os_version,url,user,stacktrace,message,ip_address',
            ],
        ],
        'palettes' => [],
        'columns' => [
            'hidden' => $GLOBALS['TCA']['tt_content']['columns']['hidden'],

            'type' => [
                'label' => $LLL . 'fields.type',
                'exclude' => true,
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$LLL . 'fields.type.items.0', 'FE'],
                        [$LLL . 'fields.type.items.1', 'BE']
                    ],
                ]
            ],
            'device_type' => [
                'label' => $LLL . 'fields.device_type',
                'exclude' => true,
                'config' => [
                    'type' => 'input'
                ]
            ],
            'browser' => [
                'label' => $LLL . 'fields.browser',
                'exclude' => true,
                'config' => [
                    'type' => 'input'
                ]
            ],
            'browser_version' => [
                'label' => $LLL . 'fields.browser_version',
                'exclude' => true,
                'config' => [
                    'type' => 'input'
                ]
            ],

            'level' => [
                'label' => $LLL . 'fields.level',
                'exclude' => true,
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectLevel',
                    'items' => [
                        [$LLL . 'fields.level.items.0', 'error']
                    ],
                ]
            ],
            'os' => [
                'label' => $LLL . 'fields.os',
                'exclude' => true,
                'config' => [
                    'type' => 'input'
                ]
            ],
            'os_version' => [
                'label' => $LLL . 'fields.os_version',
                'exclude' => true,
                'config' => [
                    'type' => 'input'
                ]
            ],
            'url' => [
                'label' => $LLL . 'fields.url',
                'exclude' => true,
                'config' => [
                    'type' => 'input'
                ]
            ],
            'user' => [
                'label' => $LLL . 'fields.user',
                'exclude' => true,
                'config' => [
                    'type' => 'input'
                ]
            ],
            'error_data' => [
                'label' => $LLL . 'fields.error_data',
                'exclude' => true,
                'config' => [
                    'type' => 'text',
                ],
            ],
            'message' => [
                'label' => $LLL . 'fields.message',
                'exclude' => true,
                'config' => [
                    'type' => 'text',
                ],
            ],
            'ip_address' => [
                'label' => $LLL . 'fields.ip_address',
                'exclude' => true,
                'config' => [
                    'type' => 'input'
                ]
            ],
            'ignore' => [
                'exclude' => 1,
                'label' => $LLL . 'fields.ignore',
                'config' => [
                    'type' => 'check'
                ],
            ],
            'reviewed' => [
                'exclude' => 1,
                'label' => $LLL . 'fields.reviewed',
                'config' => [
                    'type' => 'check'
                ],
            ],

        ],
    ];

    return $result;
}, 't3_monitoring', basename(__FILE__, '.php'));