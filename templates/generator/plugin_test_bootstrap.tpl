<?php
/**
 * This is the test bootstrap which you can use for overwriting
 */
use Origin\Core\Config;

require dirname(__DIR__, 3) . '/config/bootstrap.php';

Config::write('App.url', 'http://localhost');
