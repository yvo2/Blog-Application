<?php
require_once 'config.php';
require_once 'lib/View.php';
require_once 'lib/SessionManager.php';
require_once 'repository/BlogRepository.php';

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

  public function add() {
    $sessionManager = new SessionManager();
    if (!$sessionManager->isSignedIn()) {
      $view = new View('No_access');
      $view->display();
      exit();
    }

    @$title = $_POST["title"];
    @$content = $_POST["content"];

    $view = new View('Member_add');
    $view->invalid = false;
    $view->validationErrors = array();

    $view->title = $title;
    $view->content = $content;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      if (!isset($title)) {
        $view->invalid = true;
        array_push($view->properties['validationErrors'], "Bitte gib einen Titel ein.");
      }

      if (!isset($content)) {
        $view->invalid = true;
        array_push($view->properties['validationErrors'], "Bitte gib einen Text ein.");
      }

      if (isset($title) && strlen($title) < 1) {
        $view->invalid = true;
        array_push($view->properties['validationErrors'], "Der Titel muss mindestens ein Zeichen enthalten.");
      }

      if (isset($title) && strlen($title) > 65) {
        $view->invalid = true;
        array_push($view->properties['validationErrors'], "Der Titel darf maximal 65 Zeichen enthalten.");
      }

      if (isset($content) && strlen($content) < 4) {
        $view->invalid = true;
        array_push($view->properties['validationErrors'], "Der Inhalt muss mindestens 4 Zeichen lang sein.");
      }

      if (!$view->invalid) {

        $escapedTitle = htmlentities($title);
        $escapedContent = htmlentities($content);
        $userId = $sessionManager->getUserId();

        $blogRepository = new BlogRepository();

        if ($blogRepository->add($userId, $escapedTitle, $escapedContent)) {
          $lastId = $blogRepository->getLastInserted($userId);
          global $config;
          header("Location:{$config["path"]}blog/single?blogid=" . $userId . "&entryId=" . $lastId);
        }
      }

    }

    $view->display();
  }

}

 ?>
