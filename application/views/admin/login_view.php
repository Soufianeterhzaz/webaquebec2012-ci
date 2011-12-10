<div id="login-box">

  <img src="<?php echo base_url() ?>assets/img/logo-princ.png" />

  <form action="<?php echo base_url() ?>admin/login/validate_credentials/" method="post">

    <?php if(isset($error)): ?>

      <?php echo $error; ?>

    <?php endif; ?>
    <input type="text" name="username" placeholder="Nom d’utlisateur" autocapitalize="off" autocomplete="on" autocorrect="off" />

    <input type="password" name="password" placeholder="Mot de passe" />

    <div class="button-wrapper">
      <button type="submit">
        <span>Se connecter</span>
      </button>
    </div>
  </form>

</div>