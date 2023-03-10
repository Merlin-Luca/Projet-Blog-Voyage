<?php
require __DIR__ . "/../../service/_shouldBeLogged.php";
shouldBeLogged(true, "/Projet-Blog-Voyage/Pages/Accueil.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? "" ?></title>
    <link rel="stylesheet" href="/Projet-Blog-Voyage/template/navbar/sources/style.css">
    <link rel="stylesheet" href="/Projet-Blog-Voyage/template/resumeArticle/sources/style.css">
    <link rel="stylesheet" href="/Projet-Blog-Voyage/template/footer/sources/footer.css">
    <script src="https://kit.fontawesome.com/6e2bb0e8df.js" crossorigin="anonymous"></script>
    <script src="/Projet-Blog-Voyage/template/navbar/sources/script.js" defer></script>

</head>

<body>

    <nav class="navtest">
        <ul>
            <li><a href="/Projet-Blog-Voyage/Pages/Accueil.php"><img src="/Projet-Blog-Voyage/ressources/img/logo_transparent.png" alt=""></a></li>
            <li><a href="/Projet-Blog-Voyage/Pages/filActu.php"><i class="fa-solid fa-house"></i></a></li>
            <li><a href="/Projet-Blog-Voyage/Pages/MesLikes.php"><i class="fa-solid fa-heart"></i></a></li>
            <li><a href="/Projet-Blog-Voyage/Pages/AjoutArticle.php"><i class="fa-solid fa-circle-plus"></i></a></li>
            <li class="profile-nav">
                <a><?php echo $_SESSION["username"] ?></a>
                <a href="/Projet-Blog-Voyage/Pages/pageUtilisateurs.php?idUser=<?php echo $_SESSION["idUser"] ?>">
                <img class="profilePicture" src="<?php echo $_SESSION["profile"] ?>" alt=""></a>
                <div class="hidden-nav">
                    <ul>
                        <li><a href="/Projet-Blog-Voyage/Pages/mesArticles.php?id=<?php echo $_SESSION["idUser"] ?>">Mes articles</a></li>
                        <li><a href="/Projet-Blog-Voyage/Pages/modifierUtilisateur.php">Modifier mon profil</a></li>
                        <li><a href="/Projet-Blog-Voyage/Pages/connexion/deconnexion.php">Deconnexion</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>


    <nav class="burger">
        <div class="navbar" id="acceuil">
            <div class="container nav-container">
                <input class="checkbox" type="checkbox" name="" id="checkbox" />
                <div class="hamburger-lines">
                    <span class="line line1"></span>
                    <span class="line line2"></span>
                    <span class="line line3"></span>
                </div>

                <div id="menu-items" class="menu-items">
                    <ul>
                        <li>
                            <ul>
                                <li><a href="/Projet-Blog-Voyage/Pages/Accueil.php">Acceuil</a></li>
                                <li><a href="/Projet-Blog-Voyage/Pages/filActu.php">Fil d'Actu</a></li>
                                <li><a href="/Projet-Blog-Voyage/Pages/MesLikes.php">Mes likes</a></li>
                                <li><a href="/Projet-Blog-Voyage/Pages/AjoutArticle.php">Ajouter un article</a></li>
                            </ul>
                        </li>
                        <li class="profile-burger">
                            <img src=<?php echo $user["profilePicture"] ?> alt="">
                            <a><?php echo $user["username"] ?></a><br><br>
                            <div class="hidden-burger">
                                <ul>
                                    <li><a href="/Projet-Blog-Voyage/Pages/mesArticles.php?id=<?php echo $_SESSION["idUser"] ?>">Mes articles</a></li>
                                    <li><a href="/Projet-Blog-Voyage/Pages/modifierUtilisateur.php">Modifier mon profil</a></li>
                                    <li><a href="/Projet-Blog-Voyage/Pages/connexion/deconnexion.php">Deconnexion</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>