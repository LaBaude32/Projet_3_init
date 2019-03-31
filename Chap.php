<?php
// Récupération de l'ID
try
{
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $ID = $_GET['id'];
    }
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
// Récupération de la db avec l'ID
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=projet3;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->query('SELECT ID, TitreChap, DatePublication, content, DAY(DatePublication) AS jour, MONTH(DatePublication) AS mois, YEAR(DatePublication) AS annee FROM post ORDER BY DateCreation');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Blog de Jean Forteroche</title>
        <link href="Style/style.css" rel="stylesheet" /> 
        <link href="public/style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Billet simple pour l'Alaska</h1>
                    <?php 
                    while ($donnees = $req->fetch()) { 
                        if ($donnees['ID'] == $_GET['id']) { ?>
                            <h2>Chapitre <?php echo htmlspecialchars($donnees['TitreChap']); ?></h2>
                            <p>
                                <?php echo htmlspecialchars($donnees['content']); ?>
                            </p>
                            <blockquote class="blockquote">
                                <footer class="blockquote-footer">Publié le <?php echo htmlspecialchars($donnees['jour']). ' / ' . htmlspecialchars($donnees['mois']). ' / ' . htmlspecialchars($donnees['annee']); ?></footer>
                            </blockquote>
                        <?php 
                        }
                    }
                    $req->closeCursor();
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>