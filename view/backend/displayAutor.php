<?php ob_start(); ?>
<div class="col-lg-12">
    <div class="jumbotron">
        <h1>Billet simple pour l'Alaska</h1>
        <h2><?= $autor->getPseudo(); ?></h2>
    </div>
    <table class="table">
        <tr>
            <th scope="row">Pseudo</th>
            <td><?= $autor->getPseudo(); ?></td>
        </tr>
        <tr>
            <th scope="row">Nom</th>
            <td><?= $autor->getFullName(); ?></td>
        </tr>
        <tr>
            <th scope="row">Email</th>
            <td><?= $autor->getEmail(); ?></td>
        </tr>
        <tr>
            <th scope="row">Role</th>
            <td><?= $autor->getRoleAdmin(); ?></td>
        </tr>
    </table>
    <a class="btn btn-info" href="index.php?id=<?= $autor->getId(); ?>&amp;action=editAutor" role="button">modifier</a>
    <a class="btn btn-info" href="index.php?action=managerAutors" role="button">Retour à la liste</a>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(VIEW . 'backend/gabaritback.php'); ?>