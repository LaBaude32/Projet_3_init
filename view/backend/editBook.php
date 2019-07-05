<?php ob_start(); ?>

<div class="col-lg-12">
    <div class="jumbotron">
        <h1>Billet simple pour l'Alaska</h1>
        <h2>Modifier le livre</h2>
    </div>

    <form method="post" action="index.php?action=updateBook">
        <input type="hidden" class="form-control" name="id" value="<?= $book->getId(); ?>">
        <div class="form-group">
            <label for="exampleInputTitle1">Titre du livre</label>
            <p><input class="form-control" type="text" name="title" placeholder="Titre du livre" value="<?= $book->getTitle(); ?>" /></p>
        </div>
        <div class="form-group">
            <label for="exampleInputArea1">Résumé du livre</label>
            <textarea name="content"><?= $book->getContent(); ?></textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
    </form>
    <a class="btn btn-primary mt-3" href="index.php?action=admin" role="button">Retour</a>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(VIEW . 'backend/gabaritBack.php'); ?>