<?php
class CommentsManager extends BddManager
{
	public function findAll()
	{
		$comments = array();
		$bdd = $this->getBdd();

		$query = 'SELECT * FROM comments';

		/*
		$query = "SELECT c.*, p.* as chap_title
		FROM comments c
		INNER JOIN post p ON c.post_id = p.id
		WHERE c.post_id = 1";*/


		$req = $bdd->query($query);
		$req->execute();
		while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

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
		$bdd = $this->getBdd();

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
		$toReturn = array();
		$comments = $this->findAll();

		foreach ($comments as $comment) {
			if ($comment->getPostId() == $ID && $comment->getReport() == 0) {
				$toReturn[] = $comment;
			}
		}
		return array_reverse($toReturn); //pour les mettre dans l'ordre décroissant
	}

	public function returnCommentsToValidate()
	{
		$comments = $this->findAll();

		foreach ($comments as $comment) {
			if ($comment->getReport() == 1) {
				$toReturn[] = $comment;
			}
		}
		return array_reverse($toReturn); //pour les mettre dans l'ordre d?Šcroissant
	}

	public function addComment($pseudo, $content, $postID)
	{
		$bdd = $this->getBdd();
		$req = $bdd->prepare('INSERT INTO comments(post_id, pseudo, content, report, published_at) VALUES(:PostId, :Pseudo, :Content, 0, NOW())');
		$req->bindValue('PostId', $_POST['PostID'], PDO::PARAM_INT);
		$req->bindValue('Pseudo', $_POST['Pseudo'], PDO::PARAM_STR);
		$req->bindValue('Content', $_POST['Comments_content'], PDO::PARAM_STR);

		$req->execute();
	}

	public function validateComment($id)
	{
		$id = (int)$id;
		$bdd = $this->getBdd();
		$req = $bdd->prepare('UPDATE comments SET report = :report WHERE id= :id');
		$req->bindValue('report', 0, PDO::PARAM_INT);
		$req->bindValue('id', $id, PDO::PARAM_INT);

		$req->execute();
	}

	public function deleteComment($id)
	{
		$id = (int)$id;
		$bdd = $this->getBdd();
		$req = $bdd->prepare('DELETE FROM comments WHERE id= :id');
		$req->bindValue('id', $id, PDO::PARAM_INT);

		$req->execute();
	}

	public function reportComment($id)
	{
		$id = (int)$id;
		$bdd = $this->getBdd();
		$req = $bdd->prepare('UPDATE comments SET report = :report WHERE id= :id');
		$req->bindValue('report', 1, PDO::PARAM_INT);
		$req->bindValue('id', $id, PDO::PARAM_INT);

		$req->execute();
	}
}
