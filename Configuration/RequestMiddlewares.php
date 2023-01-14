<?php
return [
    'frontend' => [
        'error-receive' => [
            'target' => \FloPe\T3Monitoring\Middleware\ErrorReceiveMiddleware::class,
            'before' => [
                'typo3/cms-frontend/maintenance-mode',
            ],
            'after' => [
                'typo3/cms-frontend/site',
            ],
        ],
    ],
];