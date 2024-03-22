<?php

use App\Controllers\CommentController;

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Controllers\BlogController;
use App\Models\Database;
use App\Controllers\UserController;

require_once __DIR__ . '/vendor/autoload.php';

define('ROOT', dirname(__DIR__));

$db = new Database;

$connection = $db->getConnection();

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];
$get_Id = explode("/", $path);

if (!empty($method)  && !empty($path)) {

    $userController = new UserController();
    $blogController = new BlogController();
    $commentController = new CommentController();
    switch ($get_Id[1]) {
        case "":
            echo $blogController->homePage();
            break;
        case "inscription":
            echo $userController->userSignupForm();
            break;
        case "connexion":
            echo $userController->userLoginForm();
            break;
        case "deconnexion":
            echo $userController->logout();
            break;
        case "contact":
            echo $blogController->sendContactMessage();
            break;
        case "admin":
            echo $blogController->admin();
            break;
        case "blog_admin":
            echo $blogController->blog_Admin();
            break;
        case "blog_post":
            if ($get_Id[1] === "blog_post" && isset($get_Id[2])) {

                $blog_id = $get_Id[2];
                if (isset($get_Id[1]) && $get_Id[1] === "blog_post") {
                    echo $blogController->show_blog_post($blog_id);
                } else {
                    echo $blogController->show404Error();
                }
            }

            break;
        case "nouveau_blog_post":
            echo $blogController->createBlog_post();
            break;
        case "update_blog_id":
            if ($get_Id[1] === "update_blog_id" && isset($get_Id[2])) {

                $blog_id = $get_Id[2];
                if (isset($get_Id[1]) && $get_Id[1] === "update_blog_id") {
                    echo $blogController->update_blog_post($blog_id);
                } else {
                    echo $blogController->show404Error();
                }
            }
            break;
        case "delete_blog_id":
            if (isset($get_Id[1]) && isset($get_Id[2])) {
                $blog_id = $get_Id[2];
                echo $blogController->delete_blog($blog_id);
            } else {
                echo $blogController->show404Error();
            }
            break;
        case "addComment":
            if ($get_Id[1] === "addComment" && isset($get_Id[2])) {

                $blog_id = $get_Id[2];
                if (isset($get_Id[1]) && $get_Id[1] === "addComment" && !empty($blog_id)) {
                    echo $commentController->insertComment($blog_id);
                } else {
                    echo $blogController->show404Error();
                }
            }
            break;

        default:
            echo $blogController->show404Error();
    }
}
