<?php
return [
    'settings' => [
        // 'displayErrorDetails' => true, // set to false in production
        'displayErrorDetails' => false, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        // Database Settings
        'db' => [
            'host' => 'localhost',
            // 'user' => 'root', //rinx4592_admin
            // 'pass' => '', // kebonlega1
            // 'dbname' => 'kopi_jenggo', //rinx4592_kopi_jenggo
            'user' => 'rinx4592_admin', //rinx4592_admin
            'pass' => 'kebonlega1', // kebonlega1
            'dbname' => 'rinx4592_kopi_jenggo', //rinx4592_kopi_jenggo
            'driver' => 'mysql'
        ]
    ],
];
