<?php ob_start(); ?>

<div class="col-lg-12">
    <div class="jumbotron">
        <h1>Billet simple pour l'Alaska</h1>
        <h2>Creation d'un administrateur</h2>
    </div>
    <?php if ($_GET['action'] == 'createAutor') {
        $action = 'createAutor';
    } else {
        $action = 'updateAutor';
    }
    ?>
    <form method="post" action="index.php?action=<?= $action ?>">
        <div class="form-group">
            <label for="exampleInputEmail1">Adresse Email</label>
            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Entrez votre email" value="<?= $autor->getEmail(); ?>">
            <small id="emailHelp" class="form-text text-muted">Nous ne partageons pas votre email.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe</label>
            <input type="password" class="form-control" name="pwd" placeholder="Mot de passe">
        </div>
        <div class="form-group">
            <label for="exampleInputText1">Nom</label>
            <input class="form-control" type="text" name="lastName" placeholder="Nom" value="<?= $autor->getLastName(); ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputText1">Prénom</label>
            <input class="form-control" type="text" name="firstName" placeholder="Prénom" value="<?= $autor->getFirstName(); ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputText1">Pseudo</label>
            <input class="form-control" type="text" name="pseudo" placeholder="Pseudo" value="<?= $autor->getPseudo(); ?>">
        </div>
        <p>Quel rôle souhaitez-vous donner au nouvel administrateur ?</p>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="Admin" <?php if ($autor->getRole() == "ADMIN") {
                                                                                        echo "checked";
                                                                                    } ?>>
            <label class="form-check-label" for="exampleRadios1">
                Administrateur
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role"" value=" Manager" <?php if ($autor->getRole() == 'MANAGER') {
                                                                                            echo "checked";
                                                                                        } ?>>
            <label class="form-check-label" for="exampleRadios2">
                Manager
            </label>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Créer</button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(VIEW . 'backend/gabaritBack.php'); ?>