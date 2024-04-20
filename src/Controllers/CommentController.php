<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\CommentModel;


error_reporting(E_ALL);
ini_set('display_errors', 1);

class CommentController extends Controller
{
    private $commentModel;
    public function __construct()
    {
        parent::__construct();
        $this->commentModel = new CommentModel();
    }

    public function insertComment($blog_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["commenter"])) {
            $contenu = $_POST['comment'];
            $utilisateur_id = $_SESSION['connected']['id'];
            $status = "en attente";


            $comments = $this->commentModel->insertComment($contenu, $status, $utilisateur_id, $blog_id);

            if ($comments) {
                // echo "commentaire envoyé avec succés";
                $_SESSION['commentaire'] = "votre commentaire est en attente de validation par le modérateur";
                header("Location: /blog_post/$blog_id");
            } else {
                echo "rien ne marche encore";
            }
        }
    }

    public function showComments()
    {
        $comments = $this->commentModel->selectAllComment();

        $this->renderTwigView('blog/blog_comment.html.twig', ['comments' => $comments]);
    }

    public function validateComment($comment_id)
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifier"])) {
            $validateComment = $this->commentModel->validateComment($comment_id);

            if ($validateComment) {
                header("Location: /blog_comment");
            }
        }
    }
    public function deleteComment($comment_id)
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["supprimer"])) {
            $validateComment = $this->commentModel->deleteComment($comment_id);

            if ($validateComment) {
                header("Location: /blog_comment");
            }
        }
    }
}
