<?php
class CommentsManager extends BddManager
{
	public function findAll()
	{
		$bdd =$this->getBdd();

		$query = 'SELECT * FROM comments';

		/*
		$query = "SELECT c.*, p.* as chap_title
		FROM comments c
		INNER JOIN post p ON c.post_id = p.id
		WHERE c.post_id = 1";*/


		$req = $bdd->query($query);
		$req->execute();
		while ($row = $req->fetch(PDO::FETCH_ASSOC)) {¨

// object POST

			$comment = new Comment();
			$comment->hydrate($row);

			//$comment->setPOst($post);

			$comments[] = $comment;

		}
		return $comments;
	}

	public function findByPostId($ID)
	{
		$bdd =$this->getBdd();

		$query = 'SELECT * FROM comments';

		$req = $bdd->query($query);
		$req->execute();
		while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
			$comment = new Comment();
			$comment->hydrate($row);

			$comments[] = $comment;

		}
		return $comments;
	}

	public function returnComments($ID)
	{
		$CommentsManager = new CommentsManager();
		$comments = $CommentsManager->findAll();

		foreach ($comments as $comment) {
			if ($comment->getPostId() == $ID && $comment->getReport() == 1 ){
				$toReturn[] = $comment;
			}
		}
		return array_reverse($toReturn); //pour les mettre dans l'ordre décroissant
	}

	public function addComment($pseudo, $content, $postID)
	{
		$bdd =$this->getBdd();
		$req = $bdd->prepare('INSERT INTO comments(post_id, pseudo, content, report, published_at) VALUES(:PostId, :Pseudo, :Content, 0, NOW())');
		$req->bindValue('PostId', $_POST['PostID'], PDO::PARAM_INT);
		$req->bindValue('Pseudo', $_POST['Pseudo'], PDO::PARAM_STR);
		$req->bindValue('Content', $_POST['Comments_content'], PDO::STR);

		$req->execute();
	}
}
