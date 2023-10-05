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

<h1>Crea la tua nuova password</h1>

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
            <div class="pass-label-container">
                <label for="password">Inserisci la nuova password</label>
            </div>
            <div class="password-container">
                <input type="password" name="password" class="password-input" placeholder="Scrivila qui" required>
                <i class="fa-solid fa-eye toggle-password-visibility"></i>
            </div>
        </div>
        <div class="field">
            <div class="pass-label-container">
                <label for="password">Ripeti la nuova password</label>
            </div>
            <div class="password-container">
                <input type="password" name="password" class="password-input" placeholder="Scrivila qui" required>
                <i class="fa-solid fa-eye toggle-password-visibility"></i>
            </div>
        </div>
        <input class="btn" name="" type="submit" value="Conferma Password"></input>
        <div class="button-container">
            <span>Non hai ancora un profilo?</span>
            <a href="?page=register" class="btn btn-login"><strong>Registrati</strong></a>
        </div>
    </form>
</div>