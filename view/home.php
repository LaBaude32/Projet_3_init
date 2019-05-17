<?php ob_start(); ?>

<div class="col-lg-12">
    <div class="jumbotron">
        <h1>Billet simple pour l'Alaska</h1>
        <h2> Par Jean Forteroche</h2>
    </div>
    <p>Les chapitres de mon livre :</p>
    <div class="list-group">
    <?php foreach ($posts as $post):?>
        <a href="index.php?id=<?= $post->getId();?>&amp;action=chapter" class="list-group-item list-group-item-action">
            <?= $post->getTitle() . ' - publié le ' . $post->getPublishedAt()->format('d \/ m \/ Y'); ?>
        </a>
    <?php endforeach;?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include('gabarit.php'); ?>