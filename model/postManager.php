<?php
include_once('classBddManager.php');

class PostManager extends BddManager
{
	public function findAll()
	{
		$bdd = $this->bdd;

		$query = 'SELECT * FROM post';

		$req = $bdd->query($query);
		$req->execute();
		while ($row = $req->fetch(�PDO::FETCH_ASSOC)) {
			$post = new Post();

			$post->setId($row['ID']);
			$post->setIdAutor($row['Id_Autor']);
			$post->setTitreChapt($row['TitreChapt']);
			$post->setContent($row['Content']);
			$post->setDateCreation($row['DateCreation']);
			$post->setDatePublication($row['DatePublication']);
			$post->setIsDraft($row['IsDraft']);

			$posts[] = $post; //tableau d'objets

		}

		return $posts;
	}
}

function getPosts() {
	$bdd = dbConnect();
	$req = $bdd->query('SELECT ID, TitreChap, DatePublication, DAY(DatePublication) AS jour, MONTH(DatePublication) AS mois, YEAR(DatePublication) AS annee FROM post ORDER BY DateCreation');

	while($row = $req->fetch()){
		$posts[] = $row;
	}

	return $posts;
}

function getPost($ID) {
	$bdd = dbConnect();
	$req = $bdd->prepare('SELECT TitreChap, content, DatePublication, DAY(DatePublication) AS jour, MONTH(DatePublication) AS mois, YEAR(DatePublication) AS annee FROM post WHERE ID = ?');
    $req->execute(array($_GET['id']));

	while($row = $req->fetch()){
		$post[] = $row;
	}

	return $post;
}

function getComments($ID){
	// faire un requette préparée ici pour recuperer le chapitre
	$bdd = dbConnect();
	$reqComments = $bdd->prepare('SELECT c.content contenu_comment, c.DatePubliComment DatePubliComment, c.Pseudo Pseudo
    FROM post p
    INNER JOIN comments c
    ON c.postID = p.ID
    WHERE p.ID = ? AND Report = 1
    ORDER BY c.DatePubliComment DESC');
    $reqComments->execute(array($_GET['id']));

	while($row = $reqComments->fetch()){
		$comments[] = $row;
	}

	return $comments;

}

function addComment($pseudo, $content, $postID){
	$bdd = dbConnect();
	$req = $bdd->prepare('INSERT INTO comments(PostID, Pseudo, Content, Report, DatePubliComment) VALUES(:PostID, :Pseudo, :Content, :Report, NOW())');
	$req->execute(array(
		'PostID' => $_POST['PostID'],
		'Pseudo' => $_POST['Pseudo'],
		'Content' => $_POST['Comments_content'],
		'Report' => 0,
		));
}