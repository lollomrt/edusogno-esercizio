<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../loader.php';

session_start();

// Controllo se c'è una richiesta in post e se viene dal form con name corretto sul submit - Utente che entra correttamente nella pagina.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset-password-submit"])) {

    $connector = new Connector();
    $connector->setUpConnection();

    $token = $_POST["token"];
    $newPassword = $_POST["new-password"];
    $confirmNewPassword = $_POST["confirm-new-password"];

    // Valida che le due password corrispondano
    if ($newPassword !== $confirmNewPassword) {
        $_SESSION['error_message'] = "Le password non corrispondono.";
        header("Location: " . APP_URL . "?page=new_password&token=" . $token);
        exit();
    }

    // Verifica che il token sia valido e non scaduto
    if ($connector->isValidPasswordResetToken($token)) {
        // Aggiorna la password dell'utente nel database
        $connector->updatePasswordUsingToken($token, $newPassword);

        // Invalida il token
        $connector->invalidatePasswordResetToken($token);

        $_SESSION['success_message'] = "La password è stata reimpostata con successo. Ora puoi loggarti.";
        header("Location: " . APP_URL . "?page=newPassSuccess");
        exit();
    } else {
        $_SESSION['error_message'] = "Il link di reset non è valido o è scaduto.";
        header("Location: " . APP_URL . "?page=new_password&token=" . $token);
        exit();
    }
}
