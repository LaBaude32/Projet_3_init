<?php

class AutorManager extends BddManager
{
    public function findOneByEmail($email)
    {
        $bdd = $this->getBdd();

        $query = 'SELECT * FROM autor WHERE email=:email';
        $req = $bdd->prepare($query);
        $req->bindValue('email', $email);
        $req->execute();
        if(!$row = $req->fetch(PDO::FETCH_ASSOC)) return null;

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

            $autors[] = $autor;

        }
        return $autors;
    }

    public function insertBdd($autorArray)
    {

        $bdd = $this->getBdd();

        $lastName = strtoupper($autorArray['lastName']);
        $firstName = ucfirst(strtolower($autorArray['firstName']));
        $role = strtoupper($autorArray['roleAdmin']);

        $query = "INSERT INTO autor(pseudo, email, last_name, first_name, role_admin, pwd) VALUES(:pseudo, :email, :lastName, :firstName, :roleAdmin, :pwd)";
        $req = $bdd->prepare($query);
        $req->bindValue('pseudo', $autorArray['pseudo'], PDO::PARAM_STR);
        $req->bindValue('email', $autorArray['email'], PDO::PARAM_STR);
        $req->bindValue('lastName', $autorArray['lastName'], PDO::PARAM_STR);
        $req->bindValue('firstName', $autorArray['firstName'], PDO::PARAM_STR);
        $req->bindValue('pwd', password_hash($autorArray['pwd'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $req->bindValue('roleAdmin', $autorArray['roleAdmin'], PDO::PARAM_STR);
        $req->execute();
    }


    public function save($autorArray)
    {
        if ($autorArray['id'] == null) {
            $this->insertBdd($autorArray);
        } else {
            $this->update($autorArray);
        }
    }

    public function update($autorArray)
    {

        $bdd = $this->getBdd();

        $id = (int)$autorArray['id'];
        $lastName = strtoupper($autorArray['lastName']);
        $firstName = ucfirst(strtolower($autorArray['firstName']));
        $roleAdmin = strtoupper($autorArray['roleAdmin']);

        $query = "UPDATE autor SET pseudo = :pseudo, email = :email, last_name = :lastName, first_name = :firstName, role_admin = :roleAdmin ";
        if ($autorArray['pwd']) $query .= ", pwd = :pwd";
        $query .= " WHERE id = :id";

        $req = $bdd->prepare($query);
        $req->bindValue('pseudo', $autorArray['pseudo'], PDO::PARAM_STR);
        $req->bindValue('email', $autorArray['email'], PDO::PARAM_STR);
        $req->bindValue('lastName', $lastName, PDO::PARAM_STR);
        $req->bindValue('firstName', $firstName, PDO::PARAM_STR);
        if ($autorArray['pwd']) {
            $req->bindValue('pwd', password_hash($autorArray['pwd'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        }
        $req->bindValue('roleAdmin', $roleAdmin, PDO::PARAM_STR);
        $req->bindValue('id', $id, PDO::PARAM_INT);
        $req->execute();
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
