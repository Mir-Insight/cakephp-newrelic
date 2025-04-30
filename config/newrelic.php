<?php
declare(strict_types=1);

return [
    'NewRelic' => [
        // Enable/disable NewRelic integration
        'enabled' => true,

        // Application name in NewRelic
        'appName' => 'CakePHP Application',

        // Enable/disable parameter capture
        'captureParams' => true,

        // Custom parameters to add to all transactions
        'customParameters' => [
            // 'environment' => 'production',
            // 'version' => '1.0.0',
        ],

        // Custom metrics to track
        'customMetrics' => [
            // 'custom/cache_hits' => 0,
            // 'custom/cache_misses' => 0,
        ],

        // Custom tracer methods
        'customTracers' => [
            // 'App\Model\Table\UsersTable::findActive',
        ],
    ],
]; 