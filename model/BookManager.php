<?php
class BookManager extends BddManager
{
    public function findOneById($id)
    {
        $bdd = $this->getBdd();

		$query = 'SELECT * FROM book WHERE id=' . $id;

		$req = $bdd->query($query);
		$req->execute();
		$row = $req->fetch(PDO::FETCH_ASSOC);
		$book = new Book();
		$book->hydrate($row);
		return $book;
    }
}
