<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="fr"><![endif]-->
<!--[if IE 8 ]><html class="ie8" lang="fr"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="fr"><!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  
  <title>Web à Québec</title>
  
  <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" />
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css" />
  
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
  
  <script src="<?php echo base_url(); ?>assets/js/libs/modernizr-html5-shim.js"></script>
  
</head>

<body>
  <div id="page">
    <header>
    
      <div class="wrapper clearfix">
        WAQ
      </div>  
      
    </header>
    
    <div id="page-content">
      
      <?php if(isset($page_content)): ?>
      
        <?php echo $page_content; ?>
      
      <?php endif; ?>
      
    </div>
    
  </div>
  
  <footer>
    
    <div class="wrapper clearfix">
      
    </div>
    
  </footer>
  
</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/libs/jquery-1.6.4.min.js'><\/script>")</script>

</html>