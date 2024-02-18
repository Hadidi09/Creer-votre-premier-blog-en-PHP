<?php

namespace App\Controllers;

use App\Controllers\Controller;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class BlogController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function homePage()
    {
        $this->renderTwigView('main/acceuil.html.twig');
    }
    public function SendContactMessage()
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
}
