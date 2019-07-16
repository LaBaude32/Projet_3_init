<?php ob_start(); ?>

<div class="col-lg-12">
    <div class="jumbotron">
        <h1><?= $book->getTitle(); ?></h1>
        <h2> Par Jean Forteroche</h2>
    </div>
    <div>
        <img src="<?= HOST ?>public/pics/chiens de traineau en Alaska.jpg" class="img-fluid" alt="Responsive image">
    </div>
    <div class="col-12 p-5">
        <h3>Résumé du livre :</h3>
        <span class="text-justify mt-4"><?= $book->getContent(); ?></span>
    </div>
    <h3>Les chapitres :</h3>
    <div class="list-group mt-4">
        <?php foreach ($posts as $post) : ?>
            <a href="index.php?id=<?= $post->getId(); ?>&amp;action=chapter" class="list-group-item list-group-item-action">
                <?= $post->getTitle() . ' - publié le ' . $post->getPublishedAt()->format('d \/ m \/ Y'); ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(VIEW . 'gabarit.php'); ?>