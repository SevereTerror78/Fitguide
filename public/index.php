<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Maintenance mode
if (file_exists($maintenance = __DIR__.'/../fitguide_app/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Autoload
require __DIR__.'/../fitguide_app/vendor/autoload.php';

// Bootstrap
/** @var Application $app */
$app = require_once __DIR__.'/../fitguide_app/bootstrap/app.php';

// Run
$app->handleRequest(Request::capture());