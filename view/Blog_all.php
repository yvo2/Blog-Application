Wähle einen Blog aus<br>
<?php
while ($row = $users->fetch_object()) {
?>
    <a class="waves-effect waves-light btn full-width" href="?blogid=<?= $row->id ?>"><?= $row->name ?></a>
<?php
}
?>
