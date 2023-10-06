<?php

require_once '../loader.php';

$session = new Session;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $connector = new Connector();
    $connector->setUpConnection();

    // Ricevi i dati dal form
    $attendees = $_POST['partecipanti'];
    $eventName = $_POST['nome_evento'];
    $eventDate = $_POST['data_evento'];

    // Chiama la funzione addEvent del tuo EventController
    $eventController = new EventController($connector);
    $success = $eventController->addEvent($attendees, $eventName, $eventDate);

    if ($success) {
        // L'aggiunta è riuscita, puoi reindirizzare l'utente o fare altre azioni
        header("Location: ?page=dashboard.php");
        exit();
    } else {
        // Se l'aggiunta ha causato un errore, gestiscilo in modo appropriato
        // Ad esempio, impostando un messaggio di errore da visualizzare sulla pagina
        $error_message = "Errore durante l'aggiunta dell'evento.";
    }
}
