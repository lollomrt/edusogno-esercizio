<?php
// Dichiarazione delle variabili per le credenziali di Mailtrap
$mailtrapHost = "sandbox.smtp.mailtrap.io";
$mailtrapPort = 2525;
$mailtrapUsername = "d2d4520310b6c2";
$mailtrapPassword = "d0d848bcf3c5a4";

require_once 'vendor/autoload.php';

define('APP_URL', 'http://localhost/Boolean/edusogno-esercizio/');
require_once('src/Connector.php');
require_once('src/Session.php');
require_once('src/Event.php');
require_once('src/EventController.php');
