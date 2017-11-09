<?php
require_once 'lib/View.php';
require_once 'repository/UserRepository.php';

class BlogController {

  public function index() {
    $view = new View();
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
