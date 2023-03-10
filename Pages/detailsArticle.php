<?php
$title = "Details article";
require __DIR__ . "/../template/navbar/_navbar.php";
require __DIR__ . "/../BDD/requeteSQL/utilisateurs/recupInfo.php";
$article = articleByIdArticle($_GET["idArticle"]);
$usernameArticle = infoUsers($article["idUser"]);
if (isset($_SESSION["flash"])) {
    $flash =  $_SESSION["flash"];
    unset($_SESSION["flash"]);
}
?>
<link rel="stylesheet" href="../src/css/detailsArticle.css">

<div class="details_Article">
    <div class="titre">
        <h2><?php echo $article["nomArticle"] ?></h2>
        <h4><?php echo $article["nomPays"] ?></h4>
    </div>
    <div class="auteur">
        <p><?php echo $usernameArticle["username"] ?></p>
        <a href="/Projet-Blog-Voyage/Pages/pageUtilisateurs.php?idUser=<?php echo $article["idUser"] ?>">
        <img src=<?php echo $usernameArticle["profilePicture"] ?>></a>
    </div>
    <!-- resume -->
    <div class="details_Article_base">
        <div class="details_Article_resume">
            <p><?php echo $article["texteResume"] ?></p>
        </div>

        <div class="details_Article_resume_img">
            <img src="<?php echo $article["photoResume"] ?>" alt="">
        </div>
    </div>

    <!-- autres -->
    <div class="autres">
        <div class="details_Article_autres imagie">
            <img src="<?php echo $article["photoContenu"] ?>" alt="">
        </div>

        <div class="details_Article_autres">
            <p><?php echo $article["texteContenu"] ?></p>
        </div>
    </div>
    <?php require __DIR__ . "/../template/commentaire/_commentaire.php" ?>
    <?php if (isset($flash)) : ?>
        <p><?php echo $flash ?></p>
    <?php endif; ?>
</div>
<?php require __DIR__ . "/../template/footer/_footer.php"; ?>