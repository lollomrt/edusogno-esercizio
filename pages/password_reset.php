<?php
require_once 'loader.php';
session_start();

// Verifica se esiste una variabile di sessione 'error_message'
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    // Rimuovi la variabile di sessione dopo averla utilizzata
    unset($_SESSION['error_message']);
} else {
    $error_message = "";
}

// Verifica se esiste una variabile di sessione 'success_message' per i messaggi di successo
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    // Rimuovi la variabile di sessione dopo averla utilizzata
    unset($_SESSION['success_message']);
} else {
    $success_message = "";
}
?>

<h1>Resetta la tua password</h1>

<!-- Aggiungi questo blocco di codice prima del tuo modulo di login -->
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

<div class="container-form">
    <form method="POST" action="formActions/resetAction.php">
        <div class="field">
            <label for="email">Inserisci l'email</label>
            <input type="email" name="email" id="email" placeholder="name@exemple.com" required>
        </div>
        <input class="btn" name="reset-request-submit" type="submit" value="Invia il link per il reset"></input>
        <div class="button-container">
            <span>Non hai ancora un profilo?</span>
            <a href="?page=register" class="btn btn-login"><strong>Registrati</strong></a>
        </div>
    </form>
</div>