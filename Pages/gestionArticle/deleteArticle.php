<?php
require __DIR__ . "/../../BDD/requeteSQL/utilisateurs/recupInfo.php";

deleteArticle($_GET["idArticle"]);
header("Refresh: 5;URL = ../filActu.php");
?>

<h2>Votre article a bien été supprimé vous allez être redirigé dans quelques secondes</h2>