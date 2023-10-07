<?php

require_once '../loader.php';

$session = new Session;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
    $eventId = $_POST['event_id'];

    $connector = new Connector();
    $connector->setUpConnection();

    // Crea un'istanza della classe EventController
    $eventController = new EventController($connector);

    // Riceve i dati dal form
    $eventId = $_POST['event_id'];
    $user = $session->getUserSession();

    // Riceve i dati dal form
    $eventId = $_POST['event_id'];

    // Verifica se l'utente ha i permessi per eliminare l'evento

    // Procedi con l'eliminazione dell'evento
    if ($eventController->deleteEvent($eventId, $user)) {
        // Evento eliminato con successo
        $session->setSuccessMessage('Evento eliminato con successo');
        header("Location:" . APP_URL . "?page=dashboard");
        exit();
    } else {
        // Errore durante l'eliminazione dell'evento
        $session->setErrorMessage('Errore durante l\'eliminazione dell\'evento');
        header("Location:" . APP_URL . "?page=dashboard");
        exit();
    }
}
