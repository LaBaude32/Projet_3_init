<?php ob_start(); ?>
<div class="col-lg-12">
    <div class="jumbotron">
        <h1>Administration</h1>
        <h2>Billet simple pour l'Alsaka</h2>
    </div>
    <div>
        <a href="index.php?action=createDraft" class="justify-content-end btn btn-info">Créer un nouveau chapitre</a>
    </div>

    <!-- Commentaires -->
    <h3 class="p-5">Les commentaires à valider :</h3>
    <div class="list-group">
        <?php foreach ($comments as $comment) : ?>
            <div class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <small>Publié le <?= $comment->getPublishedAt()->format('d \/ m \/ Y'); ?></small>
                    <small>Par <?= $comment->getPseudo(); ?></small>
                </div>
                <div class="d-flex w-100 justify-content-between mt-3">
                    <p class="mb-1"><?= $comment->getContent(); ?></p>
                    <div>
                        <a href="index.php?id=<?= $comment->getId(); ?>&amp;action=validateComment" class="justify-content-end btn btn-success">Valider</a>
                        <a href="index.php?id=<?= $comment->getId(); ?>&amp;action=deleteComment" class="justify-content-end btn btn-danger">Supprimer</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Brouillons -->
    <h3 class="p-5">Brouillons des chapitres en cours :</h3>
    <div class="list-group">
        <?php if ($drafts) : ?>
            <?php foreach ($drafts as $draft) : ?>
                <div class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <p>Créé le <?= $draft->getcreatedAt()->format('d \/ m \/ Y'); ?> - Enregistré pour la dernière fois le <?= $draft->getsavedAt()->format('d \/ m \/ Y à H:i:s'); ?></p>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-1"><?= $draft->getTitle(); ?></p>
                        <div>
                            <a href="index.php?id=<?= $draft->getId(); ?>&amp;action=editChapter" class="justify-content-end btn btn-secondary">Modifier</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Pas de brouillons.</p>
        <?php endif; ?>
    </div>
    <!-- Chapitres déjà publiés -->
    <h3 class="p-5">Les chapitres du livre déjà publiés :</h3>
    <div class="list-group">
        <?php foreach ($posts as $post) : ?>
            <div class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <p>Publié le <?= $post->getPublishedAt()->format('d \/ m \/ Y à H:i:s'); ?></p>
                </div>
                <div class="d-flex w-100 justify-content-between">
                    <p class="mb-1"><?= $post->getTitle(); ?></p>
                    <div>
                        <a href="index.php?id=<?= $post->getId(); ?>&amp;action=chapter" class="justify-content-end btn btn-primary">Visualiser</a>
                        <a href="index.php?id=<?= $post->getId(); ?>&amp;action=editChapter" class="justify-content-end btn btn-warning">Modifier</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <h3 class="p5 mt-5">Gestion des auteurs</h3>
    <a href="index.php?action=managerAutors" class="btn btn-danger">Voir tout</a>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(VIEW . 'backend/gabaritBack.php'); ?>