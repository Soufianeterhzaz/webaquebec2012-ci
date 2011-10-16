<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="fr"><![endif]-->
<!--[if IE 8 ]><html class="ie8" lang="fr"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="fr"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Web à Québec</title>

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

          <h1 class="logo-princ"><span class="logo-accronym t-indent">WAQ</span><span class="logo-full-text to-caps">Le Web à Québec</span></h1>

          <div class="event-details">
            <span class="lieu">Espace 400e Bell. Québec</span>
            <time class="dates" datetime="2012-02-22">22-25 Février 2012</time>
            <a class="btn-inscription t-indent" href="#">Inscription
              <img class="btn-insc-normal" src="assets/img/btn-insc.png" alt="Inscription">
              <img class="btn-insc-hover" src="assets/img/btn-insc-hover.png" alt="Inscription">
            </a>
          </div>

          <nav class="top-right">
            <ul class="list-custom list-hori">
              <li><a href="#">À propos</a></li>
              <li><a href="#">Médias</a></li>
              <li><a href="#">Partenaires</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </nav>

          <nav class="menu-princ">
            <ul class="list-custom">
              <li><a href="#">Horaire et programmation</a></li>
              <li><a href="#">Compétition Iron Web</a></li>
              <li><a href="#">Information pratique</a></li>
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
            <li><a href="#">À propos</a></li>
            <li><a href="#">Médias</a></li>
            <li><a href="#">Partenaires</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
        <div class="footer-box">
          <ul class="list-custom">
            <li><a href="#">Horaire et programmation</a></li>
            <li><a href="#">Compétition Iron Web</a></li>
            <li><a href="#">Information pratique</a></li>
            <li><a href="#">Inscription</a></li>
          </ul>
        </div>
      </div>
    </footer>

  </div>

</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/libs/jquery-1.6.4.min.js'><\/script>")</script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
    function initialize() {
        var latlng = new google.maps.LatLng(46.81714, -71.20547);
        var myOptions = {
          zoom: 15,
          center: latlng,
          scrollwheel: false,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          disableDefaultUI: true
        };
        var map = new google.maps.Map(document.getElementById("googlemaps-footer"), myOptions);

        var marker = new google.maps.Marker({
            position: latlng,
            title:"Web à Québec"
        });

        marker.setMap(map);
    }

    $(function(){ initialize(); });
</script>

</html>