<?php ob_start(); ?>

<div class="col-12">
    <div class="jumbotron">
        <p class="display-4">Le commentaire à été soumis !</p>
        <p class="lead">Merci !</p>
        <a class="btn btn-info" href="index.php" role="button">Retouner au sommaire</a>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include('gabarit.php'); ?>