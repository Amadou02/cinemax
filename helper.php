<?php
require_once 'vendor/autoload.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function get_current()
{
    return basename($_SERVER['SCRIPT_FILENAME'], '.php');
}

function sendMessage($subject, $email, $message)
{
    //Instanciation de PHPMailer avec activation des exceptions avec le passage de l'argument `true`
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();
        $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'admin@example.com';                     //SMTP username
        $mail->Password   = 'secret';
        $mail->Port       = 587;                                 //SMTP password
        //Recipients
        $mail->setFrom(htmlentities($email), 'Mailer');
        $mail->Subject = htmlentities($subject);
        $mail->AltBody = htmlentities($message);

        $mail->send();
        return true;
    } catch (Exception $e) {
        // echo 'Oups ! Le message n\'a pas pu être envoyé. Message d\'erreur' . $mail->ErrorInfo;
        return false;
    }
}
