<?php

/**
 * Petite fonction qui permet de récupérer le nom sans l'extension du fichier dans lequel elle est appelée.
 * Elle me sert pour ajouter la classe active au lien de la page courante dans la navbar.
 */
function get_current()
{
    // récupère le nom du fichier dans la superglobale $_SERVER et basename extrait le racine du fichier 
    return basename($_SERVER['SCRIPT_FILENAME'], '.php');
}

/**
 * @param string $subject | objet du mail
 * @param string $email | addresse mail de l'expéditeur
 * @param string $message | contenu du message
 */
function sendMessage($subject, $email, $message)
{
    // On utilise les blocs de gestion des exceptions try catch pour pouvoir personnaliser 
    // le retour en cas de lévée d'exception par la fonction mail.

    try {
        $to               = 'admin@gmail.com';
        $username         = 'Admin';

        $headers = array(
            'From' => $email,
            'Reply-To' => $username . ' <webmaster@example.com>',
            'X-Mailer' => 'PHP/' . phpversion()
        );

        mail($to, $subject, $message, $headers);
        return true;
    } catch (Exception $e) {
        echo 'Oups ! Le message n\'a pas pu être envoyé. Message d\'erreur' . $e->getMessage();
        return false;
    }
}
