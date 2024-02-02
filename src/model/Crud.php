<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once(dirname(__FILE__) . '/../model/Database.php');

class Crud extends Database
{



    public function insertDataUser($firstName, $lastName, $email, $password, $role)
    {
        $db =  $this->getConnection();

        $insertSql = "INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, role)  VALUES (:nom, :prenom, :email, :password, :role )";

        $statement = $db->prepare($insertSql);
        $statement->bindParam(':nom', $lastName);
        $statement->bindParam(':prenom', $firstName);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':role', $role);

        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur d'insertion : " . $e->getMessage();
            return false;
        }
    }
}
