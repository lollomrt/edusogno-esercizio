<?php

require_once '../loader.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $session = new Session;

    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = $session->setUserSession($email, $password);

    if ($check) {
        header("Location: " . APP_URL . "?page=dashboard");
        exit();
    } else {
        // Accesso fallito, mostra un messaggio di errore
        $session->setErrorMessage("Credenziali non valide. Riprova.");
        header("Location: " . APP_URL . "?page=login");
        exit();
    }
}
