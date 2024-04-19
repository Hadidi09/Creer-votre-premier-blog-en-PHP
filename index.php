<?php

use App\Controllers\CommentController;

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Controllers\PostController;
use App\Models\Database;
use App\Controllers\UserController;

require_once __DIR__ . '/vendor/autoload.php';

define('ROOT', dirname(__DIR__));



$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];
$get_Id = explode("/", $path);

if (!empty($method)  && !empty($path)) {

    $userController = new UserController();
    $postController = new PostController();
    $commentController = new CommentController();
    switch ($get_Id[1]) {
        case "":
            echo $postController->homePage();
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
            echo $postController->sendContactMessage();
            break;
        case "admin":
            echo $postController->admin();
            break;
        case "blog_admin":
            echo $postController->blog_Admin();
            break;
        case "listes_blog":
            echo $postController->show_blog_list();
            break;
        case "blog_post":
            if ($get_Id[1] === "blog_post" && isset($get_Id[2])) {

                $blog_id = $get_Id[2];
                if (isset($get_Id[1]) && $get_Id[1] === "blog_post") {
                    echo $postController->show_blog_post($blog_id);
                } else {
                    echo $postController->show404Error();
                }
            }

            break;
        case "nouveau_blog_post":
            echo $postController->createBlog_post();
            break;
        case "update_blog_id":
            if ($get_Id[1] === "update_blog_id" && isset($get_Id[2])) {

                $blog_id = $get_Id[2];
                if (isset($get_Id[1]) && $get_Id[1] === "update_blog_id") {
                    echo $postController->update_blog_post($blog_id);
                } else {
                    echo $postController->show404Error();
                }
            }
            break;
        case "delete_blog_id":
            if (isset($get_Id[1]) && isset($get_Id[2])) {
                $blog_id = $get_Id[2];
                echo $postController->delete_blog($blog_id);
            } else {
                echo $postController->show404Error();
            }
            break;
        case "addComment":
            if ($get_Id[1] === "addComment" && isset($get_Id[2])) {

                $blog_id = $get_Id[2];
                if (isset($get_Id[1]) && $get_Id[1] === "addComment" && !empty($blog_id)) {
                    echo $commentController->insertComment($blog_id);
                } else {
                    echo $postController->show404Error();
                }
            }
            break;
        case "blog_comment":
            echo $commentController->showComments();
            break;
        case "validate_comment":
            if ($get_Id[1] === "validate_comment" && isset($get_Id[2])) {

                $comment_id = $get_Id[2];
                if (isset($get_Id[1]) && $get_Id[1] === "validate_comment") {
                    echo $commentController->validateComment($comment_id);
                } else {
                    echo $postController->show404Error();
                }
            }
            echo $commentController->showComments();
            break;
        case "delete_comment":
            if ($get_Id[1] === "delete_comment" && isset($get_Id[2])) {

                $comment_id = $get_Id[2];
                if (isset($get_Id[1]) && $get_Id[1] === "delete_comment") {
                    echo $commentController->deleteComment($comment_id);
                } else {
                    echo $postController->show404Error();
                }
            }
            echo $commentController->showComments();
            break;
        default:
            echo $postController->show404Error();
    }
}
