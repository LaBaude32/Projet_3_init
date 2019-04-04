<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=projet3;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

if (isset($_POST['PostID']) && $_POST['PostID'] > 0 && isset($_POST['Pseudo']) && isset($_POST['Comments_content'])) {

$req = $bdd->prepare('INSERT INTO comments(PostID, Pseudo, Content, Report, DatePubliComment) VALUES(:PostID, :Pseudo, :Content, :Report, NOW())');
$req->execute(array(
	'PostID' => $_POST['PostID'],
	'Pseudo' => $_POST['Pseudo'],
	'Content' => $_POST['Comments_content'],
	'Report' => 0,
	));

echo 'Le commentaire à été soumis !';
}

?>