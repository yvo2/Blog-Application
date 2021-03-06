<?php
require_once 'lib/View.php';
require_once 'lib/SessionManager.php';
require_once 'repository/UserRepository.php';
require_once 'repository/BlogRepository.php';

class BlogController {

  public function index() {
    @$selectedBlog = $_GET["blogId"];

    $blogRepository = new BlogRepository();
    $userRepository = new UserRepository();

    $view = new View('Blog_index');

    if (isset($selectedBlog)) {
          $sessionManager = new SessionManager();

          $view->user = $userRepository->getById($selectedBlog);
          $view->blogEntries = $blogRepository->getByUserId($selectedBlog);
          $view->canEdit = $sessionManager->getUserId() == $view->user->id;
    }

    $view->display();
  }

  public function single() {
    @$selectedBlog = $_GET["blogId"];
    @$entryId = $_GET["entryId"];

    $blogRepository = new BlogRepository();
    $userRepository = new UserRepository();
    $sessionManager = new SessionManager();

    $view = new View('Blog_single');

    if (isset($selectedBlog)) {
          $view->user = $userRepository->getById($selectedBlog);
          $view->blogEntry = $blogRepository->getById($entryId);
    }

    if ($view->user->id == $sessionManager->getUserId()) {
      $view->hasPermission = true;
    } else {
      $view->hasPermission = false;
    }

    $view->display();
  }

  public function all() {
    $userRepository = new UserRepository();
    $users = $userRepository->getAll();

    $view = new View('Blog_all');
    $view->users = $users;
    $view->display();
  }

}

 ?>
