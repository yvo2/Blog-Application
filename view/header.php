<?php
  require_once './config.php';
  global $config;
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
          <a href="#!" class="brand-logo center">Blog</a>
          <ul class="left">
            <li><a href="<?= $config["path"] ?>blog/all">Blog auswählen</a></li>
            <li><a href="<?= $config["path"] ?>blog">Ansehen</a></li>
            <!--<li class="active"><a href="collapsible.html">JavaScript</a></li>-->
          </ul>
        </div>
      </nav>

      <div class="container">
        <div class="section">
