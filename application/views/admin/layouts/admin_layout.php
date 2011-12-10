<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="fr"><![endif]-->
<!--[if IE 8 ]><html class="ie8" lang="fr"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="fr"><!--<![endif]-->
<head>

  <meta charset="utf-8">

  <title><?php if (isset($title)) { echo $title . " > "; } ?>Admin | WAQ</title>

  <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/libs/skii.ContextualMenu/skii.ContextualMenu.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/libs/skii.SelectInput/skii.SelectInput.css" />

  <script src="<?php echo base_url(); ?>assets/js/libs/modernizr-html5-shim.js"></script>

  <script>var BASEURL = '<?php echo base_url(); ?>';</script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/libs/jquery-1.6.2.min.js'>\x3C/script>");</script>
  <script src="<?php echo base_url(); ?>assets/js/libs/skii.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/libs/skii.ContextualMenu/skii.ContextualMenu.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/libs/skii.SelectInput/skii.SelectInput.min.js"></script>

</head>

<body class="template-admin <?php echo $view ?>">

  <?php if($view != "login_view"): ?>

    <header>

      <div>

        <img id="header-logo" src="<?php echo base_url() ?>assets/img/admin/waq.png" />

        <a id="btn-logout" href="<?php echo base_url() ?>admin/logout/">Se déconnecter</a>


          <ul id="breadcrumbs">

            <li><a id="breadcrumbs-home" class="ir" href="<?php echo base_url() ?>admin/">Home</a></li>
            <?php if(isset($breadcrumbs)): ?>
              <?php foreach($breadcrumbs as $label => $controller): ?>

                <li><a href="<?php echo base_url() ?>admin/<?php echo $controller ?>/"><?php echo $label ?></a></li>

              <?php endforeach ?>
            <?php endif ?>
          </ul>

      </div>

    </header>

    <?php $this->load->view('admin/sidebar') ?>

  <?php else: ?>

    <div id="login-form-background"></div>

  <?php endif ?>

  <?php if($view != "login_view"): ?>
    <div id="page-content">
  <?php endif ?>

  <?php $this->load->view('admin/'.$view) ?>

  <?php if($view != "login_view"): ?>

    </div>
    <script src="<?php echo base_url(); ?>assets/js/admin.js"></script>

  <?php endif ?>

</body>
</html>