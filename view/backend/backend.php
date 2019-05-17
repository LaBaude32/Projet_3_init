<?php ob_start(); ?>

<div class="col-lg-12">
    <div class="jumbotron">
        <h1>Administration</h1>
        <h2>Billet simple pour l'Alsaka</h2>
    </div>
    <!-- Commentaires -->
    <h3 class="p-5">Les commentaires à valider :</h3>
    <div class="list-group">
        <?php foreach ($comments as $comment):?>
            <div class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <small>Publié le <?= $comment->getPublishedAt()->format('d \/ m \/ Y'); ?></small>
                        <small>Par <?= $comment->getPseudo(); ?></small>
                    </div>
                    <div class="d-flex w-100 justify-content-between mt-3">
                        <p class="mb-1"><?= $comment->getContent(); ?></p>
                        <div>
                            <div class="justify-content-end btn btn-primary">Valider</div>
                            <div class="justify-content-end btn btn-primary">Supprimer</div>
                        </div>
                    </div>
            </div>
        <?php endforeach;?>
    </div>
    <!-- Brouillons -->
    <h3 class="p-5">Brouillons des chapitres en cours :</h3>
    <div class="list-group">
        <?php foreach ($drafts as $draft):?>
            <a href="index.php?id=<?= $draft->getId();?>&amp;action=chapter" class="list-group-item list-group-item-action">
                <?= $draft->getTitle() . ' - publié le ' . $draft->getPublishedAt()->format('d \/ m \/ Y'); ?>
            </a>
        <?php endforeach;?>
    </div>
    <!-- Chapitres déjà publiés -->
    <h3 class="p-5">Les chapitres du livre déjà publiés :</h3>
    <div class="list-group">
        <?php foreach ($posts as $post):?>
            <a href="index.php?id=<?= $post->getId();?>&amp;action=chapter" class="list-group-item list-group-item-action">
                <?= $post->getTitle() . ' - publié le ' . $post->getPublishedAt()->format('d \/ m \/ Y'); ?>
            </a>
        <?php endforeach;?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(VIEW.'gabarit.php'); ?>