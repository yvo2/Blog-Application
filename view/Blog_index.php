<?php
require_once './config.php';
global $config;

if ($canEdit) {
  ?>
    <a class="waves-effect waves-light btn" href="<?= $config["path"] ?>member/add?blogid=<?= $selectedBlog ?>">+ Eintrag erstellen</a>
  <?php
}

if (isset($blogEntries)) {
  if ($blogEntries->num_rows == 0) {
    ?>
      <h2>Noch keine Blogbeiträge vorhanden.</h2>
      <span>Dieser User wird bestimmt bald seinen ersten Eintrag veröffentlichen!</span>
    <?php
  } else {
    while ($blogEntry = $blogEntries->fetch_object()) {
      // $blogEntry->content = str_replace("\n", "<br>", $blogEntry->content);

      ?>
        <div class="blog-entry">
          <a href="<?= $config["path"] ?>blog/single?blogid=<?= $selectedBlog ?>&entryId=<?= $blogEntry->id ?>"><h3 class="blog-title"><?= $blogEntry->title ?></h3></a><h5 class="blog-date"><?= $blogEntry->createdAt ?>, <?= $user->name ?></h5>
          <div class="clearfix"></div>
          <div class="blog-content"><?= substr($blogEntry->content, 0, 200); ?>...</div>
          <a href="<?= $config["path"] ?>blog/single?blogid=<?= $selectedBlog ?>&entryId=<?= $blogEntry->id ?>">Weiterlesen</a>
        </div>
      <?php
    }
  }
} else {
  ?>
    <h2>Hier ist (noch) nichts.</h2>
    <a href="<?= $config["path"] ?>blog/all<?php if (isset($selectedBlog)) { echo "?blogid=".$selectedBlog; } ?>">Blog auswählen</a>
  <?php
}

 ?>
