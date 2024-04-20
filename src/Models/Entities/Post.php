<?php

namespace App\Models\Entities;

class Post
{

    private $id;
    private $titre;
    private $chapo;
    private $contenu;
    private $dateDeCreation;
    private $dateDeMisAJour;
    private $utilisateur_id;
    private $image;

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($post_id)
    {
        $this->id = $post_id;

        return $this;
    }

    /**
     * Get the value of titre
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of chapo
     */
    public function getChapo()
    {
        return $this->chapo;
    }

    /**
     * Set the value of chapo
     *
     * @return  self
     */
    public function setChapo($chapo)
    {
        $this->chapo = $chapo;

        return $this;
    }

    /**
     * Get the value of contenu
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set the value of contenu
     *
     * @return  self
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get the value of dateDeCreation
     */
    public function getDateDeCreation()
    {
        return $this->dateDeCreation;
    }

    /**
     * Set the value of dateDeCreation
     *
     * @return  self
     */
    public function setDateDeCreation($dateDeCreation)
    {
        $this->dateDeCreation = $dateDeCreation;

        return $this;
    }

    /**
     * Get the value of dateDeMisAJour
     */
    public function getDateDeMisAJour()
    {
        return $this->dateDeMisAJour;
    }

    /**
     * Set the value of dateDeMisAJour
     *
     * @return  self
     */
    public function setDateDeMisAJour($dateDeMisAJour)
    {
        $this->dateDeMisAJour = $dateDeMisAJour;

        return $this;
    }

    /**
     * Get the value of utilisateur_id
     */
    public function getUtilisateur_id()
    {
        return $this->utilisateur_id;
    }

    /**
     * Set the value of utilisateur_id
     *
     * @return  self
     */
    public function setUtilisateur_id($utilisateur_id)
    {
        $this->utilisateur_id = $utilisateur_id;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}
