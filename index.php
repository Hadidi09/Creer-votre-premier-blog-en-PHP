<?php

use App\Controllers\Router;


session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/vendor/autoload.php';

define('ROOT', dirname(__DIR__));


$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$route = new Router();

$route->route();
