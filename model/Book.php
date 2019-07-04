<?php

class Book
{
    private $id;
    private $title;
    private $resume;

    public function hydrate($datas)
    { // array('id' => 5, 'autor_id' => '6) // setAutor_id => setAutorId
        foreach ($datas as $field => $value) {

            $elements = explode('_', $field); // array(0 => 'autor', 1 => 'id');

            $method = "set";
            foreach ($elements as $e) {
                $method .= ucfirst($e);
            }
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
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of resume
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set the value of resume
     *
     * @return  self
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }
}
