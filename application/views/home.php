<div class="page-content-block clearfix">

  <?php
  //############################################################################
  //  Vox Pop    ###############################################################
  ?>

  <div class="left-side main">
    <div id="vox-pop" class="white-box">
      <div class="thumb">
        <a class="btn-vox-pop" href="http://vimeo.com/29752446">Écoutez<strong>le Vox Pop</strong></a>
        <img src="<?php echo base_url() ?>assets/img/vox-pop-preview.jpg" alt="Apercu du Vox Pop">
      </div>
      <div class="content">
        <h3>Le Web made in Québec</h3>
        <p>Pour les gens de Québec comme ailleurs, le web est devenu partie intégrante de nos vies. C’est un outil de travail, une industrie florissante, une mine de renseignements et un mode de vie.</p>

      </div>
      <ul class="social-bar list-custom list-hori clearfix">
        <li><span>Suivez-nous</span></li>
        <li><a class="btn-facebook" href="#" title="Suivez-nous sur Facebook">Facebook</a></li>
        <li><a class="btn-twitter" href="#" title="Suivex-nous sur Twitter">Twitter</a></li>
      </ul>
    </div>
  </div>

  <div class="right-side main">

    <?php
    //############################################################################
    //  Important Numbers    #####################################################
    ?>

		<div id="important-numbers">
			<? /* ?>
      <a id="btn-precedent" class="btn-nav" href="#"><span>Précédent</span></a>
      <a id="btn-suivant" class="btn-nav" href="#"><span>Suivant</span></a>
			<? */ ?>
			<ul id="numbers-viewport" class="list-custom list-hori clearfix">
				<?
					$featured = array(
						array(
							'number' => '30',
							'text' => 'conférenciers du <br>Québec'
						),
						array(
							'number' => '48',
							'text' => 'heures de <br>compétition'
						),
						array(
							'number' => '40',
							'text' => 'bénévoles'
						),
						array(
							'number' => '500',
							'text' => 'participants'
						),
						array(
							'number' => '3',
							'text' => 'soirées thématiques'
						)
					);
					shuffle($featured);
					for ($x=0; $x < 3; $x++) { 
					?>
					<li>
						<span class="number"><?=$featured[$x]['number']?></span>
						<h2><?=$featured[$x]['text']?></h2>
					</li>
					<? } ?>
      </ul>
    </div>

    <?php
    //############################################################################
    //  Conferenciers    #########################################################
    ?>

    <div id="conferenciers">
      <ul class="list-custom list-hori clearfix">
        <li>
          <a href="#">
            <span>Nom Conferencier</span>
            <img src="<?php echo base_url() ?>assets/img/conferenciers/ph-conferencier.jpg" alt="Nom Conferencier">
          </a>
        </li>
        <li>
          <a href="#">
            <span>Nom Conferencier</span>
            <img src="<?php echo base_url() ?>assets/img/conferenciers/ph-conferencier.jpg" alt="Nom Conferencier">
          </a>
        </li>
        <li>
          <a href="#">
            <span>Nom Conferencier</span>
            <img src="<?php echo base_url() ?>assets/img/conferenciers/ph-conferencier.jpg" alt="Nom Conferencier">
          </a>
        </li>
        <li>
          <a href="#">
            <span>Nom Conferencier</span>
            <img src="<?php echo base_url() ?>assets/img/conferenciers/ph-conferencier.jpg" alt="Nom Conferencier">
          </a>
        </li>
      </ul>
      <div class="btn-more-wrapper">
        <a href="#" style="clear: both;">Consulter toute la programmation</a>
      </div>
    </div>

  </div>

</div>
<div class="sep-shadow"></div>
<div class="page-content-block clearfix">

  <?php
  //############################################################################
  //  News box    ##############################################################
  ?>

  <div class="left-side main">
    <div id="news-box">
      <h3 class="box-header">Dernières nouvelles</h3>
      <ul class="list-custom">
        <li>
          <h4>Qu’est-ce que le Web à Québec, pour vous?</h4>
          <p>
          Les membres du WAQ se prononcent sur Twitter. Participez à la conversation! #WAQ2012<?//<a href="#">Lire plus</a>?>
          </p>
        </li>
        <li>
          <h4>Les inscriptions au Iron Web sont ouvertes</h4>
          <p>
          Posez votre candidature aujourd’hui pour vivre une expérience inoubliable!<?//<a href="#">Lire plus</a>?>
          </p>
        </li>
        <li>
          <h4>Devenez commanditaire du WAQ 2012</h4>
          <p>
          Près de 25 opportunités de commandites sont offertes. Une belle occasion de vous associer au Web à Québec. Nous sommes aussi à la recherche de commanditaires de services (nourriture, mobilier, etc.) ainsi que de partenaires médias.<?//<a href="#">Lire plus</a>?>
          </p>
        </li>
      </ul>
    </div>

    <div id="newsletter-box">
      <h3>Recevez les dernières nouvelles<span></span></h3>
      <form name="newsletter" id="newsletter" method="post" action="http://webaquebec.createsend.com/t/r/s/akkjhl/" class="clearfix">
        <input id="email" type="text" name="cm-akkjhl-akkjhl" placeholder="Votre courriel">
        <button id="btn-submit-nl" class="btn">M’abonner</button>
      </form>
    </div>

  </div>

  <?php
  //############################################################################
  //  Home two column    #######################################################
  ?>

  <div class="right-side main">
    <div class="left-side rs-content-box iron-web">
      <h3 class="box-header">Iron Web</h3>
      <div class="white-thumb">
        <a class="btn-vox-pop" href="http://vimeo.com/29847338">Retour sur le <strong>IronWeb 2011</strong></a>
      </div>
      <p>Le Iron Web est une compétition de 48 heures, diffusée en direct, par et les passionnés du Web qui désirent participer au projet le plus court mais le plus intense de leur vie.</p>
      <div class="btn-more-wrapper">
        <a href="<?php echo base_url() ?>iron-web/" title="Tout sur la compétition Iron Web">Tout sur la compétition</a>
      </div>
    </div>
    <div class="right-side rs-content-box">
      <h3 class="box-header">Commanditaires principaux</h3>
      <div class="white-thumb">
        <a id="logo-libeo" class="logo-partenaires" href="#">Libéo - Web et applications libres</a>
      </div>
      <p>Sans la participation de ses nombreux commanditaires, le WAQ ne pourrait offrir un tel niveau de qualité à un coût si peu élevé. Merci à tous nos partenaires.</p>
      <div class="btn-more-wrapper">
        <a href="#" title="Tout sur nos fantastiques partenaires">Tout sur les partenaires</a>
      </div>
    </div>
  </div>

</div>



