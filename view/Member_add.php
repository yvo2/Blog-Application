<?php

require_once 'config.php';

global $config;
$cancel = $config["path"] . "blog?blogId=" . $_GET["blogId"];

  if ($invalid) {
    ?>
    <div class="row" id="alert_box">
      <div class="col s12 m12">
        <div class="card red darken-1">
          <div class="row">
            <div class="col s12 m10">
              <div class="card-content white-text">
                <?php foreach ($validationErrors as $error) { ?>
                  <p><?= $error ?></p>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
 ?>

<form method="post">
  <label>Titel: <input name="title" value="<?= $title ?>" type="text" length="64"></label>
  <label>Inhalt:
    <textarea name="content" class="materialize-textarea"><?= $content ?></textarea>
  </label>
  <input type="submit" class="waves-effect waves-light btn" value="Beitrag erstellen und veröffentlichen">
  <a href="<?= $cancel ?>" class="waves-effect waves-light btn">Abbrechen</a>
</form>
