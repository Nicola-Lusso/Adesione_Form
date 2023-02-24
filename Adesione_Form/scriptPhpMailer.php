<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

// controllo invio form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // controlla che tutti i campi obbligatori siano stati inseriti
    if (isset($_POST['name'], $_POST['surname'], $_POST['work'], $_POST['phone'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
        $mail = new PHPMailer(true);

        try {
            // credenziali email
            $mail->isSMTP();
            $mail->Host       = 'mail.netgroup.it'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = 'v2xplatform'; 
            $mail->Password   = 'Netgroup2021!!'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 25;

            // impostazioni mail
            $mail->setFrom($_POST['email'], $_POST['nome'] . ' ' . $_POST['cognome']);
            $mail->addAddress('nicolusso@gmail.com'); // indirizzo email del destinatario
            $mail->Subject = $_POST['subject'];
            $mail->Body    = $_POST['messaggio'];

            // invia la mail
            $mail->send();

            echo 'La tua mail è stata inviata con successo!';
        } catch (Exception $e) {
            // errore
            echo "Errore durante l'invio della mail: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Si prega di compilare tutti i campi obbligatori.';
    }
}
?>
