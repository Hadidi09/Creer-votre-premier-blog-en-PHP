<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\Controller;

error_reporting(E_ALL);
ini_set('display_errors', 1);


class UserController extends Controller
{

    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function userSignupForm()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $lastName = $_POST["lastname"];
            $firstName = $_POST["firstname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $role = "utilisateur";

            if ($this->userModel->userExists($email)) {
                echo "Utilisateur existant, veuillez vous connecter.";
                $this->twig->display('user/connexion.html.twig');
                header("Location: /login");
            } else {
                $result = $this->userModel->insertDataUser($firstName, $lastName, $email, $password, $role);

                if ($result) {
                    echo "Utilisateur inséré avec succès";
                    header("Location: /login");
                } else {
                    echo "Erreur d'inscription de l'utilisateur";
                }
            }
        }
        $this->renderTwigView('user/inscription.html.twig');
    }
    public function userLoginForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check email
            if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['email'];
            } else {
                echo 'Email invalide';
                return;
            }

            // Check password
            if (isset($_POST['password']) && strlen($_POST['password']) >= 4) {
                $password = $_POST['password'];
            } else {
                echo 'Mot de passe invalide ';
                return;
            }
            $authenticated = $this->userModel->authenticateUser($email, $password);

            if ($authenticated) {
                echo 'connexion reussie !';
                header('Location: /');
            } else {
                echo 'Mauvaise combinaison email/mot de passe';
            }
        }
        $this->renderTwigView('user/connexion.html.twig');
    }
}
