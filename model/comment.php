<?php

class Comment
{
    private $id;
    private $postId;
    private $pseudo;
    private $content;
    private $publishedAt;
    private $report;

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
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of postId
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set the value of postId
     *
     * @return  self
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * Get the value of pseudo
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of publishedAt
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set the value of publishedAt
     *
     * @return  self
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = new DateTime($publishedAt);

        return $this;
    }

    /**
     * Get the value of report
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * Set the value of report
     *
     * @return  self
     */
    public function setReport($report)
    {
        $this->report = $report;

        return $this;
    }
}
