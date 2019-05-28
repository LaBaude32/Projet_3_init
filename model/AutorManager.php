<?php

class AutorManager extends BddManager
{
    public function create()
    {
        $bdd =$this->getBdd();
    }

    public function findOneByEmail($email)
    {
        $bdd =$this->getBdd();

        $query = 'SELECT * FROM autor WHERE email=\''. $email.'\'';
		$req = $bdd->query($query);
        $req->execute();
		$row = $req->fetch(PDO::FETCH_ASSOC);
		$autor = new Autor();
		$autor->hydrate($row);
		return $autor;
    }

    public function update()
    {
        $bdd =$this->getBdd();
    }

    public function delete()
    {
        $bdd =$this->getBdd();
    }
}
