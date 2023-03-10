<?php
$title = "Mes articles";
require __DIR__ . "/../template/navbar/_navbar.php";
require __DIR__ . "/../BDD/requeteSQL/utilisateurs/recupInfo.php";
if (!isset($_GET["id"]) || $_GET["id"] != $_SESSION["idUser"]) {
   header("Location: ./Accueil.php");
   exit;
} else {

   require __DIR__ . "/../template/mesArticles/_mesArticles.php";
   require __DIR__ . "/../template/footer/_footer.php";
}
