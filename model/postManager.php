<?php
include_once('classBddManager.php');

class PostManager extends BddManager
{
	public function findAll()
	{
		$bdd = $this->getBdd();

		$query = 'SELECT * FROM post WHERE is_draft=0';

		$req = $bdd->query($query);
		$req->execute();
		while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
			$post = new Post();
			$post->hydrate($row);

			$posts[] = $post; //tableau d'objets

		}
		//echo "<pre>"; var_dump($posts); die;
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
		$bdd = $this->getBdd();

		$query = 'SELECT * FROM post WHERE is_draft=1';

		$req = $bdd->query($query);
		$req->execute();
		while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
			$post = new Post();
			$post->hydrate($row);

			$posts[] = $post; //tableau d'objets
		}
		//echo "<pre>"; var_dump($posts); die;
		return $posts;
	}

	public function publishChapter($id)
	{
		$id = (int)$id;
		//var_dump($id); die;
		$bdd =$this->getBdd();
		$req = $bdd->prepare('UPDATE post SET is_draft = :isDraft WHERE id= :id');
		$req->bindValue('isDraft', 0, PDO::PARAM_INT);
		$req->bindValue('id', $id, PDO::PARAM_INT);

		$req->execute();
	}

	public function saveDraft($id, $content)
	{
		$id = (int)$id;
		//var_dump($id); die;
		$bdd =$this->getBdd();
		$req = $bdd->prepare('UPDATE post SET content = :content, saved_at = NOW() WHERE id= :id');
		$req->bindValue('content', $content, PDO::PARAM_STR);
		$req->bindValue('id', $id, PDO::PARAM_STR);

		$req->execute();
	}
}