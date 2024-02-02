<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once(dirname(__FILE__) . '/../model/Crud.php');





class CrudControllers
{

    public $crud;

    public function __construct()
    {
        $this->crud = new Crud();
    }


    public function insertData()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $lastName = $_POST["lastname"];
            $firstName = $_POST["firstname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $role = "utilisateur";

            $result = $this->crud->insertDataUser($firstName, $lastName, $email, $password, $role);

            if ($result) {
                echo "user successefully insert";
                header("Location: /../views/page_inscription.php");
            } else {
                echo "erreur d'inscription du user";
            }
        }

        echo "Sortie de insertData";
    }
}


$controller = new CrudControllers();
$controller->insertData();
