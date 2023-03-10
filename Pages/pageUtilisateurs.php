<?php
$title = "Votre profil";
require __DIR__ . "/../template/navbar/_navbar.php";
require __DIR__ . "/../BDD/requeteSQL/utilisateurs/recupInfo.php";
$id = $_GET["idUser"]??$_SESSION["idUser"];
$user = infoUsers($id);
$articles = mesArticles($id);
$follow = verifyFollow($_SESSION["idUser"], $user["idUser"]);
?>
<link rel="stylesheet" href="../src/css/pageUtilisateurs.css">
<div class="container">
<div class="info_Profil">
    <div class="utilisateurs">
        <img src="<?php echo $user["profilePicture"] ?>" alt="">
        <p><?php echo $user["username"] ?></p>
        <?php if($_GET["idUser"] != $_SESSION["idUser"]) :?>
            <?php if($follow) :?>
                <a href="/Projet-Blog-Voyage/template/userProfil/followController.php?idFollowed=<?php echo $user["idUser"] ?>">Unfollow</a>
            <?php endif; ?>
            <?php if(!$follow) :?>
                <a href="/Projet-Blog-Voyage/template/userProfil/followController.php?idFollowed=<?php echo $user["idUser"] ?>">Follow</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <?php
        require __DIR__."/../template/userProfil/_userProfil.php" ;
    ?>
    
</div>
</div>
<?php require __DIR__ . "/../template/footer/_footer.php"; ?>