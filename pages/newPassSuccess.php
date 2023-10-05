<?php
require_once 'loader.php';
session_start();

// Verifica se esiste una variabile di sessione 'success_message' per i messaggi di successo
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    // Rimuovi la variabile di sessione dopo averla utilizzata
    unset($_SESSION['success_message']);
} else {
    $success_message = "";
}
?>

<h1>Fatto!</h1>

<div class="container-form container-classic">
    <?php if (!empty($success_message)) : ?>
        <div class="success-message">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>
    <a href="?page=login" class="btn-classic"><strong>Accedi</strong></a>
</div>