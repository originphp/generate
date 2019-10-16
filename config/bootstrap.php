<?php

use Origin\Core\Config;

require __DIR__ . '/paths.php';
require ORIGIN . '/src/bootstrap.php';

Config::write('App.namespace', 'Generate');

use Origin\Model\ConnectionManager;

ConnectionManager::config('test', [
    'host' => env('DB_HOST', '127.0.0.1'),
    'database' => 'generate',
    'username' => env('DB_USERNAME'),
    'password' => env('DB_PASSWORD'),
    'engine' => env('DB_ENGINE', 'mysql')
]);
