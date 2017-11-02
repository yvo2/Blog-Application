<?php

/**
 * Konfigurationsdatei
 * Bitte Datenbank-Anmeldeinformationen anpassen und diese Datei kopieren zu "config.php"
 */

global $config;
$config = array(
  "deploy"    => 'live',

  "database" => array(
    "host"      => 'localhost:3306',
    "username"  => 'root',
    "password"  => '',
    "database"  => 'routedb'
  )
);

 ?>
