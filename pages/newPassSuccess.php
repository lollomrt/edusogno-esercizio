<?php
require_once 'loader.php';
$session = new Session;

// Verifica se esiste una variabile di sessione 'success_message' per i messaggi di successo
$success_message = $session->getSuccessMessage();
?>

<div class="page-title">
    <h1>Fatto!</h1>
</div>

<div class="container-form container-classic">
    <?php if (!empty($success_message)) : ?>
        <div class="success-message">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>
    <a href="?page=login" class="btn-classic"><strong>Accedi</strong></a>
</div>