<?php

$mesArticles = mesArticles($_SESSION["idUser"]);
if (isset($_SESSION["flash"])) {
    $flash =  $_SESSION["flash"];
    unset($_SESSION["flash"]);
}
if (isset($flash)) : ?>
    <p class="flash"><?php echo $flash ?></p>
<?php endif; ?>

<?php if (!$mesArticles) : ?>
    <div class="nolike">
        <h1>Vous n'avez aucun article</h1>
        <a href="/Projet-Blog-Voyage/Pages/AjoutArticle.php">Creer votre article ici !</a>
    </div>
<?php else : ?>
    <h1>Mes articles</h1>
<?php endif; ?>

<div class="container">
    <?php
    foreach ($mesArticles as $monArticle) :
    ?>
        <?php
        $userUsername = infoUsers($monArticle["idUser"]);
        $nblike = nbLike($monArticle["idArticle"]);
        ?>

        <div class="Resume-cards">
            <span class="pseudo"><?php echo $userUsername["username"] ?></span>
            <span class="paysFav"><?php echo $monArticle["nomPays"] ?></span>
            <a class="photo" href="/Projet-Blog-Voyage/Pages/detailsArticle.php?idArticle=<?php echo $monArticle["idArticle"] ?>"><img src=<?php echo $monArticle["photoResume"] ?>></a>
            <span class="resume"><?php echo $monArticle["texteResume"] ?></span>
            <a class="like" href="/Projet-Blog-Voyage/template/mesLikes/like_controller.php?idUser=<?php echo $_SESSION["idUser"] ?>&idArticle=<?php echo $monArticle["idArticle"] ?>">
                <i class="<?php
                            $like = verifyLike($_SESSION["idUser"], $monArticle["idArticle"]);
                            if ($like) {
                                echo "fa-solid";
                            }
                            if (!$like) {
                                echo "fa-regular";
                            }
                            ?> fa-heart fa-2x"></i><span class="nbLike"><?php echo $nblike["COUNT(*)"] . " Likes" ?></span></a>
        </div>
        <div class="modif">
            <a href="/Projet-Blog-Voyage/Pages/gestionArticle/updateArticle.php?idArticle=<?php echo $monArticle['idArticle'] ?>">Editer mon message</a>
            <a href="/Projet-Blog-Voyage/Pages/gestionArticle/deleteArticle.php?idArticle=<?php echo $monArticle['idArticle'] ?>">Supprimer mon message</a>
        </div>
    <?php endforeach; ?>
</div>