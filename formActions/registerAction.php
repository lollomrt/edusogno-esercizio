<?php

require_once '../loader.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Crea un'istanza di Connector e imposta la connessione al database
    $connector = new Connector();
    $connector->setUpConnection();

    $nome = $_POST['first_name'];
    $cognome = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $connector->addUser($nome, $cognome, $email, $password);
}
