<?php
require __DIR__ . "/../../../service/_pdo.php";
function infoUsers(int $idUser)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM utilisateurs WHERE idUser = ?");
    $sql->execute([$idUser]);
    return $sql->fetch();
}

function AllArticle()
{
    $pdo = connexionPDO();
    $sql = $pdo->query("SELECT * FROM article");
    $sql->execute();
    return $sql->fetchAll();
}

function mesArticles($idUser)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM article WHERE idUser=?");
    $sql->execute([$idUser]);
    return $sql->fetchAll();
}

function deleteArticle($idArticle)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("DELETE FROM article WHERE idArticle=?");
    $sql->execute([$idArticle]);
}

function newArticle($idUser, $titleArticle, $pays, $photoResume, $texteResume, $photoCommentaires, $texteContenu)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("INSERT INTO article(idUser, nomArticle, nomPays, photoResume, texteResume, photoContenu, texteContenu) VALUES(?, ?, ?, ?, ?, ?, ?)");
    $sql->execute([$idUser, $titleArticle, $pays, $photoResume, $texteResume, $photoCommentaires, $texteContenu]);
}

function articleByIdArticle($idArticle)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM ARTICLE WHERE idArticle =:idA");
    $sql->execute(["idA" => $idArticle]);
    return $sql->fetch();
}

function updateArticle($titleArticle, $pays, $photoResume, $texteResume, $photoCommentaires, $texteContenu, $idArticle)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("UPDATE article SET nomArticle =:nA, nomPays =:nP, photoResume =:pR , texteResume =:tR, photoContenu =:pC, texteContenu =:tC WHERE idArticle =:idA");
    $sql->execute([
        "nA" => $titleArticle,
        "nP" => $pays,
        "pR" => $photoResume,
        "tR" => $texteResume,
        "pC" => $photoCommentaires,
        "tC" => $texteContenu,
        "idA" => $idArticle
    ]);
}
function selectAllCommByIdArticle($idArticle)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM commentaire WHERE articleID =:idA");
    $sql->execute(["idA" => $idArticle]);
    return $sql->fetchAll();
}
function addComm($articleID, $userID, $comm)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("INSERT INTO commentaire(articleID, userID, comm) VALUES(?, ?, ?)");
    $sql->execute([$articleID, $userID, $comm]);
}

function getLikeByIdUser($idUser)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM likearticle WHERE idUser = :idU");
    $sql->execute(["idU" => $idUser]);
    return $sql->fetchAll();
}
function verifyLike($idUser, $idArticle)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM likearticle WHERE idUser = :idU AND idArticle = :idA");
    $sql->execute(["idU" => $idUser, "idA" => $idArticle]);
    return $sql->fetch();
}
function unLike($idUser, $idArticle)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("DELETE FROM likearticle WHERE idUser = :idU AND idArticle = :idA");
    $sql->execute(["idU" => $idUser, "idA" => $idArticle]);
}
function like($idUser, $idArticle)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("INSERT INTO likearticle (idUser, idArticle) VALUES(?, ?)");
    $sql->execute([$idUser, $idArticle]);
}
function nbLike($idArticle)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT COUNT(*) FROM likearticle WHERE idArticle=?");
    $sql->execute([$idArticle]);
    return $sql->fetch();
}

function verifyFollow($idFollower, $idFollowed)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM follow WHERE UserQuiSuit = :idFollower AND UserSuivi = :idFollowed");
    $sql->execute(["idFollower" => $idFollower, "idFollowed" => $idFollowed]);
    return $sql->fetch();
}
function unfollow($idFollower, $idFollowed)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("DELETE FROM follow WHERE UserQuiSuit = :idFollower AND UserSuivi = :idFollowed");
    $sql->execute(["idFollower" => $idFollower, "idFollowed" => $idFollowed]);
}
function follow($idFollower, $idFollowed)
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("INSERT INTO follow (UserQuiSuit, UserSuivi) VALUES(?, ?)");
    $sql->execute([$idFollower, $idFollowed]);
}
