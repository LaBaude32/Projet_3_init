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
    <form method="post" action="add_comments.php">
        <p>Ajouter un commentaire :</p>
        <div class="form-group">
            <input class="form-control form-control-lg" name="Pseudo" type="text" placeholder="Pseudo">
        <div class="form-group">
        </div>
            <label for="exampleFormControlTextarea1">Votre commentaire :</label>
            <textarea class="form-control" name="Comments_content" rows="3"></textarea>
        </div>
        <input type="hidden" name="PostID" value="<?= $ID ?>" />
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