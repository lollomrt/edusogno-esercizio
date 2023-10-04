<?php

require_once '../loader.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Crea un'istanza di Connector e imposta la connessione al database
    $connector = new Connector();
    $connector->setUpConnection();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $connector->getUser($email, $password);

    var_dump($user);

    if ($user) {
        // Accesso riuscito, memorizza le informazioni dell'utente nella sessione
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        var_dump($user);

        header("Location: " . APP_URL . "?page=dashboard");
        exit();
    } else {
        // Accesso fallito, mostra un messaggio di errore
        $error_message = "Credenziali non valide. Riprova.";
        $error_message = "Credenziali non valide. Riprova.";
        $_SESSION['error_message'] = $error_message;
        header("Location: " . APP_URL . "?page=login");
        exit();
    }
}
