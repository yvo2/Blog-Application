<?php
require_once 'lib/View.php';
require_once 'lib/SessionManager.php';

class MemberController {

  public function index() {
    $sessionManager = new SessionManager();
    if (!$sessionManager->isSignedIn()) {
      $view = new View('No_access');
      $view->display();
      exit();
    }

    $view = new View('Member_index');

    $view->display();
  }

}

 ?>
