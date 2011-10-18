<!DOCTYPE html>
<!--[if IE 7]><html class="no-js ie7" lang="fr"><![endif]-->
<!--[if IE 8]><html class="no-js ie8" lang="fr"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="fr"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php echo isset($title) ? $title . ' | ' : '' ?>Web à Québec</title>

    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" />

    <?php if (ENVIRONMENT == 'production'): ?>
    <script>
    /*
      TODO CHANGE GA ACCOUNT ID
    */
    var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'XXXXXXXXXXXXXXXXXXXXXX']);
        _gaq.push(['_trackPageview']);
        (function() {
          var ga = document.createElement('script'); ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <?php endif ?>

    <script src="<?php echo base_url(); ?>assets/js/libs/modernizr-html5-shim.js"></script>
  
</head>

<body>
  <div class="ow">

    <div id="page">

      <?php
      //###################################################################
      //  HEADER   ########################################################
      ?>
      <header>
        <div class="wrapper clearfix">

          <a href="<?php echo base_url() ?>">
            <div class="logo-princ">
              <span class="logo-accronym t-indent">WAQ</span>
              <span class="logo-full-text to-caps">Le Web à Québec</span>
            </div>
          </a>

          <div class="event-details">
            <span class="lieu">Espace 400e Bell. Québec</span>
            <time class="dates" datetime="2012-02-22">22-25 Février 2012</time>
            <a class="btn-inscription t-indent" href="<?php echo base_url() ?>inscription/">Inscription
              <img class="btn-insc-normal" src="<?php echo base_url() ?>assets/img/btn-insc.png" alt="Inscription">
              <img class="btn-insc-hover" src="<?php echo base_url() ?>assets/img/btn-insc-hover.png" alt="Inscription">
            </a>
          </div>

          <nav class="top-right">
            <ul class="list-custom list-hori">
              <li><a href="<?php echo base_url() ?>a-propos/">À propos</a></li>
              <li><a>Médias</a></li>
              <li><a href="<?php echo base_url() ?>partenaires/">Partenaires</a></li>
              <li><a href="<?php echo base_url() ?>contact/">Contact</a></li>
            </ul>
          </nav>

          <nav class="menu-princ">
            <ul class="list-custom">
              <li><a>Horaire et programmation</a></li>
              <li><a href="<?php echo base_url() ?>iron-web/">Compétition Iron Web</a></li>
              <li><a href="<?php echo base_url() ?>informations-pratiques/">Informations pratiques</a></li>
            </ul>
          </nav>

        </div>
      </header>

      <?php 
      //###################################################################
      //  MAIN CONTENT   ##################################################
      ?>

      <div id="page-content">
        <div class="wrapper clearfix">
          <?php if(isset($page_content)): ?>

          <?php echo $page_content; ?>

          <?php endif; ?>
        </div>
      </div>

    </div>

    <?php
    //###################################################################
    //  FOOTER   ########################################################
    ?>

    <footer>
      <div class="wrapper clearfix">
        <div class="google-map">
          <div id="googlemaps-footer"></div>
        </div>

        <h2 class="t-indent">WAQ</h2>
        <address id="main-address">
          <strong>Adresse de l'événement</strong>
          100 rue Quai St-André<br>
          Québec (Qc) G1K 3Y2
        </address>
        <div class="footer-box">
          <address>
            <strong>Siège social</strong>
            305 Charest Est, bureau 901<br>
            Québec (Qc) G1K 3H3<br>
            418 647-3877
          </address>
        </div>
        <div class="footer-box">
          <ul class="list-custom">
            <li><a href="<?php echo base_url() ?>a-propos/">À propos</a></li>
            <li><a href="<?php echo base_url() ?>medias/">Médias</a></li>
            <li><a href="<?php echo base_url() ?>partenaires/">Partenaires</a></li>
            <li><a href="<?php echo base_url() ?>contact/">Contact</a></li>
          </ul>
        </div>
        <div class="footer-box">
          <ul class="list-custom">
            <li><a href="<?php echo base_url() ?>programmation/">Horaire et programmation</a></li>
            <li><a href="<?php echo base_url() ?>iron-web/">Compétition Iron Web</a></li>
            <li><a href="<?php echo base_url() ?>informations-pratiques/">Information pratique</a></li>
            <li><a href="<?php echo base_url() ?>inscription/">Inscription</a></li>
          </ul>
        </div>
      </div>
    </footer>

  </div>

</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/libs/jquery-1.6.4.min.js'><\/script>")</script>
<script src="http://maps.google.com/maps/api/js?sensor=false&amp;language=fr_ca"></script>
<script src="<?php echo base_url(); ?>assets/js/global.js"></script>

</html>
