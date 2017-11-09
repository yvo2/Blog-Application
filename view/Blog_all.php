Wähle einen Blog aus<br>
<?php
while ($row = $users->fetch_object()) {
?>
    <a class="waves-effect waves-light btn full-width"><?= $row->name ?></a>
<?php
}
?>
