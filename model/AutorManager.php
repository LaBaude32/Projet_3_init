<?php

class AutorManager extends BddManager
{
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

    public function insertBdd($pseudo, $email, $lastName, $firstName, $pwd, $role) {

        $bdd = $this->getBdd();

        $lastName = strtoupper($lastName);
        $firstName = ucfirst(strtolower($firstName));
        $role = strtoupper($role);

        $query = "INSERT INTO autor pseudo = :pseudo, email = :email, last_name = :lastName, first_name = :firstName, role_admin = :roleAdmin, pwd = :pwd ";

        $req = $bdd->prepare($query);
        $req->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
        $req->bindValue('email', $email, PDO::PARAM_STR);
        $req->bindValue('lastName', $lastName, PDO::PARAM_STR);
        $req->bindValue('firstName', $firstName, PDO::PARAM_STR);
        $req->bindValue('pwd', password_hash($pwd, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $req->bindValue('roleAdmin', $role, PDO::PARAM_STR);
        $req->execute();
    }


    public function save($id, $pseudo, $email, $lastName, $firstName, $pwd, $role)
    {
        if($id == null) {
            $this->insertBdd($pseudo, $email, $lastName, $firstName, $pwd, $role);
        } else {
            $this->update($id, $pseudo, $email, $lastName, $firstName, $pwd, $role);
        }
    }

    public function update($id, $pseudo, $email, $lastName, $firstName, $pwd, $role)
    {

        $bdd = $this->getBdd();

        $id = (int)$id;
        $lastName = strtoupper($lastName);
        $firstName = ucfirst(strtolower($firstName));
        $role = strtoupper($role);

        $query = "UPDATE autor SET pseudo = :pseudo, email = :email, last_name = :lastName, first_name = :firstName, role_admin = :roleAdmin ";
        if($pwd) $query .= ", pwd = :pwd";
        $query .= " WHERE id = :id";

		$req = $bdd->prepare($query);
        $req->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
        $req->bindValue('email', $email, PDO::PARAM_STR);
        $req->bindValue('lastName', $lastName, PDO::PARAM_STR);
        $req->bindValue('firstName', $firstName, PDO::PARAM_STR);
        if($pwd) {
            $req->bindValue('pwd', password_hash($pwd, PASSWORD_DEFAULT), PDO::PARAM_STR);
        }
        $req->bindValue('roleAdmin', $role, PDO::PARAM_STR);
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
