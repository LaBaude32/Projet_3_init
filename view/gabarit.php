<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Blog de Jean Forteroche</title>
        <link href="public/style/style.css" rel="stylesheet" />
        <link href="public/style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
        <script>tinymce.init({selector:'textarea'});</script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <?= $content ;?>
            </div>
        </div>
    </body>
    <?php include("footer.php"); ?>
</html>