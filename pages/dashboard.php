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
} else {
    header("Location: index.php");
    exit();
}

?>


<h1>Ciao <?php echo $user_name; ?>, ecco i tuoi eventi</h1>