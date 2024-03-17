<?php

namespace App\Models;

use PDO;
use PDOException;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class CommentModel extends Database
{

    public function insertComment($contenu, $status, $utilisateur_id, $blog_id)
    {
        $db = $this->getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $insertSql = "INSERT INTO commentaire (contenu, status,commentairecol,date, utilisateur_id, blog_id) VALUES (:contenu, :status,'the old new old boys' ,Now() ,:utilisateur_id, :blog_id)";
        $statement = $db->prepare($insertSql);
        $statement->bindParam(':contenu', $contenu);
        $statement->bindParam(':status', $status);
        $statement->bindParam(':utilisateur_id', $utilisateur_id);
        $statement->bindParam(':blog_id', $blog_id);

        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur d'insertion : " . $e->getMessage();
            return false;
        }
    }

    public function selectComment()
    {
        try {
            $db = $this->getConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $selectSql =  "SELECT utilisateur.prenom, commentaire.* FROM commentaire INNER JOIN utilisateur ON utilisateur.id = commentaire.utilisateur_id";


            $statement = $db->prepare($selectSql);
            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            $db = null;

            //var_dump($result);

            return $result;
        } catch (PDOException $e) {
            echo "Erreur PDO: " . $e->getMessage();
            return false;
        }
    }
}
