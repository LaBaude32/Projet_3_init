<?php ob_start(); ?>

<div class="col-lg-12">
    <h1>Billet simple pour l'Alaska</h1>
    <h2> Par Jean Forteroche</h2>
    <p>Les chapitres de mon livre :</p>
    <div class="list-group">
    <?php foreach ($posts as $post):?>
        <a href="index.php?id=<?= $post['ID'];?>&amp;action=chapter" class="list-group-item list-group-item-action">
            <?= $post['TitreChap'] . ' - publié le ' . $post['jour']. ' / ' . $post['mois']. ' / ' . $post['annee']; ?>    
        </a> 
    <?php endforeach;?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include('gabarit.php'); ?>