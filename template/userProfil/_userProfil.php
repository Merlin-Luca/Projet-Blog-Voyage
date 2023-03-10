<?php 
// require __DIR__ . "/../../BDD/requeteSQL/utilisateurs/recupInfo.php";
$mesArticles = mesArticles($id); 
    if(!$mesArticles): ?>
    <h2>Cet utilisateur n'a publié aucun article</h2>
    
<?php endif;
    if (isset($_SESSION["flash"])) {
        $flash =  $_SESSION["flash"];
        unset($_SESSION["flash"]);
    }
    if (isset($flash)) : ?>
        <p class="flash"><?php echo $flash ?></p>
    <?php endif; ?>


<?php foreach ($mesArticles as $monArticle) : ?>
    <?php $userUsername = infoUsers($monArticle["idUser"]);
            $nblike = nbLike($monArticle["idArticle"]);
    ?>
    <link rel="stylesheet" href="/Projet-Blog-Voyage/template/userProfil/sources/style.css">

    <div class="Resume-cards">
        <span class="pseudo"><?php echo $userUsername["username"] ?></span>
        <span class="paysFav"><?php echo $monArticle["nomPays"] ?></span>
        <a class="photo" href="/Projet-Blog-Voyage/Pages/detailsArticle.php?idArticle=<?php echo $monArticle["idArticle"] ?>">
        <img src=<?php echo $monArticle["photoResume"] ?>></a>
        <span class="resume"><?php echo $monArticle["texteResume"] ?></span>
        <a class="like" href="/Projet-Blog-Voyage/template/mesLikes/like_controller.php?idUser=<?php echo $monArticle["idUser"] ?>&idArticle=<?php echo $monArticle["idArticle"] ?>">
                <i class="<?php
                            $like = verifyLike($monArticle["idUser"], $monArticle["idArticle"]);
                            if ($like) {
                                echo "fa-solid";
                            }
                            if (!$like) {
                                echo "fa-regular";
                            }
                            ?> fa-heart fa-2x"></i><span class="nbLike"><?php echo $nblike["COUNT(*)"] . " Likes" ?></span></a>
    </div>
<?php endforeach; ?>