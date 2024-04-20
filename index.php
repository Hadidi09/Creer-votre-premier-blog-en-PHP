<?php

use App\Controllers\CommentController;

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Controllers\PostController;
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
            print_r($postController->homePage());
            break;
        case "inscription":
            print_r($userController->userSignupForm());
            break;
        case "connexion":
            print_r($userController->userLoginForm());
            break;
        case "deconnexion":
            print_r($userController->logout());
            break;
        case "contact":
            print_r($postController->sendContactMessage());
            break;
        case "admin":
            print_r($postController->admin());
            break;
        case "blog_admin":
            print_r($postController->blog_Admin());
            break;
        case "listes_blog":
            print_r($postController->show_blog_list());
            break;
        case "blog_post":
            if ($get_Id[1] === "blog_post" && isset($get_Id[2])) {

                $blog_id = $get_Id[2];
                if (isset($get_Id[1]) && $get_Id[1] === "blog_post") {
                    print_r($postController->show_blog_post($blog_id));
                } else {
                    print_r($postController->show404Error());
                }
            }

            break;
        case "nouveau_blog_post":
            print_r($postController->createBlog_post());
            break;
        case "update_blog_id":
            if ($get_Id[1] === "update_blog_id" && isset($get_Id[2])) {
                $blog_id = $get_Id[2];
                if (isset($get_Id[1]) && $get_Id[1] === "update_blog_id") {
                    print_r($postController->update_blog_post($blog_id));
                } else {
                    print_r($postController->show404Error());
                }
            }
            break;
        case "delete_blog_id":
            if (isset($get_Id[1]) && isset($get_Id[2])) {
                $blog_id = $get_Id[2];
                print_r($postController->delete_blog($blog_id));
            } else {
                print_r($postController->show404Error());
            }
            break;
        case "addComment":
            if ($get_Id[1] === "addComment" && isset($get_Id[2])) {

                $blog_id = $get_Id[2];
                if (isset($get_Id[1]) && $get_Id[1] === "addComment" && !empty($blog_id)) {
                    print_r($commentController->insertComment($blog_id));
                } else {
                    print_r($postController->show404Error());
                }
            }
            break;
        case "blog_comment":
            print_r($commentController->showComments());
            break;
        case "validate_comment":
            if ($get_Id[1] === "validate_comment" && isset($get_Id[2])) {

                $comment_id = $get_Id[2];
                if (isset($get_Id[1]) && $get_Id[1] === "validate_comment") {
                    print_r($commentController->validateComment($comment_id));
                } else {
                    print_r($postController->show404Error());
                }
            }
            print_r($commentController->showComments());
            break;
        case "delete_comment":
            if ($get_Id[1] === "delete_comment" && isset($get_Id[2])) {

                $comment_id = $get_Id[2];
                if (isset($get_Id[1]) && $get_Id[1] === "delete_comment") {
                    print_r($commentController->deleteComment($comment_id));
                } else {
                    print_r($postController->show404Error());
                }
            }
            print_r($commentController->showComments());
            break;
        default:
            print_r($postController->show404Error());
    }
}
