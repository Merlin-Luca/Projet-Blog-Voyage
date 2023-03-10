<?php
    /*
        Dans PHP il existe plusieurs outils de connexion à la BDD,
        "MySQLi" et "PDO"
        Ce premier est adapté uniquement aux BDD de type mySQL
        Alors que le seconde gère tout.

        * le \ avant PDO sert a indiquer que si on se trouve dans un namespace,
        * On doit aller chercher PDO hors de ce namespace
    */
    function connexionPDO(): \PDO
    {
        // Je recupere la configuration à ma BDD;
        $config = require __DIR__."/../service/config/_blogConfig.php";
        /*
            dsn signifie Data Source Name
            C'est un string contenat toute les informations pour localiser la BDD;
            Il prendra la forme suivante :
                "pilote:host="hote de la BDD;port="port de la BDD";
                dbname="nom de la bdd";charset="charset utilisé par la bdd"
            Ici on obtient :
                "mysql:host=localhos;port=3306;dbname=blog;charset=utf8mb4"
        */
        $dsn =
        "mysql:host=".$config["host"]
        . ";dbname=".$config["database"]
        .";charset=".$config["charset"];

        try
        {
            /*
                On crée une nouvelle instance de PDO en lui donnant :
                le dsn,
                le nom dutilisateur,
                le mdp,
                les options de la PDO
                Cet objet contient la connexion à la BDD;
            */
            $pdo = new \PDO(
                $dsn,
                $config["user"],
                $config["password"],
                $config["options"]
            );
            return $pdo;
        }catch(\PDOException $e)
        {
            /*
                On lance une nouvelle exception,
                avec en premier argument les message d'erreur,
                et en second le code d'erreur.
            */
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
?>