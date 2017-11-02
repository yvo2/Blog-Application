<?php
require_once 'lib/Router.php';

/**
 * Blog Application for Module 133 (GIBB)
 * Written by Yvo Hofer and Lars Bärtschi
 * Main entry point
 */

$router = new Router();
$router->route($_SERVER["REQUEST_URI"]);

?>
