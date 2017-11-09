<?php
require_once 'config.php';

class Router {

  public function route($path) {
    global $config;
    if (substr($path, 0, strlen($config["path"])) !== $config["path"]) {
      die("Configuration error: Invalid path specified in config (Expected actual REQUEST_URI " . $path . " to start with given PATH " . $config["path"] . ")");
    }

    $relPath = substr($path, strlen($config["path"]));

    $controller = "Default";
    $action = "index";

    if ($relPath != false) {

      $splitted = explode('/', $relPath);

      if (sizeof($splitted) >= 2) {
        $controller = $splitted[0];
        $action = $splitted[1];
      }
      if (sizeof($splitted) == 1) {
        $controller = $splitted[0];
      }
    }

    $controller .= "Controller";
    require "controller/$controller.php";

    $controllerObject = new $controller();
    $controllerObject->$action();

  }

}

 ?>
