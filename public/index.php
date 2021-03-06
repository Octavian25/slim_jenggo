<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
$dependencies = require __DIR__ . '/../src/dependencies.php';
$dependencies($app);

// Register middleware
$middleware = require __DIR__ . '/../src/middleware.php';
$middleware($app);

// Register routes
// $routes = require __DIR__ . '/../src/routes.php';
// $routes = require __DIR__ . '/../src/barang.php';
// $routes = require __DIR__ . '/../src/login.php';        
// $routes($app);
require __DIR__ . '/../src/barang.php';
require  __DIR__ .'/../src/login.php';
require  __DIR__ .'/../src/bahan_baku.php';
require  __DIR__ .'/../src/absensi.php';
require  __DIR__ .'/../src/pegawai.php';
require  __DIR__ .'/../src/menu.php';
require  __DIR__ .'/../src/cabang.php';
require  __DIR__ .'/../src/operasional.php';


// Run app
$app->run();
