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
}?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Commentaire ajouté</title>
	<link href="Style/style.css" rel="stylesheet" /> 
    <link href="public/style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="jumbotron">
					<p class="display-4">Le commentaire à été soumis !</p>
					<p class="lead">Merci !</p>
					<a class="btn btn-primary" href="Chap.php?id=<?= $_POST['PostID'] ?>" role="button">Retouner au chapitre</a>
			</div>
		</div>
	</div>
	
</body>
</html>