<?php

namespace App\Models;

use App\Models\Entities\Post;
use PDO;
use PDOException;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class PostModel extends Database
{
    public function displayBlog(): array
    {
        $db = $this->getConnection();
        $selectSql = "SELECT * FROM blog_post";
        $statement = $db->prepare($selectSql);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $all_post = array();
        foreach ($result as $row) {
            $post = new Post($row);
            $all_post[] = $post;
        }
        return $all_post;
    }

    public function displayFirstThreeBlog()
    {
        $db = $this->getConnection();
        $selectSql = "SELECT * FROM blog_post ORDER BY dateDeMisAJour DESC LIMIT 3";
        $statement = $db->prepare($selectSql);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $firstThreePosts = array();

        foreach ($result as $row) {
            $post = new Post($row);

            $firstThreePosts[] = $post;
        }

        return $firstThreePosts;
    }

    public function createBlog_Post($title, $chapo, $content, $image, $user_id)
    {
        $db = $this->getConnection();
        $insertSql = "INSERT INTO blog_post(titre, chapo, contenu, dateDeCreation, dateDeMisAjour, utilisateur_id, image) VALUE (:titre, :chapo, :contenu, NOW(), NOW(), :utilisateur_id, :image)";
        $statement = $db->prepare($insertSql);
        $statement->bindParam(":titre", $title);
        $statement->bindParam(":chapo", $chapo);
        $statement->bindParam(":contenu", $content);
        $statement->bindParam(":image", $image);
        $statement->bindParam(":utilisateur_id", $user_id);

        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur d'insertion : " . $e->getMessage();
            return false;
        }
    }
    public function get_Blog_post_Id($id)
    {
        $db = $this->getConnection();
        $selectSql = "SELECT * FROM blog_post WHERE id = :id";
        $statement = $db->prepare($selectSql);
        $statement->bindParam(":id", $id);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $post = new Post($result);

            return $post;
        } else {
            echo "Pas de post trouvé";
            return null;
        }
    }

    public function updateBlog_Post($blog_id, $title, $chapo, $content, $image, $user_id)
    {
        $db = $this->getConnection();
        $updateSql = "UPDATE blog_post SET titre = :titre, chapo = :chapo, contenu = :contenu, image = :image, dateDeMisAJour = NOW(), utilisateur_id = :utilisateur_id WHERE id = :blog_id";
        $statement = $db->prepare($updateSql);
        $statement->bindParam(":blog_id", $blog_id);
        $statement->bindParam(":titre", $title);
        $statement->bindParam(":chapo", $chapo);
        $statement->bindParam(":contenu", $content);
        $statement->bindParam(":image", $image);
        $statement->bindParam(":utilisateur_id", $user_id);

        try {
            $statement->execute();
            if ($statement->rowCount() > 0) {
                $post = $this->get_Blog_post_Id($blog_id);
                return $post;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    public function deleteBlog($blog_id)
    {
        $post = $this->get_Blog_post_Id($blog_id);

        if ($post) {
            $db = $this->getConnection();
            $deleteSql = "DELETE FROM blog_post WHERE id = :blog_id";
            $statement = $db->prepare($deleteSql);
            $statement->bindParam(":blog_id", $blog_id);

            try {
                $statement->execute();
                return $post;
            } catch (PDOException $e) {
                return null;
            }
        } else {
            return null;
        }
    }
}
