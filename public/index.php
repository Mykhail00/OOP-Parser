<?php

declare(strict_types = 1);

use App\App;
use App\Config;
use App\Controllers\HomeController;
use App\Controllers\UploadController;
use App\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

$router = new Router();

try {
    $router
        ->get('/', [HomeController::class, 'index'])
        ->get('/transactions', [HomeController::class, 'transactions'])
        ->get('/upload', [UploadController::class, 'index'])
        ->post('/upload', [UploadController::class, 'upload']);
} catch (\Throwable $e) {
    exit();
}

(new App(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();