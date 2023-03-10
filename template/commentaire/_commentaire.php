<?php
require __DIR__ . "/../../service/_cleanData.php";

$commentaire = "";
$error = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["commente"])) {
    if (empty($_POST["comm"])) {
        $error["comm"] = "Veuillez remplir ce champ !";
    } else {
        $commentaire = cleanData($_POST["comm"]);
        if (strlen($commentaire) < 10 || strlen($commentaire) > 255)
            $error["comm"] = "Votre commentaire doit contenir plus de 10 et moins de 255 caracteres";
    }
    if (empty($error)) {
        addComm($_GET["idArticle"], $_SESSION["idUser"], $commentaire);
        $_SESSION["flash"] = "Votre commentaire a bien été publié";
        // $idArticle = $_GET["idArticle"];
        // header("location: /Projet-Blog-Voyage/Pages/detailsArticle.php?idArticle=$idArticle");
        // exit;
    }
}
$comms = selectAllCommByIdArticle($_GET["idArticle"]);
?>
<h1 class="h1_commentaires">Commentaires :</h1>
<div class="commentaires">
<?php
foreach ($comms as $comm) :
    $user = infoUsers($comm["userID"]);
?>

<link rel="stylesheet" href="/Projet-Blog-Voyage/template/commentaire/sources/style.css">
        <div class="commentaire">
            <div class="utilisateur">
                <img src="<?php echo $user["profilePicture"] ?>" alt="">
                <h4><?php echo $user["username"] ?></h4>
            </div>
                <div class="comm"><?php echo $comm["comm"] ?></div>       
        </div>
    
    <?php endforeach; ?>
    <form id ="comm" action="#comm" class="addComm" method="post" name="commente">
        <textarea name="comm" id="comm" cols="100" rows="5" placeholder="Votre commentaire ici.."></textarea>
        <span class="error"><?php echo $error["comm"] ?? ""; ?></span>
        <input type="submit" value="Commenter" name="commente">
    </form>
    </div>