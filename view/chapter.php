<?php ob_start(); ?>
<div class="col-lg-12">
        <div class="jumbotron">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Chapitre <?= $posts[$ID]->getTitle(); ?></h2>
        </div>
        <p> <?= $posts[$ID]->getContent(); ?> </p>
        <blockquote class="blockquote">
            <footer class="blockquote-footer font-italic">Publié le <?= $posts[$ID]->getPublishedAt()->format('d \/ m \/ Y'); ?></footer>
        </blockquote>

    <a class="btn btn-info" href="index.php" role="button">Retour au sommaire</a>

    <p class="display-4">Commentaires :</p>
    <button type="button" class="btn btn-secondary"> Ajouter un commentaire</button>
    <form method="post" action="index.php?action=commentAdded">
        <p>Ajouter un commentaire :</p>
        <div class="form-group">
            <input class="form-control form-control-lg" name="Pseudo" type="text" placeholder="Pseudo">
        <div class="form-group">
        </div>
            <label for="exampleFormControlTextarea1">Votre commentaire :</label>
            <textarea class="form-control" name="Comments_content" rows="3"></textarea>
        </div>
        <input type="hidden" name="PostID" value="<?= $ID ?>" />
        <button type="submit" class="btn btn-secondary">Envoyer</button>
    </form>

    <div class="mt-5">
        <!-- affichage des commentaires -->
        <div class="list-group">
        <?php foreach ($comments as $comment):?>
            <div class="list-group-item list-group-item-action">
                <div class="d-flex w-100 text-right">
                    <small><?= $comment['DatePubliComment'] ?></small>
                </div>
                <p class="mb-1"><?= $comment['contenu_comment'] ?></p>
                <small><?= $comment['Pseudo'] ?></small>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include('gabarit.php'); ?>