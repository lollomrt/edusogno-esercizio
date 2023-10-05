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

<div class="page-title">
    <h1>Login</h1>
</div>


<!-- Aggiungi questo blocco di codice prima del tuo modulo di login -->
<?php if (!empty($error_message)) : ?>
    <div class="error-message">
        <?php echo $error_message; ?>
    </div>
<?php endif; ?>

<div class="container-form">
    <form method="POST" action="formActions/loginAction.php">

        <div class="field">
            <label for="email">Inserisci l'email</label>
            <input type="email" name="email" id="email" placeholder="name@exemple.com" required>
        </div>
        <div class="field">
            <div class="pass-label-container">
                <label for="password">Inserisci la password</label>
                <a href="?page=password_reset" class="btn btn-login"><strong>Password dimenticata?</strong></a>
            </div>
            <div class="password-container">
                <input type="password" name="password" class="password-input" placeholder="Scrivila qui" required>
                <i class="fa-solid fa-eye toggle-password-visibility" id="eye"></i>
            </div>
            <a href="?page=password_reset" class="btn btn-login pass-mobile"><strong>Password dimenticata?</strong></a>
        </div>
        <input class="btn" type="submit" value="Accedi"></input>
        <div class="button-container">
            <span>Non hai ancora un profilo?</span>
            <a href="?page=register" class="btn btn-login"><strong>Registrati</strong></a>
        </div>
    </form>
</div>