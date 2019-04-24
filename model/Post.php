<?php

class Post
{
    private $id;
    private $idAutor;
    private $titreChap;
    private $content;
    private $dateCreation;
    private $datePublication;
    private $isDraft;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id
    }

    /**
     * @return mixed
     */
    public function getIdAutor()
    {
        return $this->idAutor
    }


    /**
     * @param mixed $idAutor
     */
    public function setIdAutor($idAutor)
    {
       $this->idAutor = $idAutor
    }

    /**
     * @return mixed
     */
    public function getTitreChap()
    {
        return $this->titreChap
    }


    /**
     * @param mixed $titreChap
     */
    public function setTitreChap($titreChap)
    {
       $this->titreChap = $titreChap
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content
    }


    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
       $this->content = $content
    }


    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation
    }


    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
       $this->dateCreation = $dateCreation
    }

    /**
     * @return mixed
     */
    public function getDatePublication()
    {
        return $this->datePublication
    }


    /**
     * @param mixed $datePublication
     */
    public function setDatePublication($datePublication)
    {
       $this->datePublication = $datePublication
    }


    /**
     * @return mixed
     */
    public function getIsDraft()
    {
        return $this->isDraft
    }


    /**
     * @param mixed $isDraft
     */
    public function setIsDraft($isDraft)
    {
       $this->isDraft = $isDraft
    }
}