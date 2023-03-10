<?php
/*
    Pour nous simplifier la gestion des mails, on utilise PHPMailer qui est un package populaire.

    On l'a installé avec Composer qui est l'equivalent le plus connu à NPM pour PHP.

    On indique les namespaces qui vont etre utilisés:
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
/*
    On require l'autoloader de composer pour qu'il require automatiquement les classes dont on va avoir besoin.
*/
require __DIR__."/../vendor/autoload.php";
//envoi un Email
    function sendMail(string $from, string $to, string $subject, string $body): string
    {
        /*
            On crée un nouvel objet PHPMailer,
            l'argument à true avtive les exceptions (type d'erreur)
        */
        $mail = new PHPMailer(true);
        try
        {
            /*
                Paramètres du serveur de mail :
                Toute les informations suivantes sont disponibles sur votre serveur de mail

                On active l'utilisation de SMTP.
                (Simple Mail Transfer Protocol)
            */
            $mail->isSMTP();
            // On indique ou est hebergé notre serveur mail.
            $mail->Host = "sandbox.smtp.mailtrap.io";
            // On active l'authentification par SMTP
            $mail->SMTPAuth = true;
            // On indique quel port est utilisé.
            $mail->Port = 2525;
            // On indique l'username et le password
            $mail->Username = "d912a88c4c9182";
            $mail->Password = "447eceb3474cd6";
            // Active les details sur le deroulement de la requete
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            // Quel type de chiffrement est utilisé pour envoer le mail
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            /*
                Expediteur et destinataire

                setFrom prendra l'adresse de l'expediteur (et optionnelement un nom)
            */
            $mail->setFrom($from);
            // addAddress permet d'ajouter un destinaire (et optionnelement un nom)
            $mail->addAddress($to);
            /*
                "addReplyTo" permet d'indiquer une reponse
                "addCC" permet d'ajouter une adresse en copie.
                "addBCC" permet dajouter une adresse en copie caché.
                "addAttachment qui permet d'ajouter une piece jointe"
            */
            // Indique que l'email sera en HTML
            $mail->isHTML(true);
            // Indique le sujet du mail
            $mail->Subject = $subject;
            // Indique le corps du mail
            $mail->Body = $body;
            /*
                On peut ajouter une AltBody dans le cas ou le client mail du destinataire ne gere pas le HTML.

                On envoi l'email.
            */
            $mail->send();
            return "Message Envoyé !";

        }catch(Exception $e)
        {
            // Si une erreur est produite, on ne l'affiche pas directement mais retourne le message d'erreur suivant.
            return "Le message n'a pas pu être envoyé. Mailer Error : {$mail->ErrorInfo}";
        }
        return "TODO : Cette fonction est vide";
    }
?>