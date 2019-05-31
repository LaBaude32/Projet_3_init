<?php

class AutorManager extends BddManager
{
    public function create()
    {
        $bdd = $this->getBdd();
    }

    public function findOneByEmail($email)
    {
        $bdd = $this->getBdd();

        $query = 'SELECT * FROM autor WHERE email=\'' . $email . '\'';
        $req = $bdd->query($query);
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);
        $autor = new Autor();
        $autor->hydrate($row);
        return $autor;
    }

    public function findOneById($id)
    {
        $bdd = $this->getBdd();

        $query = 'SELECT * FROM autor WHERE id=' . $id;

        $req = $bdd->query($query);
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);
        $autor = new Autor();
        $autor->hydrate($row);
        return $autor;
    }

    public function findAll()
    {
        $bdd = $this->getBdd();

        $query = 'SELECT * FROM autor';

        $req = $bdd->query($query);
        $req->execute();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            $autor = new Autor();
            $autor->hydrate($row);

            $autors[] = $autor; //tableau d'objets

        }
        //echo "<pre>"; var_dump($autors); die;
        return $autors;
    }

    public function update()
    {
        $bdd = $this->getBdd();
    }

    public function delete($id)
    {
        $bdd = $this->getBdd();

        $id = (int)$id;
        $req = $bdd->prepare('DELETE FROM autor WHERE id= :id');
        $req->bindValue('id', $id, PDO::PARAM_INT);

        $req->execute();
    }
}
