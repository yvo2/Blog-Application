<?php
require_once 'lib/View.php';
require_once 'lib/SessionManager.php';
require_once 'repository/UserRepository.php';
require_once 'config.php';

class UserController {

  public function index() {
    $view = new View('User_index');
    $userRepository = new UserRepository();
    @$selectedBlog = $_GET["blogId"];
    $view->user = $userRepository->getById($selectedBlog);
    $view->display();
  }

  public function login() {
    $view = new View('User_login');
    $view->invalid = false;
    $view->validationErrors = array();

    @$email = $_POST["email"];
    @$password = $_POST["password"];

    $view->email = $email;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $userRepository = new UserRepository();

      if (!isset($email) || strlen($email) == 0) {
        $view->invalid = true;
        array_push($view->properties['validationErrors'], "Bitte gib eine valide Email-Adresse ein.");
      }

      if (!isset($password) || strlen($password) == 0) {
        $view->invalid = true;
        array_push($view->properties['validationErrors'], "Bitte gib ein valides Passwort ein.");
      }

      if (!$userRepository->checkCredentials($email, $password) && !$view->invalid) {
        $view->invalid = true;
        array_push($view->properties['validationErrors'], "Die Email-Passwort-Kombination ist nicht korrekt.");
      }

      if (!$view->invalid) {
        $sessionHandler = new SessionManager();
        var_dump($sessionHandler->isSignedIn());

        $user = $userRepository->getByCredentials($email, $password);

        $sessionHandler->signInAsId($user->id);
        global $config;
        $path = $config["path"];
        header("Location:{$path}user?blogId=" . $user->id);
        die("Login successfull.");
      }
    }

    $view->display();
  }

  public function register() {
    $view = new View('User_register');
    $view->invalid = false;
    $view->validationErrors = array();

    @$email = $_POST["email"];
    @$name = $_POST["name"];
    @$password = $_POST["password"];
    @$passwordRepeat = $_POST["password-repeat"];

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

      if ($password != $passwordRepeat) {
        $view->invalid = true;
        array_push($view->properties['validationErrors'], "Die Passwörter stimmen nicht überein.");
      }

      if (!$view->invalid) {
        $userRepository->register($email, $name, $password);

        global $config;
        $path = $config["path"];
        header("Location: {$path}user/login?registered=true");
        die("Registered successfully.");
      }
    }

    $view->display();
  }

  public function logout() {
    $sessionManager = new SessionManager();
    $sessionManager->logout();

    global $config;
    $path = $config["path"];
    header("Location: {$path}");
    die("Logged out successfully.");
  }

}

 ?>
