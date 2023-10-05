<?php

require_once '../loader.php';

$session = new Session;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Crea un'istanza di Connector e imposta la connessione al database
    $connector = new Connector();
    $connector->setUpConnection();

    $nome = $_POST['first_name'];
    $cognome = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($connector->isUserExists($email)) {
        // L'utente esiste già, gestisci l'errore
        $session->setErrorMessage("L'utente con questa email esiste già. Riprova con un'altra email o procedi con il login!");
        header("Location: " . APP_URL . "?page=register");
        exit();
    } else {
        // L'utente non esiste ancora, quindi si procede con l'aggiunta
        if ($connector->addUser($nome, $cognome, $email, $password)) {
            // Redirect dell'utente registrato alla dashboard con dati salvati in sessione
            $session->setUserSession($email, $password);
            header("Location: " . APP_URL . "?page=dashboard");
            exit();
        } else {
            // Gestione dell'errore in caso di altri problemi
            $session->setErrorMessage("Si è verificato un errore durante la registrazione. Riprova più tardi.");
            header("Location: " . APP_URL . "?page=register");
            exit();
        }
    }
}
