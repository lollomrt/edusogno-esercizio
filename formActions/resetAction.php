<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../loader.php';
require_once '../vendor/autoload.php';

session_start();

// Controllo se c'è una richiesta in post e se viene dal form con name corretto sul submit - Utente che entra correttamente nella pagina.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset-request-submit"])) {
    // Crea un'istanza di Connector e imposta la connessione al database
    $connector = new Connector();
    $connector->setUpConnection();

    $email = $_POST['email'];

    // Verifica se l'utente esiste nel database
    if ($connector->isUserExists($email)) {
        // Configurazione delle credenziali SMTP di Mailtrap utilizzando le variabili dichiarate in loader.php
        $mail = new PHPMailer(true); // Usa 'true' per abilitare le eccezioni

        $mail->isSMTP();
        $mail->Host = $mailtrapHost;
        $mail->SMTPAuth = true;
        $mail->Username = $mailtrapUsername;
        $mail->Password = $mailtrapPassword;
        $mail->Port = $mailtrapPort;

        // Imposta il mittente e il destinatario
        $mail->setFrom('edusogno@example.com', 'Edu Sogno');
        $mail->addAddress($email);

        // Imposta il soggetto e il corpo del messaggio
        $mail->Subject = "Reset della password";
        $mail->Body = "Clicca su questo link per reimpostare la tua password: http://example.com/reset_password.php"; // Sostituisci con il link corretto

        // Invia l'email
        if ($mail->send()) {
            $_SESSION['success_message'] = "Controlla la tua casella di posta per il link di reset della password!";
            header("Location: " . APP_URL . "?page=password_reset");
            exit();
        } else {
            $_SESSION['error_message'] = "Errore nell'invio dell'email. Riprova più tardi.";
            header("Location: " . APP_URL . "?page=password_reset");
            exit();
        }
    } else {
        // L'utente non esiste nel database, memorizza un messaggio di errore nella variabile di sessione
        $_SESSION['error_message'] = "L'utente con questa email non esiste. Riprova con un'altra email o procedi con la registrazione.";
        header("Location: " . APP_URL . "?page=password_reset");
        exit();
    }
} else {
    header("Location: " . APP_URL . "?page=login");
}
