<?php
class PostManager extends BddManager
{
	public function findAll()
	{
		$posts = array();
		$bdd = $this->getBdd();

		$query = 'SELECT * FROM post';

		$req = $bdd->query($query);
		$req->execute();
		while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
			$post = new Post();
			$post->hydrate($row);

			$posts[] = $post; //tableau d'objets
		}
		return $posts;
	}

	public function findPublished()
	{
		$posts = array();
		$bdd = $this->getBdd();

		$query = 'SELECT * FROM post WHERE is_draft=0';

		$req = $bdd->query($query);
		$req->execute();
		while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
			$post = new Post();
			$post->hydrate($row);

			$posts[] = $post; //tableau d'objets
		}
		return $posts;
	}

	public function findOneById($id)
	{
		$bdd = $this->getBdd();

		$query = 'SELECT * FROM post WHERE id=' . $id;

		$req = $bdd->query($query);
		$req->execute();
		$row = $req->fetch(PDO::FETCH_ASSOC);
		$post = new Post();
		$post->hydrate($row);
		return $post;
	}

	public function findDrafts()
	{
		$posts = array();
		$bdd = $this->getBdd();

		$query = 'SELECT * FROM post WHERE is_draft=1';

		$req = $bdd->query($query);
		$req->execute();
		while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
			$post = new Post();
			$post->hydrate($row);

			$posts[] = $post; //tableau d'objets
		}
		return $posts;
	}

	public function save($postArray)
	{
		if ($postArray['id'] == null) {
			$this->insertBdd($postArray);
		} else {
			$this->update($postArray);
		}
	}

	public function update($postArray)
	{
		$id = (int)$postArray['id'];
		$isDraft = (int)$postArray['isDraft'];

		$bdd = $this->getBdd();
		if (!$isDraft) {
			$query = "UPDATE post SET autor_id = :autorId, title = :title, is_draft = :isDraft, content = :content, saved_at = NOW(), published_at = NOW() WHERE id= :id";
		} else {
			$query = "UPDATE post SET autor_id = :autorId, title = :title, is_draft = :isDraft, content = :content, saved_at = NOW() WHERE id= :id";
		}
		$req = $bdd->prepare($query);
		$req->bindValue('autorId', $postArray['autorId'], PDO::PARAM_INT);
		$req->bindValue('title', $postArray['title'], PDO::PARAM_STR);
		$req->bindValue('content', $postArray['content'], PDO::PARAM_STR);
		$req->bindValue('isDraft', $isDraft, PDO::PARAM_BOOL);
		$req->bindValue('id', $id, PDO::PARAM_INT);

		$req->execute();
	}

	public function insertBdd($postArray)
	{
		$isDraft = (int)$postArray['isDraft'];

		$bdd = $this->getBdd();
		if (!$isDraft) {
			$query = "INSERT INTO post(autor_id, title, content, created_at, saved_at, is_draft, published_at) VALUES(:autorId, :title, :content, NOW(), NOW(), :isDraft, NOW())";
		} else {
			$query = "INSERT INTO post(autor_id, title, content, created_at, saved_at, is_draft) VALUES(:autorId, :title, :content, NOW(), NOW(), :isDraft)";
		}
		$req = $bdd->prepare($query);
		$req->bindValue('autorId', $postArray['autorId'], PDO::PARAM_INT);
		$req->bindValue('title', $postArray['title'], PDO::PARAM_STR);
		$req->bindValue('content', $postArray['content'], PDO::PARAM_STR);
		$req->bindValue('isDraft', $isDraft, PDO::PARAM_BOOL);

		$req->execute();
	}

	public function delete($id)
	{
		$id = (int)$id;
		$bdd = $this->getBdd();
		$req = $bdd->prepare('DELETE FROM post WHERE id= :id');
		$req->bindValue('id', $id, PDO::PARAM_INT);

		$req->execute();
	}
}
