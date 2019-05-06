<?php ob_start(); ?>

<div class="col-lg-12">
    <div class="jumbotron">
        <h1>Administration</h1>
        <h2>Billet simple pour l'Alsaka'</h2>
    </div>
    <!-- Commentaires -->
    <p>Les commentaires à valider :</p>
    <div class="list-group">
        <?php foreach ($comments as $comment):?>
            <div class="list-group-item list-group-item-action">
                <div class="d-flex w-100 text-right">
                    <small>Publié le <?= $comment->getPublishedAt()->format('d \/ m \/ Y'); ?></small>
                </div>
                <p class="mb-1"><?= $comment->getContent(); ?></p>
                <small><?= $comment->getPseudo(); ?></small>
            </div>
        <?php endforeach;?>
    </div>
    <!-- Brouillons -->
    <p>Brouillons des chapitres en cours :</p>
    <div class="list-group">
        <?php foreach ($drafts as $draft):?>
            <a href="index.php?id=<?= $draft->getId();?>&amp;action=chapter" class="list-group-item list-group-item-action">
                <?= $draft->getTitle() . ' - publié le ' . $draft->getPublishedAt()->format('d \/ m \/ Y'); ?>
            </a>
        <?php endforeach;?>
    </div>
    <!-- Chapitres déjà publiés -->
    <p>Les chapitres du livre déjà publiés :</p>
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