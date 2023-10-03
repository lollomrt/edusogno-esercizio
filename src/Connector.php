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

    public function addUser($nome, $cognome, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sth = $this->conn->prepare('INSERT INTO utenti (nome, cognome, email, password) VALUES (:nome, :cognome, :email, :password)');
        $sth->bindParam(':nome', $nome);
        $sth->bindParam(':cognome', $cognome);
        $sth->bindParam(':email', $email);
        $sth->bindParam(':password', $hashedPassword);

        if ($sth->execute()) {
            header('Location: dashboard.php');
            exit;
        } else {
            // Errore nell'inserimento
            return false;
        }
    }
}
