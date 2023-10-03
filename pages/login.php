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
            <label for="password">Inserisci la password</label>
            <input type="password" name="password" id="password" placeholder="Scrivila qui" required>
        </div>
        <input class="btn" type="submit" value="Login"></input>
        <div class="button-container">
            <span>Non hai ancora un profilo?</span>
            <a href="?page=register" class="btn btn-login"><strong>Registrati</strong></a>
        </div>
    </form>
</div>