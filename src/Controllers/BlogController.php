<?php

namespace App\Controllers;

use App\Controllers\Controller;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\BlogModel;
use App\Models\CommentModel;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class BlogController extends Controller
{
    private $blogModel;
    private $commentModel;
    public function __construct()
    {
        parent::__construct();
        $this->blogModel = new BlogModel();
        $this->commentModel = new CommentModel;
    }

    public function homePage()
    {
        if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
            $this->renderTwigView('main/acceuil.html.twig');
        } else {
            header('Location: connexion');
            exit();
        }
    }
    public function sendContactMessage()
    {
        if (!empty($_POST['email']) && !empty($_POST['message'])) {
            $to = $_POST['email'];
            $subject = 'Contact nous';
            $message = $_POST['message'];
            $mail = new PHPMailer(true);
            try {

                $mail->isSMTP();
                $mail->Host = 'localhost';
                $mail->SMTPAutoTLS = false;
                $mail->Port = 1025;
                $mail->setFrom('hadra90@gmail.com', 'hadramy');
                $mail->addAddress($to);
                $mail->Subject = $subject;
                $mail->Body = $message;
                // Envoyer l'e-mail
                $mail->send();
                echo 'E-mail envoyé avec succès';
                $_POST['firstname'] = '';
                $_POST['lastname'] = '';
                $_POST['email'] = '';
                $_POST['message'] = '';
                header('Location: /');
                exit();
            } catch (Exception $e) {
                echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
            }
        }
    }
    // Show Admin page
    public function admin()
    {
        $this->renderTwigView("blog/admin.html.twig");
    }
    // Admin all blog_post
    public function blog_Admin()
    {
        $blogs = $this->blogModel->displayBlog();

        $this->renderTwigView("blog/blog_admin.html.twig", ["blogs" => $blogs]);
    }
    // create blog_post_id
    public function createBlog_post()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["envoyer"])) {
            $title = $_POST['title'];
            $chapo = $_POST['chapo'];
            $content = $_POST['content'];
            $user_id = 1;

            if (isset($_FILES['file'])) {
                var_dump($_FILES['file']);
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];

                $tableExtension = explode('.', $name);
                $extension = strtolower(end($tableExtension));

                $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $maxSize =  500000;
                if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                    $originalName = pathinfo($name, PATHINFO_FILENAME);
                    $uniqueName =  uniqid($originalName . '-', true);
                    $file = $uniqueName . "." . $extension;
                    move_uploaded_file($tmpName, __DIR__ . DIRECTORY_SEPARATOR . "../../public/uploads/" . $file);
                }
                $image = $file;
                $create_blog = $this->blogModel->createBlog_Post($title, $chapo, $content, $image, $user_id);
                if ($create_blog) {
                    $_SESSION['message'] = '<div class="alert alert-success" role="alert">
                     <p class="">blog_post  ajouté avec succés ! </p>
                     </div>';
                    header("Location:/blog_admin");
                    echo $_SESSION['message'];
                    exit();
                } else {
                    echo "echec lors de l'ajout";
                }
            }
        }
        $this->renderTwigView("blog/creation_blog_post.html.twig");
    }
    // page 404
    public function show404Error()
    {
        $this->renderTwigView("page404.html.twig");
    }
    // Get blog_post_id
    public function Blog_post_Id($blog_id)
    {
        $blog_id = $this->blogModel->get_Blog_post_Id($blog_id);

        $this->renderTwigView("blog/update_blog.html.twig",  ["blog" => $blog_id]);
    }
    // Update blog_post_id
    public function update_blog_post($blog_id)
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifier"])) {
            $title = $_POST['title'];
            $chapo = $_POST['chapo'];
            $content = $_POST['content'];
            $user_id = 1;

            if (!empty($_FILES['file']['tmp_name'])) {
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];

                $tableExtension = explode('.', $name);
                $extension = strtolower(end($tableExtension));

                $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $maxSize =  500000;
                if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                    $originalName = pathinfo($name, PATHINFO_FILENAME);
                    $uniqueName =  uniqid($originalName . '-', true);
                    $file = $uniqueName . "." . $extension;

                    move_uploaded_file($tmpName, __DIR__ . DIRECTORY_SEPARATOR . "../../public/uploads/" . $file);
                }
                $image = $file;
            } else {
                $blog = $this->blogModel->get_Blog_post_Id($blog_id);
                $image = $blog['image'];
            }
            // var_dump($image);
            $create_blog = $this->blogModel->updateBlog_Post($blog_id, $title, $chapo, $content, $image, $user_id);
            if ($create_blog) {
                header("Location: /blog_admin");
                exit();
            } else {
                echo "echec lors de l'ajout";
            }
        }

        $blog_id = $this->blogModel->get_Blog_post_Id($blog_id);
        $this->renderTwigView("blog/update_blog.html.twig", ['blog' => $blog_id]);
    }
    // Delete blog_post_id
    public function delete_blog($blog_id)
    {
        if (!isset($blog_id) || empty($blog_id)) {
            echo "Identifiant du blog post non valide.";
            return;
        }
        $success = $this->blogModel->deleteBlog($blog_id);
        if ($success) {
            header("Location: blog_admin");
            exit();
        } else {
            echo "Échec de la suppression du blog post";
        }
    }
    // Show details one blog_post
    public function show_blog_post($blog_id)
    {
        $the_blog_post = $this->blogModel->get_Blog_post_Id($blog_id);
        $comments = $this->commentModel->selectComment($blog_id);
        $firstBlogs = $this->blogModel->displayFirstThreeBlog();
        //var_dump($firstBlogs);
        $notification = $_SESSION['commentaire'] ?? null;
        if (isset($_SESSION['commentaire'])) {
            // echo ($_SESSION['commentaire']);
            unset($_SESSION['commentaire']);
        }

        $base_url = "../public/";
        $this->twig->display('blog/one_blog_post.html.twig', ['blogs' => $the_blog_post, "base_url" => $base_url, 'comments' => $comments, 'asideblogs' => $firstBlogs, 'notification' => $notification]);
    }
}
