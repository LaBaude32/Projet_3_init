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

	public function save($bookArray)
	{
		if ($bookArray['id'] == null) {
			$this->insertBdd($bookArray);
		} else {
			$this->update($bookArray);
		}
	}

	public function update($bookArray)
	{

		$bdd = $this->getBdd();

		$query = "UPDATE book SET title = :title, content = :content WHERE id= :id";

		$req = $bdd->prepare($query);
		$req->bindValue('title', $bookArray['title'], PDO::PARAM_STR);
		$req->bindValue('content', $bookArray['content'], PDO::PARAM_STR);
		$req->bindValue('id', $bookArray['id'], PDO::PARAM_INT);

		$req->execute();
	}
}
