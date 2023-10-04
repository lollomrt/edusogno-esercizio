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

<h1>Login</h1>

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
                <a href="#" class="btn btn-login"><strong>Password dimenticata?</strong></a>
            </div>
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="Scrivila qui" required>
                <i class="fa-solid fa-eye" id="eye"></i>
            </div>
        </div>
        <input class="btn" type="submit" value="Accedi"></input>
        <div class="button-container">
            <span>Non hai ancora un profilo?</span>
            <a href="?page=register" class="btn btn-login"><strong>Registrati</strong></a>
        </div>
    </form>
</div>