<?php ob_start(); ?>
<div class="col-lg-12">
        <div class="jumbotron">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Chapitre <?= $post->getTitle(); ?></h2>
        </div>
        <p> <?= $post->getContent(); ?> </p>
        <blockquote class="blockquote">
            <footer class="blockquote-footer font-italic">Créé le <?= $post->getCreatedAt()->format('d \/ m \/ Y'); ?></footer>
        </blockquote>

    <a class="btn btn-info" href="index.php?action=admin" role="button">Retour a l'administration</a>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(VIEW.'gabarit.php'); ?>