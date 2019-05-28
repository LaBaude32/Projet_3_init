<?php

class Post
{
    private $id;
    private $autorId;
    private $title;
    private $content;
    private $createdAt;
    private $publishedAt;
    private $savedAt;
    private $isDraft;


    public function hydrate($datas) { // array('id' => 5, 'autor_id' => '6) // setAutor_id => setAutorId
       foreach($datas as $field => $value) {

           $elements = explode('_', $field); // array(0 => 'autor', 1 => 'id');

           $method = "set";
           foreach($elements as $e){
            $method .= ucfirst($e);
           }
           if(method_exists($this, $method)) {
               $this->$method($value);
           }
       }
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return htmlspecialchars($this->id);
    }

        /**
     * @param mixed $id
     */
    public function setId($id)
    {
       $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getAutorId()
    {
        return htmlspecialchars($this->autorId);
    }


    /**
     * @param mixed $idAutor
     */
    public function setAutorId($autorId)
    {
       $this->autorId = $autorId;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return htmlspecialchars($this->title);
    }


    /**
     * @param mixed $Title
     */
    public function setTitle($title)
    {
       $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }


    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
       $this->content = $content;
    }


    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
       $this->createdAt = new DateTime($createdAt);
    }

    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param mixed $publishedAt
     */
    public function setPublishedAt($publishedAt)
    {
       $this->publishedAt = new DateTime($publishedAt);
    }

    /**
     * Get the value of savedAt
     */
    public function getSavedAt()
    {
        return $this->savedAt;
    }

    /**
     * Set the value of savedAt
     *
     * @return  self
     */
    public function setSavedAt($savedAt)
    {
        $this->savedAt = new DateTime($savedAt);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsDraft()
    {
        return htmlspecialchars($this->isDraft);
    }


    /**
     * @param mixed $isDraft
     */
    public function setIsDraft($isDraft)
    {
       $this->isDraft = $isDraft;
    }
}