<?php

require_once 'config.php';

$content = str_replace("\r\n", "<br>", $content);
global $config;
$cancel = $config["path"] . "blog/single?blogId=" . $userId . "&entryId=" . $_GET["entryId"];

 ?>
<form method="post">
  <h3><?= $title ?></h3>
  <div>
    <?= $content ?>
  </div>
  <br />
  <hr>
  <span>Bist du sicher, dass du diesen Eintrag <strong>permanent</strong> entfernen möchtest?</span><br /><br />
  <input type="submit" class="waves-effect waves-light btn  deep-orange accent-3" value="Permanent löschen">
  <a href="<?= $cancel ?>" class="waves-effect waves-light btn">Abbrechen</a>
</form>
