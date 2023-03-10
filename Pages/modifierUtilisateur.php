<?php
$title = "Modifier Utilisateurs";
require __DIR__ . "/../template/navbar/_navbar.php";
require __DIR__ . "/../BDD/requeteSQL/utilisateurs/recupInfo.php";
?>

<?php
// shouldBeLogged(true, "./exercice/connexion.php");

// if(empty($_GET["id"]) || $_SESSION["idUser"] != $_GET["id"])
// {
//     header("Location: ./Pages/Acceuil.php");
//     exit;
// }

require "../service/_cleanData.php";
require "../service/_csrf.php";
// Je récupère les informations lié à mon utilisateur.
$pdo = connexionPDO();
$sql = $pdo->prepare("SELECT * FROM utilisateurs WHERE idUser=?");
$sql->execute([(int)$_SESSION["idUser"]]);
$user = $sql->fetch();

$username = $password = $email = $birthDate = $paysFavoris = "";
$error = [];
$regexPass = "/^(?=.*[!?@#$%^&*+-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    if (empty($_POST["username"]))
        $error["username"] = "Veuillez saisir un nom d'utilisateur !";
    else {
        if (strlen($_POST["username"]) < 7 || strlen($_POST["username"]) > 20)
            $error["username"] = "Votre nom d'utilisateur doit être compris entre 7 et 20 caractères !";
        else {
            $username = cleanData($_POST["username"]);
            if (!preg_match("/^[a-zA-Z'\s-]{7,25}$/", $username))
                $error["username"] = "Votre Nom d'utilisateur doit contenir que des lettres !";
        }
    }
    if (empty($_POST["email"]))
        $error["email"] = "Veuillez saisir un email !";
    else {
        $email = cleanData($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $error["email"] = "Veuillez saisir un email valide !";
    }

    if (empty($_POST["pays"]))
        $error["pays"] = "Veuillez selectionner un pays !";
    else {
        $paysFavoris = $user["paysFavoris"];
    }

    if (empty($_POST["birthDate"]))
        $error["birthDate"] = "Veuillez entrer votre date de naissance";
    else {
        $birthDate = $_POST["birthDate"];
        $date = date_parse($birthDate);
        if ($date["year"] > 2015 || $date["year"] < 1900) {
            $error["birthDate"] = "Veuillez saisir une date valide";
        }
    }

    if (empty($_POST["password"]))
        $password = $user["password"];
    else {
        $password = cleanData($_POST["password"]);
        if (empty($_POST["passwordBis"])) {
            $error["passwordBis"] = "Veuillez confirmer votre mot de passe";
        } else if ($_POST["password"] != $_POST["passwordBis"]) {
            $error["passwordBis"] = "Veuillez saisir le même mot de passe";
        }
        if (!preg_match($regexPass, $password)) {
            $error["password"] = "Veuillez saisir un mot de passe valide";
        } else
            $password = password_hash($password, PASSWORD_DEFAULT);
    }
    if (empty($error)) {
        $sql = $pdo->prepare("UPDATE utilisateurs SET 
            username=:us,
            email = :em,
            paysFavoris = :py,
            birthDate = :bt,
            password = :mdp
            WHERE idUser = :id");
        $sql->execute([
            "id" => $user["idUser"],
            "em" => $email,
            "bt" => $birthDate,
            "py" => $paysFavoris,
            "mdp" => $password,
            "us" => $username
        ]);
        // Ajout d'un Flash Message;
        $_SESSION["flash"] = "Votre Profil a bien été édité.";
        // Je redirige mon utilisateur
        header("Location: ./filActu.php");
        exit;
    }
    var_dump($user["idUser"], $email, $birthDate, $paysFavoris, $password, $username, $_POST["birthDate"], $_POST["pays"]);
}
$articlePays = $user["paysFavoris"];
?>
<link rel="stylesheet" href="../src/css/modifierUtilisateur.css">

<form action="" method="post">
    <h2>Mise à jour du Profil</h2>
    <!-- username -->
    <label for="username">Nom d'Utilisateur :</label>
    <input type="text" name="username" id="username" value="<?php echo $user['username'] ?>">
    <span class="error"><?php echo $error["username"] ?? "" ?></span>
    <!-- Email -->
    <label for="email">Adresse Email :</label>
    <input type="email" name="email" id="email" value="<?php echo $user['email'] ?>">
    <span class="error"><?php echo $error["email"] ?? "" ?></span>
    <!-- Password -->
    <label for="password">Mot de Passe :</label>
    <input type="password" name="password" id="password">
    <span class="error"><?php echo $error["password"] ?? "" ?></span>
    <!-- password verify -->
    <label for="passwordBis">Confirmation du mot de passe :</label>
    <input type="password" name="passwordBis" id="passwordBis">
    <span class="error"><?php echo $error["passwordBis"] ?? "" ?></span>
    <!-- paysFavoris -->
    <?php $paysInput = "Pays favori :"; ?>
    <?php require __DIR__ . "/../template/Inscription/sources/_inputpays.php" ?>
    <!-- Date Naissance -->
    <label for="birthDate">Votre date de naissance : </label>
    <input type="date" name="birthDate" id="birthDate" class="dateOfBirthInput" value="<?php echo $user['birthDate'] ?>">
    <br>
    <input type="submit" value="Mettre à jour" name="update">
</form>