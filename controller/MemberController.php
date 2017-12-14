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

        $escapedTitle = htmlspecialchars($title);
        $escapedContent = htmlspecialchars($content);
        $userId = $sessionManager->getUserId();

        $blogRepository = new BlogRepository();

        if ($blogRepository->add($userId, $escapedTitle, $escapedContent)) {
          $lastId = $blogRepository->getLastInserted($userId);
          global $config;
          header("Location:{$config["path"]}blog/single?blogId=" . $userId . "&entryId=" . $lastId);
        }
      }

    }

    $view->display();
  }

  public function edit() {
    //@$selectedBlog = $_GET["blogId"];
    @$entryId = $_GET["entryId"];

    $sessionManager = new SessionManager();
    if (!$sessionManager->isSignedIn()) {
      $view = new View('No_access');
      $view->display();
      exit();
    }

    @$title = $_POST["title"];
    @$content = $_POST["content"];

    if ($title == null || $content == null) {
      $blogRepository = new BlogRepository();

      $blog = $blogRepository->getById($entryId);

      if ($blog->userId != $sessionManager->getUserId()) {
        $view = new View('No_access');
        $view->display();
        exit();
      }

      $title = $blog->title;
      $content = $blog->content;
    }

    $view = new View('Member_edit');
    $view->invalid = false;
    $view->validationErrors = array();

    $view->title = $title;
    $view->content = $content;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      // TODO: Auslagern
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

        $escapedTitle = htmlspecialchars($title);
        $escapedContent = htmlspecialchars($content);
        $userId = $sessionManager->getUserId();

        $blogRepository = new BlogRepository();

        $oldBlog = $blogRepository->getById($entryId);

        if ($oldBlog->userId != $userId) {
          $view = new View('No_access');
          $view->display();
          exit();
        }

        $response = $blogRepository->edit($entryId, $escapedTitle, $escapedContent);

        if ($response) {
          global $config;
          header("Location:{$config["path"]}blog/single?blogId=" . $userId . "&entryId=" . $entryId);
        }
      }

    }

    $view->display();
  }

  public function delete() {
    @$entryId = $_GET["entryId"];

    $sessionManager = new SessionManager();
    if (!$sessionManager->isSignedIn()) {
      $view = new View('No_access');
      $view->display();
      exit();
    }

    $blogRepository = new BlogRepository();

    $blog = $blogRepository->getById($entryId);

    if ($blog->userId != $sessionManager->getUserId()) {
      $view = new View('No_access');
      $view->display();
      exit();
    }

    $view = new View('Member_delete');

    $view->title = $blog->title;
    $view->content = $blog->content;
    $view->userId = $sessionManager->getUserId();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (!$view->invalid) {
        $userId = $sessionManager->getUserId();

        $blogRepository = new BlogRepository();

        $oldBlog = $blogRepository->getById($entryId);

        if ($oldBlog->userId != $userId) {
          $view = new View('No_access');
          $view->display();
          exit();
        }

        $response = $blogRepository->delete($entryId);

        if ($response) {
          global $config;
          header("Location:{$config["path"]}blog?blogId=" . $userId);
        }
      }

    }

    $view->display();
  }

}

 ?>
