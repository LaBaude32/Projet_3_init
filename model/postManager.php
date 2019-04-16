<?php

function dbConnect(){
	try
	{
	    $bdd = new PDO('mysql:host=localhost;dbname=projet3;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	}
	return $bdd;
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