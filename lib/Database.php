<?php

/**
 * Database connection
 * Should only be initiated once per request
 */

 class Database {

  /**
  * A connection to the database
  */
  private static $connection = null;

  /**
  * Get the connection to the database
  * Or open an new one if it isn't opened yet
  */
  public static function getConnection() {
    // Not connected?
    if (self::$connection == null) {
      global $config;
      $host = $config['database']['host'];
      $username = $config['database']['username'];
      $password = $config['database']['password'];
      $database = $config['database']['database'];
      // Initialise connection
      self::$connection = new MySQLi($host, $username, $password, $database);
      if (self::$connection->connect_error) {
        $error = self::$connection->connect_error;
        throw new Exception("Fehler beim verbinden zur Datenbank: $error");
      }
      self::$connection->set_charset('utf8');
    }

    return self::$connection;
  }
}

?>
