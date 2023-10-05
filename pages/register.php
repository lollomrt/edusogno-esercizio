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
?>

<h1>Crea il tuo account</h1>

<!-- Aggiungi questo blocco di codice prima del tuo modulo di login -->
<?php if (!empty($error_message)) : ?>
    <div class="error-message">
        <?php echo $error_message; ?>
    </div>
<?php endif; ?>

<div class="container-form">
    <form method="POST" action="formActions/registerAction.php">
        <div class="field">
            <label for="first_name">Inserisci il nome</label>
            <input type="text" name="first_name" id="first_name" placeholder="Mario" required>
        </div>
        <div class="field">
            <label for="last_name">Inserisci il cognome</label>
            <input type="text" name="last_name" id="last_name" placeholder="Rossi" required>
        </div>
        <div class="field">
            <label for="email">Inserisci l'email</label>
            <input type="email" name="email" id="email" placeholder="name@exemple.com" required>
        </div>
        <div class="field">
            <label for="password">Inserisci la password</label>
            <div class="password-container">
                <input type="password" name="password" class="password-input" placeholder="Scrivila qui" required>
                <i class="fa-solid fa-eye toggle-password-visibility" id="eye"></i>
            </div>
        </div>
        <input class="btn" type="submit" value="Registrati"></input>
        <a href="?page=login" class="btn btn-login">Hai già un account? <strong>Accedi</strong></a>
    </form>
</div>