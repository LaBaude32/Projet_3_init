<?php ob_start(); ?>

<div class="col-lg-12">
    <div class="jumbotron">
        <h1>Billet simple pour l'Alaska</h1>
        <h2>Gestion des auteurs</h2>
    </div>
    <p>Liste des auteurs :</p>
    <div class="list-group">
        <?php foreach ($autors as $autor) : ?>
            <div class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <small><?= $autor->getRole(); ?></small>
                </div>
                <div class="d-flex w-100 justify-content-between mt-3">
                    <p class="mb-1"><?= $autor->getPseudo(); ?></p>
                    <div>
                        <a href="index.php?id=<?= $autor->getId(); ?>&amp;action=displayAutor" class="justify-content-end btn btn-info">Voir</a>
                        <a href="index.php?id=<?= $autor->getId(); ?>&amp;action=editAutor" class="justify-content-end btn btn-warning">Modifier</a>
                        <a href="index.php?id=<?= $autor->getId(); ?>&amp;action=deleteAutor" class="justify-content-end btn btn-danger">Supprimer</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(VIEW . 'backend/gabaritback.php'); ?>