<?php

namespace App\Models;

use App\Models\Entities\Commentaire;
use PDO;
use PDOException;

class CommentModel extends Database
{
    public function insertComment($contenu, $status, $utilisateur_id, $blog_id)
    {
        $db = $this->getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $insertSql = "INSERT INTO commentaire (contenu, status, date, utilisateur_id, blog_id) VALUES (:contenu, :status, NOW(), :utilisateur_id, :blog_id)";
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

    public function selectAllComment()
    {
        try {
            $db = $this->getConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $selectSql =  "SELECT commentaire.*, utilisateur.prenom, utilisateur.nom FROM commentaire
                            INNER JOIN utilisateur ON commentaire.utilisateur_id = utilisateur.id WHERE status = 0";

            $statement = $db->prepare($selectSql);
            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            $comments = [];
            foreach ($result as $row) {
                $comment = new Commentaire($row);
                $comments[] = $comment;
            }

            return $comments;
        } catch (PDOException $e) {
            echo "Erreur PDO: " . $e->getMessage();
            return false;
        }
    }

    public function selectComment($blog_id)
    {
        try {
            $db = $this->getConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $selectSql =  "SELECT utilisateur.prenom, commentaire.* FROM commentaire INNER JOIN utilisateur ON utilisateur.id = commentaire.utilisateur_id WHERE commentaire.blog_id = :blog_id  ";

            $statement = $db->prepare($selectSql);
            $statement->bindParam(':blog_id', $blog_id);
            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            $comments = [];
            foreach ($result as $row) {
                $comment = new Commentaire($row);
                $comments[] = $comment;
            }

            return $comments;
        } catch (PDOException $e) {
            echo "Erreur PDO: " . $e->getMessage();
            return false;
        }
    }

    public function deleteComment($comment_id)
    {
        try {
            $db = $this->getConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $deleteSql = "DELETE FROM commentaire WHERE id = :comment_id";
            $statement = $db->prepare($deleteSql);
            $statement->bindParam(':comment_id', $comment_id);
            $statement->execute();

            return true;
        } catch (PDOException $e) {
            echo "Erreur de suppression : " . $e->getMessage();
            return false;
        }
    }

    public function validateComment($comment_id)
    {
        try {
            $db = $this->getConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $updateSql = "UPDATE commentaire SET status = 1 WHERE id = :comment_id";
            $statement = $db->prepare($updateSql);
            $statement->bindParam(':comment_id', $comment_id);
            $statement->execute();

            return true;
        } catch (PDOException $e) {
            echo "Erreur de validation du commentaire : " . $e->getMessage();
            return false;
        }
    }
}
