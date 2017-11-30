<?php
require_once 'lib/View.php';
require_once 'repository/UserRepository.php';
require_once 'config.php';

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
    $view->invalid = false;
    $view->validationErrors = array();

    @$email = $_POST["email"];
    @$name = $_POST["name"];
    @$password = $_POST["password"];

    $view->name = $name;
    $view->email = $email;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $userRepository = new UserRepository();

      if (!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $view->invalid = true;
        array_push($view->properties['validationErrors'], "Bitte gib eine valide Email-Adresse ein.");
      }

      if (!isset($password) || strlen($password) < 8) {
        $view->invalid = true;
        array_push($view->properties['validationErrors'], "Bitte gib ein Passwort bestehend aus mindestens 8 Zeichen ein.");
      }

      if ($userRepository->existEmail($email)) {
        $view->invalid = true;
        array_push($view->properties['validationErrors'], "Diese Email-Adresse ist bereits belegt.");
      }

      $userRepository->register($email, $name, $password);

      global $config;
      $path = $config["path"];
      header("Location: {$path}user");
      die("Registered successfully.");
    }

    $view->display();
  }

  public function logout() {
    $view = new View('User_logout');

    $view->display();
  }

}

 ?>
