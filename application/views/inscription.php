<?php
$this->load->helper('form');
?>
<div class="ros-wrapper">
  <div class="page-content-block clearfix">

    <?php
    //############################################################################
    //  Vox Pop    ###############################################################
    ?>

    <div class="left-side main">
      <div id="vox-pop" class="white-box">
        <h3>L’expérience Iron Web 2011</h3>
        <div class="thumb">
          <a class="btn-vox-pop" href="http://vimeo.com/29752446">Écoutez<strong>le Vox Pop</strong></a>
          <img src="<?php echo base_url() ?>assets/img/ph-lc-iw.jpg" alt="Apercu du Vox Pop">
        </div>
        <div class="content">
          <p>Que pensent les participants du Iron Web 2011 de leur expérience? Écoutez-les!</p>
        </div>
        <ul class="social-bar list-custom list-hori clearfix">
          <li><span>Suivez-nous</span></li>
          <li><a class="btn-facebook" href="#" title="Suivez-nous sur Facebook">Facebook</a></li>
          <li><a class="btn-twitter" href="#" title="Suivex-nous sur Twitter">Twitter</a></li>
        </ul>
      </div>
    </div>
    <div class="right-side main">
      <div class="full-width rs-content-box">
        <h3 class="box-header">Inscriptions à l'Iron Web</h3>
        <p>La période d’appel de candidatures pour le Iron Web débute le 18 octobre et se termine le 11 novembre 2011.</p>
        <p>Suite à la réception des candidatures, une présélection sera effectuée par le comité du Iron Web et les candidats retenus seront convoqués à une entrevue. Les personnes sélectionnés pour participer seront contactées rapidement après les entrevues. Toutefois, la formation des équipes demeurera inconnue jusqu’au début de la compétition.</p>
        <p>La participation à la compétition est gratuite, mais un dépôt de 50$ sera exigé des candidats sélectionnés pour l’entrevue.</p> 
      </div>
      <?php if (!$saved): ?>
      <div class="full-width rs-content-box">
        <?php echo form_open('inscriptions/'); ?>
        <h3 class="box-header">Indentification</h3>
        <div class="required input">
          <label for="nom_complet">Nom complet</label>
          <?php echo form_input(array('name'=>'nom_complet', 'value'=>set_value('nom_complet'))); ?>
          <?php echo form_error('nom_complet'); ?>
        </div>
        <div class="required input">
          <label for="nom_complet">Courriel</label>
          <?php echo form_input(array('name'=>'courriel', 'value'=>set_value('courriel'))); ?>
          <?php echo form_error('courriel'); ?>
        </div>
        <div class="required input">
          <label for="nom_complet">Téléphone</label>
          <?php echo form_input(array('name'=>'telephone', 'value'=>set_value('telephone'))); ?>
          <?php echo form_error('telephone'); ?>
        </div>
        <div class="required input">
          <label for="nom_complet">Âge</label>
          <?php echo form_input(array('name'=>'age', 'value'=>set_value('age'))); ?>
          <?php echo form_error('age'); ?>
        </div>
        <div class="required input">
          <label for="nom_complet">Étudiant</label>
          Oui<input type="radio" name="etudiant" value="0" <?php echo set_radio('etudiant', '0'); ?> />
          Non<input type="radio" name="etudiant" value="1" <?php echo set_radio('etudiant', '1', TRUE); ?> />
          <?php echo form_error('etudiant'); ?>
        </div>
        <h3 class="box-header">Profil</h3>
        <h3 class="box-header">Informations de santé et d'urgence</h3>
        <input type="submit" value="Envoyer ma candidature" />
      </div>
      <?php else: ?>
        <p>Merci!</p>
      <?php endif ?>
    </div>

  </div>

</div>



