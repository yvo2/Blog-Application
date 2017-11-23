<?php
require_once 'lib/View.php';
require_once 'repository/UserRepository.php';

class UserController {

  public function index() {
    $view = new View('User_index');
    $userRepository = new UserRepository();
    @$selectedBlog = $_GET["blogid"];
    $view->user = $userRepository->getById($selectedBlog);
    $view->display();
  }

  public function login() {
    $view = new View('User_login');

    $view->display();
  }

  public function register() {
    $view = new View('User_register');

    $view->display();
  }

  public function logout() {
    $view = new View('User_logout');

    $view->display();
  }

}

 ?>
