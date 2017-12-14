<?php
  require_once './config.php';
  require_once 'repository/UserRepository.php';
  require_once 'lib/SessionManager.php';
  global $config;

  $sessionManager = new SessionManager();

  @$selectedBlog = $_GET["blogId"];

  if (isset($selectedBlog)) {
    $userRepository = new UserRepository();
    $user = $userRepository->getById($selectedBlog);
  }
 ?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="<?= $config["path"]; ?>vendors/css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="<?= $config["path"]; ?>vendors/css/style.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
      <nav>
        <div class="nav-wrapper">
          <a href="<?= $config["path"] ?>blog<?php if (isset($selectedBlog)) { echo "?blogId=".$selectedBlog; } ?>" class="brand-logo center"><?php if (isset($user)) { echo $user->name; } else { echo 'Blog'; } ?></a>
          <ul class="left">
            <li><a href="<?= $config["path"] ?>blog/all<?php if (isset($selectedBlog)) { echo "?blogId=".$selectedBlog; } ?>">Mitglied auswählen</a></li>
            <li><a href="<?= $config["path"] ?>blog<?php if (isset($selectedBlog)) { echo "?blogId=".$selectedBlog; } ?>">Blog ansehen</a></li>
            <li><a href="<?= $config["path"] ?>user<?php if (isset($selectedBlog)) { echo "?blogId=".$selectedBlog; } ?>">Profil</a></li>
            <?php if ($sessionManager->isSignedIn()) { ?>
            <li><a href="<?= $config["path"] ?>blog?blogId=<?= $sessionManager->getUserId() ?>">Member-Bereich</a></li>
            <?php } ?>
          </ul>
          <?php if ($sessionManager->isSignedIn()) { ?>
          <ul class="right">
            <li><a href="<?= $config["path"] ?>member<?php if (isset($selectedBlog)) { echo "?blogId=".$selectedBlog; } ?>">Hallo <?= $sessionManager->getUser()->name ?></a></li>
            <li><a href="<?= $config["path"] ?>user/logout<?php if (isset($selectedBlog)) { echo "?blogId=".$selectedBlog; } ?>">Abmelden</a></li>
          </ul
        <?php } else { ?>
          <ul class="right">
            <li><a href="<?= $config["path"] ?>user/login<?php if (isset($selectedBlog)) { echo "?blogId=".$selectedBlog; } ?>">Anmelden</a></li>
            <li><a href="<?= $config["path"] ?>user/register<?php if (isset($selectedBlog)) { echo "?blogId=".$selectedBlog; } ?>">Registrieren</a></li>
          </ul
        <?php } ?>

        </div>
      </nav>

      <div class="container">
        <div class="section">
