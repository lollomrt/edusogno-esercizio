<?php

require_once 'loader.php';

session_start();
$connector = new Connector();
$connector->setUpConnection();

// Verifica se l'utente è esiste ed è loggato
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    $user_id = $_SESSION['user_id'];
    $user_email = $_SESSION['user_email'];

    $user_name = $connector->getUserName($user_id);
    $user_events = $connector->getUserEventsByEmail($user_email);
    if (empty($user_events)) {
        $no_events_message = "Nessun evento disponibile al momento.";
    }
} else {
    header("Location: index.php");
    exit();
}

?>

<div class="page-title">
    <h1>Ciao <?php echo $user_name; ?>, ecco i tuoi eventi</h1>
</div>

<div class="container-eventi">
    <?php if (!empty($no_events_message)) : ?>
        <div class="no-event-container">
            <p class="no-event-message"><?php echo $no_events_message; ?></p>
        </div>
    <?php else : ?>
        <!-- Ciclo per visualizzare gli eventi -->
        <?php foreach ($user_events as $event) : ?>
            <div class="evento">
                <div class="intestazione">
                    <h2><?php echo $event['nome_evento']; ?></h2>
                    <p>Data: <?php echo $event['data_evento']; ?></p>
                </div>
                <a href="#" class="btn btn-evento"><strong>Join</strong></a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>