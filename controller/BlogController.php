<?php
require_once 'lib/View.php';
require_once 'repository/UserRepository.php';
require_once 'repository/BlogRepository.php';

class BlogController {

  public function index() {
    @$selectedBlog = $_GET["blogid"];

    $blogRepository = new BlogRepository();
    $userRepository = new UserRepository();

    $view = new View('Blog_index');

    if (isset($selectedBlog)) {
          $view->user = $userRepository->getById($selectedBlog);
          $view->blogEntries = $blogRepository->getByUserId($selectedBlog);
    }

    $view->display();
  }

  public function single() {
    @$selectedBlog = $_GET["blogid"];
    @$entryId = $_GET["entryId"];

    $blogRepository = new BlogRepository();
    $userRepository = new UserRepository();

    $view = new View('Blog_single');

    if (isset($selectedBlog)) {
          $view->user = $userRepository->getById($selectedBlog);
          $view->blogEntry = $blogRepository->getById($entryId);
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
