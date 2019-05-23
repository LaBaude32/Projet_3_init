
<?php ob_start(); ?>
<div class="col-lg-12">
    <div class="jumbotron">
        <h1>Billet simple pour l'Alaska</h1>
        <h2>Création d'un nouveau chapitre</h2>
    </div>

    <form method="post" action="index.php?action=saveNewDraft">
        <div class="form-group">
            <p><input class="form-control" type="text" name="title" placeholder="Titre du chapitre"/></p>
        </div>
            <textarea name="content"></textarea>
        <div class="form-group mt-3 ml-4">
            <input class="form-check-input" type="radio" name="isDraft" value="1" id="true" />
            <label class="form-check-label" for="true">Enregistrer en brouillon</label><br />
            <input class="form-check-input" type="radio" name="isDraft" value="0" id="false" />
            <label class="form-check-label" for="false">Publier directement</label><br />
        </div>
        <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(VIEW.'backend/gabaritBack.php'); ?>