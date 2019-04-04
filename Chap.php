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
// Récupération de la db CHAP avec l'ID
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=projet3;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->query('SELECT ID, TitreChap, DatePublication, content, DAY(DatePublication) AS jour, MONTH(DatePublication) AS mois, YEAR(DatePublication) AS annee FROM post ORDER BY DateCreation');

If (isset($_GET['id'])){

    $reqComments = $bdd->prepare('SELECT c.content contenu_comment, c.DatePubliComment DatePubliComment, c.Pseudo Pseudo
        FROM post p
        INNER JOIN comments c
        ON c.postID = p.ID
        WHERE p.ID = ? AND Report = 1
        ORDER BY c.DatePubliComment DESC');
    $reqComments->execute(array($_GET['id']));
    }

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
                    <div class="jumbotron">
                        <h1>Billet simple pour l'Alaska</h1>
                        <?php 
                        while ($donnees = $req->fetch()) { 
                            if ($donnees['ID'] == $_GET['id']) { ?>
                                <h2>Chapitre <?php echo htmlspecialchars($donnees['TitreChap']); ?></h2>
                    </div>
                    <p>
                        <?php echo htmlspecialchars($donnees['content']); ?>
                    </p>
                    <blockquote class="blockquote">
                        <footer class="blockquote-footer font-italic">Publié le <?php echo htmlspecialchars($donnees['jour']). ' / ' . htmlspecialchars($donnees['mois']). ' / ' . htmlspecialchars($donnees['annee']); ?></footer>
                    </blockquote>
                        <?php 
                        }
                    }
                    $req->closeCursor(); ?>

                    <p class="display-4">Commentaires :</p>
                    <button type="button" class="btn btn-primary"> Ajouter un commentaire</button>
                    <form method="post" action="add_comments.php?id=<?= $donnees['ID'] ?>">
                        <p>Ajouter un commentaire :</p>
                        <div class="form-group">
                            <input class="form-control form-control-lg" id="Pseudo" type="text" placeholder="Pseudo">
                        <div class="form-group">
                        </div>
                            <label for="exampleFormControlTextarea1">Votre commentaire :</label>
                            <textarea class="form-control" id="Comments_content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>

                    <div class="mt-5">
                        <?php
                        //affichage des commentaires
                        while ($donnees = $reqComments->fetch()) { ?>
                            <div class="list-group">
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 text-right">
                                        <small><?php echo $donnees['DatePubliComment'] ?></small>
                                    </div>
                                    <p class="mb-1"><?php echo $donnees['contenu_comment'] ?></p>
                                    <small><?php echo $donnees['Pseudo'] ?></small>
                                </div>
                            </div>
                            <?php
                        }
                        $reqComments->closeCursor();
                        ?>
                    </div>  
                </div>
            </div>
        </div>
    </body>
</html>