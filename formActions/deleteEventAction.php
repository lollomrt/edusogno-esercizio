<?php

require_once '../loader.php';

$session = new Session;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
    $eventId = $_POST['event_id'];

    $connector = new Connector();
    $connector->setUpConnection();

    // Riceve i dati dal form
    $eventId = $_POST['event_id'];
    $user = $_POST['user'];

    // Verifica se l'utente ha i permessi per eliminare l'evento
    if ($user['admin'] == 0) {
        // Procedi con l'eliminazione dell'evento
        if ($eventController->deleteEvent($eventId)) {
            // Evento eliminato con successo
            $session->setSuccessMessage('Evento eliminato con successo');
            header("Location:" . APP_URL . "?page=dashboard");
            exit();
        } else {
            // Errore durante l'eliminazione dell'evento
            $session->setErrorMessage('Errore durante l\'eliminazione dell\'evento');
            header("Location::" . APP_URL . "?page=dashboard");
            exit();
        }
    } else {
        // L'utente non ha i permessi per eliminare l'evento
        $session->setErrorMessage('Non hai i permessi per eliminare l\'evento');
        header("Location::" . APP_URL . "?page=dashboard");
        exit();
    }
}
