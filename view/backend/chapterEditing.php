<?php ob_start(); ?>
<div class="col-lg-12">
    <div class="jumbotron">
        <h1>Billet simple pour l'Alaska</h1>
        <h2>Chapitre <?= $post->getTitle(); ?></h2>
    </div>

    <form method="post" action="index.php?id=<?=$post->getId();?>&amp;action=saveDraft">
            <textarea name="postContent">
                <p> <?= $post->getContent(); ?> </p>
            </textarea>
        <button type="submit" class="btn btn-success mt-3">Enregistrer le brouillon</button>
        <blockquote class="blockquote mt-3">
            <footer class="blockquote-footer font-italic">Créé le <?= $post->getCreatedAt()->format('d \/ m \/ Y'); ?></footer>
        </blockquote>
    </form>
    <a class="btn btn-info" href="index.php?action=admin" role="button">Retour a l'administration</a>
    <a class="btn btn-warning" href="index.php?id=<?=$post->getId();?>&amp;action=publishChapter" role="button">Publier le chapitre</a>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(VIEW.'gabarit.php'); ?>