<?php
$servername = "localhost";  
$username = "root";         
$password = "root";         
$dbname = "esercizio_edusogno";

try {
    // Connessione al database utilizzando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Imposta l'attributo per generare eccezioni in caso di errori
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connessione al database riuscita!";
} catch(PDOException $e) {
    echo "Connessione al database fallita: " . $e->getMessage();
}

// Ora puoi eseguire query SQL o interagire con il database utilizzando PDO
?>
