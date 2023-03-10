<?php
$title = "Fil d'Actualité";
require __DIR__ . "/../template/navbar/_navbar.php";
require __DIR__ . "/../BDD/requeteSQL/utilisateurs/recupInfo.php";
?>
<link rel="stylesheet" href="../src/css/filActu.css">
<form action="" name="search" method="post" id="search">
    <?php require __DIR__."/../template/Inscription/sources/_inputPays.php" ?>
    <input type="submit" value="search" id="search" name="search">
</form>
<?php
require __DIR__ . "/../template/resumeArticle/_resumeArticle.php";
?>
<?php require __DIR__ . "/../template/footer/_footer.php" ;
var_dump($_SESSION["profile"]);?>