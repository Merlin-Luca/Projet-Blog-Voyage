<?php
require "../../service/_shouldBeLogged.php";
shouldBeLogged(true, "/Projet-Blog-Voyage/Pages/Accueil.php");
unset($_SESSION);
session_destroy();
setcookie("PHPSESSID","", time()-3600);
header("location: ./connexion.php");
exit;
?>