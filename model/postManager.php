<?php
function getPosts() {

	try
	{
	    $bdd = new PDO('mysql:host=localhost;dbname=projet3;charset=utf8', 'root', '');
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	}

	$req = $bdd->query('SELECT ID, TitreChap, DatePublication, DAY(DatePublication) AS jour, MONTH(DatePublication) AS mois, YEAR(DatePublication) AS annee FROM post ORDER BY DateCreation');

	while($row = $req->fetch()){
		$posts[] = $row;
	}

	return $posts;
}


