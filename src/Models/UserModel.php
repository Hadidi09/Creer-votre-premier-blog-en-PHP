<?php

namespace App\Models;

use PDO;
use PDOException;

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once(dirname(__FILE__) . '/../Models/Database.php');

class UserModel extends Database
{


    // inscription
    public function insertDataUser($firstName, $lastName, $email, $password, $role)
    {
        $db =  $this->getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertSql = "INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, role)  VALUES (:nom, :prenom, :email, :password, :role )";

        $statement = $db->prepare($insertSql);
        $statement->bindParam(':nom', $lastName);
        $statement->bindParam(':prenom', $firstName);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $hashedPassword);
        $statement->bindParam(':role', $role);

        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur d'insertion : " . $e->getMessage();
            return false;
        }
    }



    public function userExists($email)
    {
        $db = $this->getConnection();

        $selectSql = "SELECT COUNT(*) FROM utilisateur WHERE email = :email";

        $statement = $db->prepare($selectSql);
        $statement->bindParam(':email', $email);

        $statement->execute();

        $count = $statement->fetchColumn();

        return $count > 0;
    }
}