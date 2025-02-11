<?php

class Connector
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "esercizio_edusogno";

    public $conn;
    public function setUpConnection()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            // Imposta l'attributo per generare eccezioni in caso di errori
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // echo "Connessione al database riuscita!";
        } catch (PDOException $e) {
            echo "Connessione al database fallita: " . $e->getMessage();
        }
    }


    public function getEvents($email = false)
    {
        if (!$email) {
            $sth = $this->conn->prepare("SELECT * FROM eventi");
        } else {
            $sth = $this->conn->prepare("SELECT * FROM eventi WHERE FIND_IN_SET(:user_email, attendees) > 0");
            $sth->bindParam(':user_email', $email);
        }
        $sth->execute();
        return $sth->fetchAll();
    }

    public function insertEvent($attendees, $eventName, $eventDate)
    {
        try {
            // Prepara la query SQL per l'inserimento dell'evento
            $query = "INSERT INTO eventi (attendees, nome_evento, data_evento) VALUES (:attendees, :nome_evento, :data_evento)";

            // Prepara la dichiarazione SQL
            $stmt = $this->conn->prepare($query);

            // Associa i parametri
            $stmt->bindParam(":attendees", $attendees);
            $stmt->bindParam(":nome_evento", $eventName);
            $stmt->bindParam(":data_evento", $eventDate);

            // Esegue la query
            $stmt->execute();

            // Verifica se l'inserimento è riuscito
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                throw new Exception("Errore nell'inserimento dell'evento nel database.");
            }
        } catch (PDOException $e) {
            // Gestisce l'errore
            throw new Exception("Errore nell'aggiunta dell'evento: " . $e->getMessage());
        }
    }

    public function updateEvent($id, $attendees, $eventName, $eventDate)
    {

        try {
            // Prepara la query SQL per l'aggiornamento dell'evento
            $query = "UPDATE eventi SET attendees = :attendees, nome_evento = :name, data_evento = :date WHERE id = :eventId";

            // Prepara la dichiarazione SQL
            $stmt = $this->conn->prepare($query);

            // Associa i parametri
            $stmt->bindParam(":attendees", $attendees);
            $stmt->bindParam(":name", $eventName);
            $stmt->bindParam(":date", $eventDate);
            $stmt->bindParam(":eventId", $id);

            // Esegui la query
            $stmt->execute();

            // Verifica se l'aggiornamento è riuscito
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                throw new Exception("Errore nell'aggiornamento dell'evento nel database.");
            }
        } catch (PDOException $e) {
            // Gestisce l'errore
            throw new Exception("Errore nell'aggiornamento dell'evento nel database: " . $e->getMessage());
        }
    }

    public function deleteEventById($eventId)
    {
        try {
            $query = "DELETE FROM eventi WHERE id = :eventId";
            // Prepara la query SQL
            $stmt = $this->conn->prepare($query);
            // Associa il valore dell'ID dell'evento alla query
            $stmt->bindParam(':eventId', $eventId);
            // Esegue la query per eliminare l'evento
            $stmt->execute();

            // Verifica se l'evento è stato eliminato con successo
            if ($stmt->rowCount() > 0) {
                return true; // Restituisce true se l'eliminazione è riuscita
            } else {
                return false; // Restituisce false se l'eliminazione non ha avuto successo
            }
        } catch (PDOException $e) {

            error_log('Errore durante l\'eliminazione dell\'evento: ' . $e->getMessage());
            return false; // Restituisce false in caso di errore
        }
    }

    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function addUser($nome, $cognome, $email, $password)
    {
        $hashedPassword = $this->hashPassword($password);

        $sth = $this->conn->prepare('INSERT INTO utenti (nome, cognome, email, password) VALUES (:nome, :cognome, :email, :password)');
        $sth->bindParam(':nome', $nome);
        $sth->bindParam(':cognome', $cognome);
        $sth->bindParam(':email', $email);
        $sth->bindParam(':password', $hashedPassword);

        if ($sth->execute()) {
            return true;
        } else {
            // Errore nell'inserimento
            echo "\nPDOStatement::errorInfo():\n";
            $arr = $sth->errorInfo();
            print_r($arr);
            return false;
        }
    }

    public function isUserExists($email)
    {
        $sth = $this->conn->prepare("SELECT COUNT(*) FROM utenti WHERE email = :email");
        $sth->bindParam(':email', $email);
        $sth->execute();

        $count = $sth->fetchColumn();

        return $count > 0; // Restituisce true se l'utente esiste già, altrimenti false
    }

    public function getUser($email, $password)
    {

        $hashedPassword = $this->hashPassword($password);

        $sth = $this->conn->prepare("SELECT * FROM utenti WHERE email = :email");
        $sth->bindParam(':email', $email);
        $sth->execute();

        // Si ottiene il risultato della query come array associativo
        $user = $sth->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function getUserName($user_id)
    {
        // Esegue una query SQL per ottenere il nome dell'utente dal database
        $query = "SELECT nome, cognome FROM utenti WHERE id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Estrae il nome dell'utente
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['nome'] . ' ' . $result['cognome'];
        } else {
            return 'Nome non disponibile'; // Messaggio di fallback nel caso in cui il nome non sia disponibile
        }
    }

    public function getUserADmin($user_id)
    {
        // Esegue una query SQL per ottenere il nome dell'utente dal database
        $query = "SELECT admin FROM utenti WHERE id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Estrae il nome dell'utente
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['admin'];
        } else {
            return 'Admin non disponibile'; // Messaggio di fallback nel caso in cui il nome non sia disponibile
        }
    }

    public function getAllUsers()
    {
        // Esegue una query SQL per ottenere il nome dell'utente dal database
        $query = "SELECT * FROM utenti";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        // Estrae il nome dell'utente
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            return 'Non ci sono utenti disponibile'; // Messaggio di fallback nel caso in cui il nome non sia disponibile
        }
    }


    public function createPasswordResetToken($email)
    {

        $token = bin2hex(random_bytes(32)); // Generazione di un token

        date_default_timezone_set('Europe/Rome');

        $tokenExpiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        try {
            // Prepara la query SQL per l'inserimento del token di reset
            $sql = "INSERT INTO password_reset_tokens (user_email, token, expiry) VALUES (:email, :token, :expiry)";
            $stmt = $this->conn->prepare($sql);

            // Esegue l'inserimento dei dati
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':expiry', $tokenExpiry);

            if ($stmt->execute()) {
                return $token; // Restituisce true se l'inserimento ha avuto successo
            } else {
                // Errore nell'inserimento
                echo "\nPDOStatement::errorInfo():\n";
                $arr = $stmt->errorInfo();
                print_r($arr);
                return false;
            }
        } catch (PDOException $e) {
            // Gestisci eventuali errori di connessione al database
            echo "Errore di connessione al database: " . $e->getMessage();
            return false;
        }
    }

    public function isValidPasswordResetToken($token)
    {
        // Verifica se il token è valido e non scaduto
        $query = "SELECT * FROM password_reset_tokens WHERE token = :token AND expiry >= NOW()";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function updatePasswordUsingToken($token, $newPassword)
    {
        // Recupera l'ID dell'utente associato al token
        $query = "SELECT user_email FROM password_reset_tokens WHERE token = :token";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $email = $result['user_email'];

        // Aggiorna la password dell'utente nel database
        $hashedPassword = $this->hashPassword($newPassword);
        $query = "UPDATE utenti SET password = :password WHERE email = :user_email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':user_email', $email);
        $stmt->execute();
    }

    public function invalidatePasswordResetToken($token)
    {
        // Invalida il token rendendolo scaduto (puoi anche rimuoverlo dal database)
        $query = "UPDATE password_reset_tokens SET expiry = NOW() WHERE token = :token";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
    }
}
