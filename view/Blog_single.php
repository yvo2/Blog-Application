<?php

  $blogEntry->content = str_replace("\r\n", "<br>", $blogEntry->content);

 ?>
<div class="blog-entry">
  <h3 class="blog-title"><?= $blogEntry->title ?></h3><h5 class="blog-date"><?= $blogEntry->createdAt ?>, <?= $user->name ?></h5>
  <div class="clearfix"></div>
  <div class="blog-content"><?= $blogEntry->content ?></div>
</div>
