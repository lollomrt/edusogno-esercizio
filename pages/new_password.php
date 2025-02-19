<?php
require_once 'loader.php';
$session = new Session;

// Verifica se esiste una variabile di sessione 'error_message'
$error_message = $session->getErrorMessage();

// Verifica se esiste una variabile di sessione 'success_message' per i messaggi di successo
$success_message = $session->getSuccessMessage();
?>

<div class="page-title">
    <h1>Crea la tua nuova password</h1>
</div>

<?php if (!empty($success_message)) : ?>
    <div class="success-message">
        <?php echo $success_message; ?>
    </div>
<?php endif; ?>

<?php if (!empty($error_message)) : ?>
    <div class="error-message">
        <?php echo $error_message; ?>
    </div>
<?php else : ?>

<?php endif; ?>

<div class="container-form">
    <form method="POST" action="formActions/newPasswordAction.php">
        <div class="field">
            <div class="pass-label-container">
                <label for="new-password">Inserisci la nuova password</label>
            </div>
            <div class="password-container">
                <input type="password" name="new-password" class="password-input" placeholder="Scrivila qui" required>
                <i class="fa-solid fa-eye toggle-password-visibility"></i>
            </div>
        </div>
        <div class="field">
            <div class="pass-label-container">
                <label for="confirm-new-password">Ripeti la nuova password</label>
            </div>
            <div class="password-container">
                <input type="password" name="confirm-new-password" class="password-input" placeholder="Scrivila qui" required>
                <i class="fa-solid fa-eye toggle-password-visibility"></i>
            </div>
        </div>
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <input class="btn" name="reset-password-submit" type="submit" value="Conferma Password"></input>
        <div class="button-container">
            <span>Non hai ancora un profilo?</span>
            <a href="?page=register" class="btn btn-login"><strong>Registrati</strong></a>
        </div>
    </form>
</div>