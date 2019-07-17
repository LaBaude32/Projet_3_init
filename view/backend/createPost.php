<?php ob_start(); ?>
<div class="col-lg-12">
    <div class="jumbotron">
        <h1>Billet simple pour l'Alaska</h1>
        <h2>Edition de chapitre</h2>
    </div>
    <form method="post" action="index.php?action=savePost">
        <input type="hidden" name="id" value="<?= $post->getId(); ?>">
        <div class="form-group">
            <p><input class="form-control" type="text" name="title" placeholder="Titre du chapitre" value="<?= $post->getTitle(); ?>" /></p>
        </div>
        <textarea name="content"><?= $post->getContent(); ?></textarea>
        <div class="form-group mt-3 ml-4">
            <input class="form-check-input" type="radio" name="isDraft" value="1" id="true" <?= $post->showCheckedValue('1'); ?> />
            <label class="form-check-label" for="true">Enregistrer en brouillon</label><br />
            <input class="form-check-input" type="radio" name="isDraft" value="0" id="false" <?= $post->showCheckedValue('0'); ?> />
            <label class="form-check-label" for="false">Publier</label><br />
        </div>
        <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(VIEW . 'backend/gabaritBack.php'); ?>