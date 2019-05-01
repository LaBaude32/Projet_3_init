<?php
include_once('classBddManager.php');
include_once('post.php');
include_once('comment.php');

class PostManager extends BddManager
{
	public function findAll()
	{
		$bdd = $this->getBdd();

		$query = 'SELECT * FROM post';

		$req = $bdd->query($query);
		$req->execute();
		while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
			$post = new Post();
			$post->hydrate($row);

			$posts[] = $post; //tableau d'objets

		}
		//echo "<pre>"; var_dump($posts[0]); die;
		return $posts;
	}
}

class CommentsManager extends BddManager
{
	public function findAll()
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
}

function addComment($pseudo, $content, $postID){
	$bdd = dbConnect();
	$req = $bdd->prepare('INSERT INTO comments(PostID, Pseudo, Content, Report, published_at) VALUES(:PostID, :Pseudo, :Content, :Report, NOW())');
	$req->execute(array(
		'PostID' => $_POST['PostID'],
		'Pseudo' => $_POST['Pseudo'],
		'Content' => $_POST['Comments_content'],
		'Report' => 0,
		));
}