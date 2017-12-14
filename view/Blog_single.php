<?php

  require_once 'config.php';

  $blogEntry->content = str_replace("\r\n", "<br>", $blogEntry->content);
  global $config;

 ?>
<div class="blog-entry">
  <h3 class="blog-title"><?= $blogEntry->title ?></h3><h5 class="blog-date"><?= $blogEntry->createdAt ?>, <?= $user->name ?></h5>
  <div class="clearfix"></div>
  <div class="blog-content"><?= $blogEntry->content ?></div>
  <?php
    if ($hasPermission) {
      ?>
        <br>
        <hr>
        <a href="<?= $config["path"] . "member/edit?blogId=" . $_GET["blogId"] . "&entryId=" . $_GET["entryId"] ?>">Bearbeiten</a> |
        <a href="<?= $config["path"] . "member/delete?blogId=" . $_GET["blogId"] . "&entryId=" . $_GET["entryId"] ?>">Löschen</a>
      <?php
    }
  ?>
</div>
