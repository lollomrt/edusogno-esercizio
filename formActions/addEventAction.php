<?php

require_once '../loader.php';

$session = new Session;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $connector = new Connector();
    $connector->setUpConnection();

    $user = $session->getUserSession();

    // Riceve i dati dal form
    $attendees = $_POST['partecipanti'];
    $eventName = $_POST['nome_evento'];
    $eventDate = $_POST['data_evento'];

    if (empty($attendees) || empty($eventName) || empty($eventDate)) {
        header("Location:" . APP_URL . "?page=dashboard");
        $session->setErrorMessage("Devi compilare tutti i campi!.");
        exit();
    } else {
        // Chiama la funzione addEvent del tuo EventController
        $eventController = new EventController($connector);
        $success = $eventController->addEvent($attendees, $eventName, $eventDate, $user);

        if ($success) {
            // L'aggiunta è riuscita,  reindirizzara l'utente 
            header("Location:" . APP_URL . "?page=dashboard");
            $session->setSuccessMessage("Evento creato con successo!");
            exit();
        } else {
            // Se l'aggiunta ha causato un errore
            header("Location:" . APP_URL . "?page=dashboard");
            $session->setErrorMessage("Qualcosa è andato storto. Riprova.");
        }
    }
}
