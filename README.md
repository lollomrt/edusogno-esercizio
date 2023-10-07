```sh
FORKATE LA REPO
```

- UTILIZZATE LA STRUTTURA PRESENTE NELLA REPO

- ALL'INTERNO DI assets > db TROVERETE IL FILE DI MIGRAZIONE DEL DB 'Migrations.sql' CON IL NECESSARIO PER CREARE LA TABELLA utenti E eventi E PER MIGRARE I DATI DEGLI EVENTI



==============================================
AGGIORNAMENTO POST SVOLGIMENTO DELL'ESERCIZIO.
==============================================

- Per testare al meglio il lavoro svolto allego in assets > db il file di migrazione 'esercizioMigration.sql', per creare le tabelle e popolarle. Allego il db perchè ho costruito sia una tabella per registrare i token relativi al reset della password, sia perchè ho aggiunto la colonna "admin" alla tabella "utenti" per la gestione della view dashboard admin.

- Per testare la dashboard admin con questo database, fare il login con: email = lorenzomartini.mrt@outlook.it e password = Querty123

- L'APP_URL impostato è 'http://localhost/Boolean/edusogno-esercizio/'. Per cambiarlo basta andare in loader.php.

- Per l'invio della mail di reset ho utilizzato mailtrap e PHPMailer, in quanto ho perso troppo tempo per far funzionare mail() di php (non riuscivo a passare efficacemente l'user_nme e la password dell'hosting SMTP).
