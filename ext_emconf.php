<?php

/**
 * Extension Manager/Repository config file for ext "t3_monitoring".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'T3 Monitoring',
    'description' => 'Add various monitoring possibilitie',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.5.99',
            'fluid_styled_content' => '11.5.0-11.5.99',
            'rte_ckeditor' => '11.5.0-11.5.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'FloPe\\T3Monitoring\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Florian Peters',
    'author_email' => 'typo3@florianpeters.de',
    'author_company' => 'Florian Peters',
    'version' => '1.0.0',
];
