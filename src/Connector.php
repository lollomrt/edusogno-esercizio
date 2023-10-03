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


    public function getEvents()
    {
        $sth = $this->conn->prepare("SELECT * FROM eventi");
        $sth->execute();
        return $sth->fetchAll();
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

    public function getUser($email, $password)
    {
        var_dump($email, $password);
        var_dump($this->hashPassword($password));
        $hashedPassword = $this->hashPassword($password);

        $sth = $this->conn->prepare("SELECT * FROM utenti WHERE email = :email");
        $sth->bindParam(':email', $email);
        $sth->execute();

        // Si ottiene il risultato della query come array associativo
        $user = $sth->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['password'] == password_verify($password, $hashedPassword)) {
            return $user;
        }

        return false;
    }
}
