<?php

require_once '../loader.php';

session_start();

// Controllo se c'è una richiesta in post e se viene dal form con name corretto sul submit - Utente che entra correttamente nella pagina.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset-request-submit"])) {
    // Crea un'istanza di Connector e imposta la connessione al database
    $connector = new Connector();
    $connector->setUpConnection();

    $email = $_POST['email'];

    // Verifica se l'utente esiste nel database
    if ($connector->isUserExists($email)) {

        //SPAZIO PER LA GESTIONE DELL'INVIO MAIL

        // Dopo aver inviato l'email, memorizza un messaggio nella variabile di sessione
        $_SESSION['success_message'] = "&#10003; Link per il reset della password inviato! Controlla la tua casella di posta.";
        header("Location: " . APP_URL . "?page=password_reset");
        exit();
    } else {
        // L'utente non esiste nel database, memorizza un messaggio di errore nella variabile di sessione
        $_SESSION['error_message'] = "L'utente con questa email non esiste. Riprova con un'altra email o procedi con la registrazione.";
        header("Location: " . APP_URL . "?page=password_reset");
        exit();
    }
} else {
    header("Location: " . APP_URL . "?page=login");
}
