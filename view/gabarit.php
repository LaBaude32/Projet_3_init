<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Blog de Jean Forteroche</title>
    <link href="<?= HOST; ?>public/style/style.css" rel="stylesheet" />
    <link href="<?= HOST; ?>public/style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <?= $content; ?>
        </div>
    </div>
</body>
<?php include(VIEW . "footer.php"); ?>

</html>