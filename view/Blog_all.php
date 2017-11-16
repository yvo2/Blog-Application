<div>Wähle ein Mitglied aus:</div><br>
<?php
@$selectedBlog = $_GET["blogid"];
while ($row = $users->fetch_object()) {
  if ($selectedBlog == $row->id) {
    ?>
        <span class="waves-effect waves-light btn half-width button-margin disabled left"><?= $row->name ?></span>
    <?php
  } else {
    ?>
        <a class="waves-effect waves-light btn half-width button-margin left" href="?blogid=<?= $row->id ?>"><?= $row->name ?></a>
    <?php
  }
}
?>
