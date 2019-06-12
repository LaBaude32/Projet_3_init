<?php ob_start(); ?>

<div class="col-lg-12">
    <div class="jumbotron">
        <h1>Billet simple pour l'Alaska</h1>
        <h2> Par Jean Forteroche</h2>
    </div>
    <div>
        <img src="<?= HOST ?>public/pics/chiens de traineau en Alaska.jpg" class="img-fluid" alt="Responsive image">
    </div>
    <div class="col-12 p-5">
        <h3>Résumé du livre :</h3>
        <p class="text-justify mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit nostrum, obcaecati vitae, corporis quaerat officia minima magni maxime magnam ab sunt dolorem, libero nisi soluta adipisci sint officiis laborum architecto qui eaque consequatur expedita nam consequuntur ratione? Itaque excepturi illo laborum. Incidunt veniam ea corrupti delectus, eius perferendis eaque dignissimos laudantium ab cupiditate dolores alias excepturi. Sapiente corrupti quos, laudantium cum error repudiandae animi reiciendis alias quisquam corporis numquam asperiores ipsa nam, ea dolorem aspernatur est, dolorum incidunt nesciunt libero perferendis aperiam saepe quam aut. Doloribus, suscipit. Quibusdam magnam veritatis repellat nam quae provident in eum obcaecati laborum. Debitis distinctio sunt perspiciatis minus, aliquam doloribus alias ducimus! Sit modi sint iure quos dicta! Sunt perspiciatis tenetur, amet ea deleniti dicta velit nemo esse porro quasi beatae dignissimos necessitatibus blanditiis voluptatum fuga sequi accusamus architecto nam nobis eum repudiandae ducimus dolorum? Eos cupiditate officiis id dolorem ipsa debitis est, sed nesciunt cumque, eaque repudiandae in, numquam facere dolor deserunt provident iste. Suscipit repellat amet quis illum, consectetur similique a laudantium rem obcaecati consequatur vel minus dolorem, saepe, nihil ab debitis quisquam alias vero modi? Dolorum veniam repellendus doloremque quae earum ipsum aliquam rem! Deleniti pariatur, fugit incidunt architecto ea aperiam atque?</p>
    </div>
    <h3>Les chapitres :</h3>
    <div class="list-group mt-4">
        <?php foreach ($posts as $post) : ?>
            <a href="index.php?id=<?= $post->getId(); ?>&amp;action=chapter" class="list-group-item list-group-item-action">
                <?= $post->getTitle() . ' - publiÃ© le ' . $post->getPublishedAt()->format('d \/ m \/ Y'); ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(VIEW . 'gabarit.php'); ?>