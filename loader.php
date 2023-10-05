<?php
// Dichiarazione delle variabili per le credenziali di Mailtrap
$mailtrapHost = "sandbox.smtp.mailtrap.io";
$mailtrapPort = 2525;
$mailtrapUsername = "d2d4520310b6c2";
$mailtrapPassword = "d0d848bcf3c5a4";

// Configurazione per Mailtrap
ini_set('SMTP', $mailtrapHost);
ini_set('smtp_port', $mailtrapPort);
ini_set('sendmail_from', 'edusogno@example.com');
ini_set('sendmail_path', '/usr/sbin/sendmail -t -i -f edusogno@example.com'); // Può variare a seconda del tuo server
ini_set('auth_username', $mailtrapUsername); // Sostituisci con il tuo nome utente Mailtrap
ini_set('auth_password', $mailtrapPassword); // Sostituisci con la tua password Mailtrap

require_once 'vendor/autoload.php';

define('APP_URL', 'http://localhost/Boolean/edusogno-esercizio/');
require_once('src/Connector.php');
