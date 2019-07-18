<?php
class Autor
{
    private $id;
    private $pseudo;
    private $email;
    private $firstName;
    private $lastName;
    private $pwd;
    private $roleAdmin;

    public function hydrate($datas) {
        foreach($datas as $field => $value) {

            $elements = explode('_', $field);

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
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of pwd
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set the value of pwd
     *
     * @return  self
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * Get the value of roleAdmin
     */
    public function getRoleAdmin()
    {
        return $this->roleAdmin;
    }

    /**
     * Set the value of roleAdmin
     *
     * @return  self
     */
    public function setRoleAdmin($roleAdmin)
    {
        $this->roleAdmin = $roleAdmin;

        return $this;
    }

    public function getFullName()
    {
        $fullName = ucfirst(strtolower($this->firstName)) . ' ' . strtoupper($this->lastName);
        return $fullName;
    }

    public function showCheckedValue($value)
    {
        if($this->roleAdmin == $value){
            return 'checked';
        }
    }
}