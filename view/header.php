<?php
  require_once './config.php';
  require_once 'repository/UserRepository.php';
  global $config;

  @$selectedBlog = $_GET["blogid"];

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
          <a href="<?= $config["path"] ?>blog<?php if (isset($selectedBlog)) { echo "?blogid=".$selectedBlog; } ?>" class="brand-logo center"><?php if (isset($user)) { echo $user->name; } else { echo 'Blog'; } ?></a>
          <ul class="left">
            <li><a href="<?= $config["path"] ?>blog/all<?php if (isset($selectedBlog)) { echo "?blogid=".$selectedBlog; } ?>">Mitglied auswählen</a></li>
            <li><a href="<?= $config["path"] ?>blog<?php if (isset($selectedBlog)) { echo "?blogid=".$selectedBlog; } ?>">Blog ansehen</a></li>
            <li><a href="<?= $config["path"] ?>user<?php if (isset($selectedBlog)) { echo "?blogid=".$selectedBlog; } ?>">Profil</a></li>
            <!--<li class="active"><a href="collapsible.html">JavaScript</a></li>-->
          </ul>
        </div>
      </nav>

      <div class="container">
        <div class="section">
