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

$error_message = $session->getErrorMessage();

// Verifica se esiste una variabile di sessione 'success_message' per i messaggi di successo
$success_message = $session->getSuccessMessage();

?>


<?php if ($user['admin'] == 1) : ?>
    <div class="page-title admin-flex">
        <h1>Ciao <?php echo $user['name']; ?>, ecco tutti gli eventi</h1>
        <a href="#" id="crea-evento-button" class="btn-classic" data-action="crea">+ crea evento</a>
    </div>
<?php else : ?>
    <div class="page-title">
        <h1>Ciao <?php echo $user['name']; ?>, ecco i tuoi eventi</h1>
    </div>
<?php endif; ?>

<!-- Display Errorin -->
<?php if (!empty($error_message)) : ?>
    <div class="error-message">
        <?php echo $error_message; ?>
    </div>
<?php endif; ?>

<?php if (!empty($success_message)) : ?>
    <div class="success-message">
        <?php echo $success_message; ?>
    </div>
<?php endif; ?>

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
                    <?php if ($user['admin'] == 1) : ?>
                        <div class="lista-partecipanti">
                            <h3>Partecipanti:</h3>
                            <ul>
                                <!-- Ciclo per visualizzare gli attendees -->
                                <?php foreach ($event->attendees as $attendee) : ?>
                                    <li class="attendee">
                                        <p><?php echo $attendee; ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ($user['admin'] == 1) : ?>
                    <div class="lista-partecipanti button-list">
                        <a href="#" class="btn-classic modifica" data-action="modifica"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="#" class="btn-classic elimina" data-action="elimina" data-event-id="<?php echo $event->id; ?>"><i class="fa-solid fa-trash"></i></a>
                    </div>
                <?php else : ?>
                    <a href="#" class="btn btn-evento"><strong>Join</strong></a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


<!-- Popup -->

<div id="popup-dashboard" class="popup">
    <div id="popup-crea-evento" class="popup-content container-form">
        <div class="popup-intestazione">
            <h2>Crea un nuovo evento</h2>
            <span class="popup-close" id="popup-close-button-crea" data-action="chiudi"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <form id="crea-evento-form" method="POST" action="formActions/addEventAction.php">

            <div class="field">
                <label for="nome_evento">Inserisci il nome dell'evento</label>
                <input type="text" name="nome_evento" placeholder="Nome dell'evento" required>
            </div>
            <div class="field">
                <label for="partecipanti">Seleziona i partecipanti</label>
                <div class="checkbox-container">
                    <?php
                    // Ottiene la lista degli utenti dal database
                    $users = $connector->getAllUsers();

                    if (!empty($users)) {
                        foreach ($users as $user) {
                            // Genera una checkbox per ciascun utente
                            echo '<label class="select-label"><input type="checkbox" name="partecipanti[]" value="' . $user['email'] . '">' . $user['nome'] . ' ' . $user['cognome'] . '</label>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="field">
                <label for="date">Seleziona data</label>
                <input type="datetime-local" name="data_evento" required>
            </div>

            <input class="btn" type="submit" value="crea evento"></input>
        </form>
    </div>
    <div id="popup-modifica-evento" class="popup-content container-form">
        <div class="popup-intestazione">
            <h2>Modifica evento</h2>
            <span class="popup-close" id="popup-close-button-modifica" data-action="chiudi"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <form id="crea-evento-form" method="POST" action="formActions/addEventAction.php">
            <!-- Campi del modulo per la creazione dell'evento -->
            <div class="field">
                <label for="nome_evento">Inserisci il nome dell'evento</label>
                <input type="text" name="nome_evento" placeholder="Nome dell'evento" required>
            </div>
            <div class="field">
                <label for="partecipanti">Seleziona i partecipanti</label>
                <div class="checkbox-container">
                    <?php
                    // Ottieni la lista degli utenti dal database
                    $users = $connector->getAllUsers(); // Assumi che ci sia una funzione per ottenere gli utenti

                    if (!empty($users)) {
                        foreach ($users as $user) {
                            // Genera una checkbox per ciascun utente
                            echo '<label class="select-label"><input type="checkbox" name="partecipanti[]" value="' . $user['email'] . '">' . $user['nome'] . ' ' . $user['cognome'] . '</label>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="field">
                <label for="date">Seleziona data</label>
                <input type="datetime-local" name="data_evento" required>
            </div>
            <!-- Altri campi del modulo, se necessario -->
            <input class="btn" type="submit" value="crea evento"></input>
        </form>
    </div>
    <div id="popup-elimina-evento" class="popup-content container-form">
        <div class="popup-intestazione">
            <h2>Elimina evento.</h2>
            <span class="popup-close" id="popup-close-button-elimina" data-action="chiudi"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <p class="spacer-10">Sicuro di voler eliminare questo evento?</p>
        <form id="crea-evento-form" method="POST" action="formActions/deleteEventAction.php">

            <input type="hidden" name="event_id" value="<?php echo $event->id; ?>">
            <input type="hidden" name="user" value="<?php echo $this->user; ?>">

            <input class="btn" type="submit" value="elimina evento"></input>
        </form>
    </div>
</div>