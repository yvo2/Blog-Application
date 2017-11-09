<?php
require_once 'lib/View.php';

class DefaultController {

  public function index() {
    $view = new View('Default_index');
    $view->display();
  }

}

 ?>
