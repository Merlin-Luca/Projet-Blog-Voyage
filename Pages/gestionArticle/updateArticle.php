<?php
// require __DIR__ . "/../../BDD/requeteSQL/utilisateurs/recupInfo.php";
require __DIR__ . "/../../template/navbar/_navbar.php";
require __DIR__ . "/../../service/_cleanData.php";
$monArticle = articleByIdArticle($_GET['idArticle']);
$paysInput = "Changer le pays";
$articlePays = $monArticle["nomPays"];

if (empty($_GET["idArticle"]) || $_SESSION["idUser"] != $monArticle["idUser"]) {
    header("Location: /Projet-Blog-Voyage/Pages/filActu.php");
    exit;
}

$titleArticle = $resumeText = $commentaires = $pays = "";
$typePermis = ["image/png", "image/jpeg", "image/gif", "application/pdf"];
$target_file = $target_file_contenu = $target_name = $mime_type = $oldName = $oldNameContenu = $target_name_contenu = $photoResume = $photoCommentaires = "";
$dirPhotoResume = "\Projet-Blog-Voyage\\ressources\\uploadResumeArticle\\";
$dirPhotoCommentaires = "\Projet-Blog-Voyage\\ressources\\uploadArticle\\";
$target_dirResume = "../../ressources/uploadResumeArticle/";
$target_dirArticle = "../../ressources/uploadArticle/";
$error = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    if (empty($_POST["titre"]))
        $error["titre"] = "Veuillez ajouter un titre.";
    else {
        $titleArticle = cleanData($_POST["titre"]);
        if (strlen($titleArticle) < 10)
            $error["titre"] = "Votre titre doit contenir au moins 10 caracteres.";
    }
    if (empty($_POST["pays"]))
        $error["pays"] = "Veuillez choisir le pays concernée par votre article";
    else
        $pays = cleanData($_POST["pays"]);
    if (empty($_POST["resumeText"]))
        $error["resumeText"] = "Veuillez ajouter un resumé à votre article.";
    else {
        $resumeText = cleanData($_POST["resumeText"]);
        if (strlen($resumeText) < 50 || strlen($resumeText) > 250)
            $error["resumeText"] = "Votre resumé doit contenir au moins 50 caracteres et maximum 250.";
    }
    $uploadedResume = !is_uploaded_file($_FILES["updateResumeImg"]["tmp_name"]);
    if ($uploadedResume)
        $photoResume = $monArticle["photoResume"];
    else {

        $oldName = basename($_FILES["updateResumeImg"]["name"]);

        $target_name = uniqid(time() . "-", true) . "-" . $oldName;

        $target_file = $target_dirResume . $target_name;
        $photoResume = $dirPhotoResume . $target_name;
        var_dump($photoResume);
        $mime_type = mime_content_type($_FILES["updateResumeImg"]["tmp_name"]);

        if (file_exists($target_file))
            $error["file"] = "Ce fichier existe déjà";

        if ($_FILES["updateResumeImg"]["size"] > 500000)
            $error["file"] = "Ce fichier est trop gros.";

        if (!in_array($mime_type, $typePermis))
            $error["file"] = "Ce type de fichier n'est pas accepté.";
    }
    if (empty($_POST["commentaires"]))
        $error["commentaires"] = "Veuillez ajouter un resumé à votre article.";
    else
        $commentaires = cleanData($_POST["commentaires"]);
    $uploadedCommentaires = !is_uploaded_file($_FILES["updateCommentairesImg"]["tmp_name"]);
    if ($uploadedCommentaires)
        $photoCommentaires = $monArticle["photoContenu"];
    else {

        $oldNameContenu = basename($_FILES["updateCommentairesImg"]["name"]);

        $target_name_contenu = uniqid(time() . "-", true) . "-" . $oldNameContenu;

        $target_file_contenu = $target_dirArticle . $target_name_contenu;
        $photoCommentaires = $dirPhotoCommentaires . $target_name_contenu;
        var_dump($photoCommentaires);

        $mime_type = mime_content_type($_FILES["updateCommentairesImg"]["tmp_name"]);

        if (file_exists($target_file_contenu))
            $error["file"] = "Ce fichier existe déjà";

        if ($_FILES["updateCommentairesImg"]["size"] > 500000)
            $error["file"] = "Ce fichier est trop gros.";

        if (!in_array($mime_type, $typePermis))
            $error["file"] = "Ce type de fichier n'est pas accepté.";
    }
    if (empty($error)) {
        $upResume = move_uploaded_file($_FILES["updateResumeImg"]["tmp_name"], $target_file);
        $upComm = move_uploaded_file($_FILES["updateCommentairesImg"]["tmp_name"], $target_file_contenu);
        $idUser = $_SESSION["idUser"];
        if ($upComm && $upResume) {
            unlink("C:\\xampp\htdocs\projet blog git" . $monArticle["photoResume"]);
            unlink("C:\\xampp\htdocs\projet blog git" . $monArticle["photoContenu"]);
        } elseif ($upComm && $uploadedResume) {
            unlink("C:\\xampp\htdocs\projet blog git" . $monArticle["photoContenu"]);
        } elseif ($uploadedCommentaires && $upResume) {
            unlink("C:\\xampp\htdocs\projet blog git" . $monArticle["photoResume"]);
        }
        updateArticle($titleArticle, $pays, $photoResume, $resumeText, $photoCommentaires, $commentaires, $_GET['idArticle']);
        $_SESSION["flash"] = "Votre article à bien été modifié";
        header("location: /Projet-Blog-Voyage/Pages/mesArticles.php?id=$idUser");
        exit;
    }
}

?>

<link rel="stylesheet" href="../../src/css/updateArticle.css">
<script src="../../src/js/tools/counterChar.js" defer></script>

<form action="" class="ajout_article" name="update" method="post" enctype="multipart/form-data">
    <label for="titre">Nom de l'article</label>
    <input type="text" name="titre" id="titre" value="<?php echo $monArticle["nomArticle"] ?>">
    <span class="error"><?php echo $error["titre"] ?? "" ?></span>
    <?php require "../../template/Inscription/sources/_inputPays.php"; ?>
    <span class="error"><?php echo $error["pays"] ?? "" ?></span>
    <div class="ajout_article_base">
        <div class="ajout_article_resume">
            <label for="resumeText">Resume article</label><br>
            <textarea type="text" name="resumeText" id="resumeText" rows="10" cols="33"><?php echo $monArticle["texteResume"] ?></textarea>
            <p class="resume"></p>
            <span class="error"><?php echo $error["resumeText"] ?? "" ?></span>
        </div>

        <div class="ajout_article_resume_img">
            <label for="resumeImg">Upload img resume</label>
            <input type="file" name="updateResumeImg" id="resumeImg">
            <br>
            <span class="error"><?php echo $error["file"] ?? "" ?></span>
        </div>

        <div class="ajout_article_resume">
            <label for="commentaires">Commentaires lié a la photo</label><br>
            <textarea type="text" name="commentaires" id="commentaires" rows="10" cols="33"><?php echo $monArticle["texteContenu"] ?></textarea>
            <p class="commentaires"></p>
            <br>

            <span class="error"><?php echo $error["commentaires"] ?? "" ?></span>
        </div>

        <div class="ajout_article_resume">
            <label for="commentairesImg">Upload img</label>
            <input type="file" name="updateCommentairesImg" id="commentairesImg">
            <br>
            <span class="error"><?php echo $error["file"] ?? "" ?></span>
        </div>
    </div>
    <div class="poster">
        <input class="submit" type="submit" value="Update" name="update"></input>
    </div>


</form>