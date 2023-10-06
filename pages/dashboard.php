<?php

require_once 'loader.php';

$session = new Session;
$connector = new Connector();
$connector->setUpConnection();

$user = $session->getUserSession();

$eventController = new EventController($connector);
// $events = $eventController->list();

// Verifica se l'utente è esiste ed è loggato
if ($user == false) {
    header("Location: index.php");
    exit();
} else {
    if ($user['admin'] == 0) {
        $events = $eventController->list($user['email']);
    } else {
        $events = $eventController->list();
    }
}

?>

<div class="page-title">
    <h1>Ciao <?php echo $user['name']; ?>, ecco i tuoi eventi</h1>
</div>

<div class="container-eventi">
    <?php if (!empty($no_events_message)) : ?>
        <div class="no-event-container">
            <p class="no-event-message"><?php echo $no_events_message; ?></p>
        </div>
    <?php else : ?>
        <!-- Ciclo per visualizzare gli eventi -->
        <?php foreach ($events as $event) : ?>
            <div class="evento">
                <div class="intestazione">
                    <h2><?php echo $event->name; ?></h2>
                    <p>Data: <?php echo $event->date; ?></p>
                    <?php foreach ($event->attendees as $attendee) : ?>
                        <div class="attendee">
                            <div class="intestazione">
                                <p><?php echo $attendee; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="#" class="btn btn-evento"><strong>Join</strong></a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>