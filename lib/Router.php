<?php
require_once 'config.php';

class Router {

  public function route($path) {
    global $config;
    if (substr($path, 0, strlen($config["path"])) !== $config["path"]) {
      die("Configuration error: Invalid path specified in config (Expected actual REQUEST_URI " . $path . " to start with given PATH " . $config["path"] . ")");
    }
    var_dump($path);

  }

}

 ?>
