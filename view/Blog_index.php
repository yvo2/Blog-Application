<?php
if (isset($blogEntries)) {
  if (count($blogEntries) == 0) {
    ?>
      <h2>Noch keine Blogbeiträge vorhanden.</h2>
      <span>Dieser User wird bestimmt bald seinen ersten Eintrag veröffentlichen!</span>
    <?php
  } else {
    while ($blogEntry = $blogEntries->fetch_object()) {
      $blogEntry->content = str_replace("\n", "<br>", $blogEntry->content);

      ?>
        <div class="blog-entry">
          <h3 class="blog-title"><?= $blogEntry->title ?></h3><h5 class="blog-date"><?= $blogEntry->createdAt ?>, <?= $user->name ?></h5>
          <div class="clearfix"></div>
          <div class="blog-content"><?= $blogEntry->content ?></div>
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
