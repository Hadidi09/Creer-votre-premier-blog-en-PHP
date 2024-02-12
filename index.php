<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Models\Database;
use App\Controllers\UserController;

require_once __DIR__ . '/vendor/autoload.php';

define('ROOT', dirname(__DIR__));

$db = new Database;

$connection = $db->getConnection();

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

if (!empty($method)  && !empty($path)) {

    $userController = new UserController($connection);

    switch ($path) {
        case "/":
            echo "hello boys ";
            break;
        case "/signup":
            echo $userController->insertData();
            break;
        default:
            echo "error not found ";
    }
}
