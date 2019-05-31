<?php ob_start(); ?>

<div class="col-lg-12">
    <div class="jumbotron">
        <h1>Billet simple pour l'Alaska</h1>
    </div>
    <p>Vous ne disposez pas des droits pour acceder à cette page.</p>
    <a href="index.php" class="btn btn-primary">retour à l'accueil</a>
    <a href="index.php?action=connectionFrom" class="btn btn-primary">Connection � l'adminstration</a>
</div>

<?php $content = ob_get_clean(); ?>
<?php include('gabarit.php'); ?>