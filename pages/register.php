<h1>Crea il tuo account</h1>

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
            <input type="password" name="password" id="password" placeholder="Scrivila qui" required>
        </div>
        <input class="btn" type="submit" value="Registrati"></input>
        <a href="?page=login" class="btn btn-login">Hai già un account? <strong>Accedi</strong></a>
    </form>
</div>