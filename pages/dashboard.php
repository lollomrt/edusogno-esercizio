<h1>Dashboard</h1>
<?php
$connector = new Connector();
$connector->setUpConnection();

$result = $connector->getEvents();
var_dump($result);
