<?php

namespace App\Controllers;

use App\Models\UserModel;


error_reporting(E_ALL);
ini_set('display_errors', 1);


class UserController extends Controller
{

    public $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }


    public function insertData()
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

        //echo "Sortie de insertData";
        $this->twig->display('user/inscription.html.twig');
    }
}
