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

            echo "Connessione al database riuscita!";
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

    public function addUser()
    {
        $sth = $this->conn->prepare("INSERT INTO 'utenti' ('nome', 'cognome', 'email', 'password') VALUES ()");
        $sth->execute();
        return $sth->fetchAll();

        INSERT INTO table_name (column1, column2, column3, ...)
VALUES (value1, value2, value3, ...);
    }
}
