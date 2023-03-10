<?php
$title = "Ajout article";
session_start();
require __DIR__ . "/../service/_cleanData.php";
require __DIR__ . "/../BDD/requeteSQL/utilisateurs/recupInfo.php";
$titleArticle = $resumeText = $commentaires = $pays = "";
$typePermis = ["image/png", "image/jpeg", "image/gif", "application/pdf"];
$target_file = $target_file_contenu = $target_name = $mime_type = $oldName = $oldNameContenu = $target_name_contenu = $photoResume = $photoCommentaires = "";
$dirPhotoResume = "\Projet-Blog-Voyage\\ressources\\uploadResumeArticle\\";
$dirPhotoCommentaires = "\Projet-Blog-Voyage\\ressources\\uploadArticle\\";
$target_dirResume = "../ressources/uploadResumeArticle/";
$target_dirArticle = "../ressources/uploadArticle/";
$error = [];
$paysInput = "Pays concerné :";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
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

    if (!is_uploaded_file($_FILES["resumeImg"]["tmp_name"]))
        $error["file"] = "Aucun fichier téléversé !";
    else {

        $oldName = basename($_FILES["resumeImg"]["name"]);

        $target_name = uniqid(time() . "-", true) . "-" . $oldName;

        $target_file = $target_dirResume . $target_name;
        $photoResume = $dirPhotoResume . $target_name;
        var_dump($photoResume);
        $mime_type = mime_content_type($_FILES["resumeImg"]["tmp_name"]);

        if (file_exists($target_file))
            $error["file"] = "Ce fichier existe déjà";

        if ($_FILES["resumeImg"]["size"] > 50000000000000000)
            $error["file"] = "Ce fichier est trop gros.";

        if (!in_array($mime_type, $typePermis))
            $error["file"] = "Ce type de fichier n'est pas accepté.";
    }
    if (empty($_POST["commentaires"]))
        $error["commentaires"] = "Veuillez ajouter un resumé à votre article.";
    else
        $commentaires = cleanData($_POST["commentaires"]);
    if (!is_uploaded_file($_FILES["commentairesImg"]["tmp_name"]))
        $error["file"] = "Aucun fichier téléversé !";
    else {

        $oldNameContenu = basename($_FILES["commentairesImg"]["name"]);

        $target_name_contenu = uniqid(time() . "-", true) . "-" . $oldNameContenu;

        $target_file_contenu = $target_dirArticle . $target_name_contenu;
        $photoCommentaires = $dirPhotoCommentaires . $target_name_contenu;
        $mime_type = mime_content_type($_FILES["commentairesImg"]["tmp_name"]);

        if (file_exists($target_file_contenu))
            $error["file"] = "Ce fichier existe déjà";

        if ($_FILES["commentairesImg"]["size"] > 50000000000000000)
            $error["file"] = "Ce fichier est trop gros.";

        if (!in_array($mime_type, $typePermis))
            $error["file"] = "Ce type de fichier n'est pas accepté.";
    }
    if (empty($error)) {
        if (move_uploaded_file($_FILES["commentairesImg"]["tmp_name"], $target_file_contenu) && move_uploaded_file($_FILES["resumeImg"]["tmp_name"], $target_file)) {
            newArticle($_SESSION["idUser"], $titleArticle, $pays, $photoResume, $resumeText, $photoCommentaires, $commentaires);
            $_SESSION["flash"] = "Votre article à bien été publié";
            $idUser = $_SESSION["idUser"];
            header("location: /Projet-Blog-Voyage/Pages/mesArticles.php?id=$idUser");
            exit;
        } else
            $error["file"] = "Erreur lors du téléversage";
    }
}

?>
<!-- Faire attention a la redirection ou aucun code html ne doit etre avant un header -->
<?php require __DIR__ . "/../template/navbar/_navbar.php"; ?>
<link rel="stylesheet" href="../src/css/AjoutArticle.css">
<script src="../src/js/tools/counterChar.js" defer></script>

<form action="" class="ajout_article" name="create" method="post" enctype="multipart/form-data">
    <label for="titre">Nom de l'article</label>
    <input type="text" name="titre" id="titre">
    <br>
    <span class="error"><?php echo $error["titre"] ?? "" ?></span>
    <br>
    <?php require "../template/Inscription/sources/_inputPays.php" ?>
    </div>
    <br>
    <span class="error"><?php echo $error["pays"] ?? "" ?></span>
    <div class="ajout_article_base">
        <div class="ajout_article_resume">
            <label for="resumeText">Resume article</label>
            <br>
            <textarea name="resumeText" id="resumeText" cols="30" rows="10"></textarea>
            <p class="resume"></p>
            <br>
            <span class="error"><?php echo $error["resumeText"] ?? "" ?></span>
        </div>

        <div class="ajout_article_resume_img">
            <label for="resumeImg">Upload img resume</label>
            <br>
            <input type="file" name="resumeImg" id="resumeImg">
            <br>
            <span class="error"><?php echo $error["file"] ?? "" ?></span>
        </div>

        <div class="ajout_article_resume">
            <label for="commentaires">Commentaires lié a la photo</label>
            <br>
            <textarea name="commentaires" id="commentaires" cols="30" rows="10"></textarea><br>
            <p class="commentaires"></p>
            <br>
            <span class="error"><?php echo $error["commentaires"] ?? "" ?></span>
        </div>

        <div class="ajout_article_resume">
            <label for="commentairesImg">Upload img</label>
            <br>
            <input type="file" name="commentairesImg" id="commentairesImg">
            <br>
            <span class="error"><?php echo $error["file"] ?? "" ?></span>
        </div>
    </div>
    <div class="poster">
        <input class="submit" type="submit" value="Poster" name="create"></input>
    </div>
</form>
<?php require __DIR__ . "/../template/footer/_footer.php"; ?>