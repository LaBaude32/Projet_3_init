
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Blog de Jean Forteroche</title>
        <link href="Style/style.css" rel="stylesheet" /> 
        <link href="public/style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>

<?php
// Récupération des données
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=projet3;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->query('SELECT ID, TitreChap, DatePublication, DAY(DatePublication) AS jour, MONTH(DatePublication) AS mois, YEAR(DatePublication) AS annee FROM post ORDER BY DateCreation');
?>

        
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Billet simple pour l'Alaska</h1>
                    <h2> Par Jean Forteroche</h2>
                    <p>Les chapitres de mon livre :</p>
             
                    <?php
                    while ($donnees = $req->fetch())
                    {
                    ?>
                        <div class="list-group">
                                <a href="Chap.php?id=<?= $donnees['ID'] ?>" class="list-group-item list-group-item-action"><?php echo htmlspecialchars($donnees['TitreChap']) . ' - publié le ' . htmlspecialchars($donnees['jour']). ' / ' . htmlspecialchars($donnees['mois']). ' / ' . htmlspecialchars($donnees['annee']); ?></a>
                        </div>
                    <?php
                    }
                    $req->closeCursor();
                    ?>
                </div>
            </div>
        </div>
    </body>
    <?php include("footer.php"); ?>
</html>