<?php
require_once 'loader.php';
$session = new Session;

// Verifica se esiste una variabile di sessione 'error_message'
$error_message = $session->getErrorMessage();

// Verifica se esiste una variabile di sessione 'success_message' per i messaggi di successo
$success_message = $session->getSuccessMessage();
?>

<div class="page-title">
    <h1>Resetta la tua password</h1>
</div>

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
        <input class="btn" name="reset-request-submit" type="submit" value="Invia il link"></input>
        <div class="button-container">
            <span>Non hai ancora un profilo?</span>
            <a href="?page=register" class="btn btn-login"><strong>Registrati</strong></a>
        </div>
    </form>
</div>