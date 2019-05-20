<?php
include_once('classBddManager.php');
include_once('post.php');
include_once('comment.php');

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
}