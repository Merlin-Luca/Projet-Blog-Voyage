<link rel="stylesheet" href="../../src/css/connexion/connexion.css">
<?php 
require "../../service/_shouldBeLogged.php";
require "../../service/_pdo.php";


shouldBeLogged(false, "/");
$email = $pass = "";
$error = [];

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])){
    if(empty($_POST["email"])){
        $error["email"] = "Veuillez entrer un email.";
    }else{
        $email = trim($_POST["email"]);
    }
    if(empty($_POST["password"])){
        $error["pass"] = "Veuillez entrer un mot de passe.";
    }else{
        $pass = trim($_POST["password"]);
    }
    if(empty($error)){
        
        $pdo = connexionPDO();
        $sql = $pdo->prepare("SELECT * FROM utilisateurs WHERE email=?");
        $sql->execute([$email]);
        $user = $sql->fetch();
        if($user){
            if(password_verify($pass, $user["password"])){
                $_SESSION["logged"] = true; 
                $_SESSION["username"] = $user["username"];
                $_SESSION["profile"] = $user["profilePicture"];
                $_SESSION["idUser"] = $user["idUser"];
                $_SESSION["expire"] = time()+ (60*60);
                $_SESSION["flash"] = "Bonjour " . $user["username"];
                header("location: /Projet-Blog-Voyage/Pages/filActu.php");
				exit;
            }
            else{
                $error["login"] = "Email ou Mot de passe incorrecte.";
            }
        }
        else{
            $error["login"] = "Email ou Mot de passe incorrecte.";
        }
    }
}




if(isset($_SESSION["flash"])): ?>
<p> <?php echo $_SESSION["flash"]?> </p>

<?php endif; 
    unset($_SESSION["flash"]);
?>

<form action="" method="post">
    <h2>Connexion</h2>
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <br>
    <span class="error"><?php echo $error["email"]??""; ?></span>
    <br>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">
    <br>
    <span class="error"><?php echo $error["pass"]??""; ?></span>
    <br>
    <input type="submit" value="Connexion" name="login">
    <br>
    <span class="error"><?php echo $error["login"]??""; ?></span>
</form>
