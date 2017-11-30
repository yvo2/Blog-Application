<?php
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

<div class="row row-centered">
    <form class="col input-form" method="post">
      <div class="row">
        <div class="input-field col s12">
          <input id="name" type="text" name="name" value="<?= $name ?>" class="validate" required>
          <label for="name">Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" name="email" class="validate" value="<?= $email ?>" required>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" name="password" class="validate" required minlength=8>
          <label for="password">Passwort</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" name="password-repeat" class="validate" required minlength=8>
          <label for="password">Passwort wiederholen</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="submit" type="submit" value="Registrieren" class="waves-effect waves-light btn">
        </div>
      </div>
    </form>
  </div>
