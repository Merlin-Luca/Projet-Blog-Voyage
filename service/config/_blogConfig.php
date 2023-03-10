<?php 
    /*
        Ce fichier va contenir toute les informations de connexion a votre BDD
        Il faut faire attention a ce qu'il ne sot pas accessible a vbos utilisateurs

        Soit en ayant un routeur bloquant l'acces à ce fichier
        Soit en yant ce fichier hors de la racine de votre sit
    */

    return [
        // hebergeur de la BDD
        "host" => "localhost",
        // Nom de la BDD
        "database" =>"blog voyage",
        // Nom d'utilisateur
        "user" => "root",
        // password
        "password" => "",
        // le set de caractere
        "charset" => "utf8mb4",
        //les options de PDO (PHP Data Object)
        "options" => 
        [
            // Le mode d'erreur utilisé
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // De quelle façon sont retourné les informations de la BDD
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // PDO doit il emuler les requetes preparé.
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    ]
?>