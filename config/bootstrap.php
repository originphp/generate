<?php

/**
 * This is the bootstrap for plugin when using as standalone (for development). Do not
 * use this bootstrap as a plugin. .gitattributes has blocked this from being installed.
 */

use Origin\Cache\Cache;
use Origin\Cache\Engine\FileEngine;
use Origin\Core\Config;

require __DIR__ . '/paths.php';
require dirname(__DIR__) . '/vendor/originphp/framework/src/Core/bootstrap.php';

Config::write('App.namespace', 'Generate');

use Origin\Model\ConnectionManager;

ConnectionManager::config('test', [
    'host' => env('DB_HOST', '127.0.0.1'),
    'database' => 'generate',
    'username' => env('DB_USERNAME'),
    'password' => env('DB_PASSWORD'),
    'engine' => env('DB_ENGINE', 'mysql')
]);

Cache::config('origin', [
    'className' => FileEngine::class,
    'path' => CACHE . '/origin',
    'duration' => '+2 minutes',
    'prefix' => 'cache_',
    'serialize' => true
]);
