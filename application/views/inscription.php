<?php
$this->load->helper('form');
?>
<div class="ros-wrapper">
  <div class="page-content-block clearfix">
    <div class="left-side main">
      <?php $this->load->view('iron_web_voxpop') ?>
    </div>
    <div class="right-side main">
      <div class="full-width rs-content-box">
        <h3 class="box-header">Inscription au Iron Web 2012</h3>
        <p>La période d’appel de candidatures pour le Iron Web débute le 18 octobre et se termine le 11 novembre 2011.</p>
        <p>Suite à la réception des candidatures, une présélection sera effectuée par le comité du Iron Web et les candidats retenus seront convoqués à une entrevue. Les personnes sélectionnés pour participer seront contactées rapidement après les entrevues. Toutefois, la formation des équipes demeurera inconnue jusqu’au début de la compétition.</p>
        <p>La participation à la compétition est gratuite, mais un dépôt de 50$ sera exigé des candidats sélectionnés pour l’entrevue.</p> 
      </div>
      <?php if (!$saved): ?>
      <div id="iw-inscriptions" class="full-width rs-content-box">
        <?php echo form_open('inscriptions/'); ?>
        <h3 class="box-header">Indentification</h3>
        <div class="required input text">
          <label for="nom_complet">Nom complet<span class="required">*</span></label>
          <?php echo form_input(array('name'=>'nom_complet', 'value'=>set_value('nom_complet'))); ?>
          <?php echo form_error('nom_complet'); ?>
        </div>
        <div class="required input text">
          <label for="nom_complet">Courriel<span class="required">*</span></label>
          <?php echo form_input(array('name'=>'courriel', 'value'=>set_value('courriel'))); ?>
          <?php echo form_error('courriel'); ?>
        </div>
        <div class="required input text">
          <label for="nom_complet">Téléphone<span class="required">*</span></label>
          <?php echo form_input(array('name'=>'telephone', 'value'=>set_value('telephone'))); ?>
          <?php echo form_error('telephone'); ?>
        </div>
        <div class="required input text">
          <label for="nom_complet">Âge<span class="required">*</span></label>
          <?php echo form_input(array('name'=>'age', 'value'=>set_value('age'))); ?>
          <?php echo form_error('age'); ?>
        </div>
				<label for="etudiant">Étudiant?<span class="required">*</span></label>
        <div class="required input checkbox">
          <label for="etudiant1">Oui</label><input type="radio" id="etudiant1" name="etudiant" value="0" <?php echo set_radio('etudiant', '0'); ?> />
          <label for="etudiant2">Non</label><input type="radio" id="etudiant2" name="etudiant" value="1" <?php echo set_radio('etudiant', '1', TRUE); ?> />
          <?php echo form_error('etudiant'); ?>
        </div>
        <h3 class="box-header">Profil</h3>
        <div class="required input">
          <label for="nom_complet">Votre profil (cv)<span class="required">*</a></label>
          <?php echo form_textarea(array('name'=>'profil', 'value'=>set_value('profil'))); ?>
          <?php echo form_error('profil'); ?>
        </div>
        <div class="required input text">
          <label for="nom_complet">Linkedin<span class="required">*</a></label>
          <?php echo form_input(array('name'=>'linkedin', 'value'=>set_value('linkedin'))); ?>
          <?php echo form_error('linkedin'); ?>
        </div>
        <div class="required input text">
          <label for="nom_complet">Nom d'utilisateur Twitter<span class="required">*</a></label>
          <?php echo form_input(array('name'=>'twitter', 'value'=>set_value('twitter'))); ?>
          <?php echo form_error('twitter'); ?>
        </div>
        <div class="required input">
          <label for="nom_complet">Pourquoi souhaitez vous participer au Iron Web?<span class="required">*</a></label>
          <?php echo form_textarea(array('name'=>'question1', 'value'=>set_value('question1'))); ?>
          <?php echo form_error('question1'); ?>
        </div>
        <div class="required input">
          <label for="nom_complet">Vos 3 meilleurs projets et pourquoi<span class="required">*</a></label>
          <?php echo form_textarea(array('name'=>'question2', 'value'=>set_value('question2'))); ?>
          <?php echo form_error('question2'); ?>
        </div>
        <div class="required input">
          <label for="nom_complet">Naturellement, quel rôle jouez vous dans une équipe?<span class="required">*</a></label>
          <?php echo form_textarea(array('name'=>'question3', 'value'=>set_value('question3'))); ?>
          <?php echo form_error('question3'); ?>
        </div>
        <h3 class="box-header">Informations de santé et d'urgence</h3>
        <div class="required input textarea">
          <label for="nom_complet">Restrictions alimentaires, allergies, maladies ou autres informations importantes sur la santé<span class="required">*</a></label>
          <?php echo form_textarea(array('name'=>'allergies', 'value'=>set_value('allergies'))); ?>
          <?php echo form_error('allergies'); ?>
        </div>
        <div class="required input text">
          <label for="nom_complet">Personne à contacter en cas d'urgence<span class="required">*</a></label>
          <?php echo form_input(array('name'=>'urgenec_nom', 'value'=>set_value('urgenec_nom'))); ?>
          <?php echo form_error('urgenec_nom'); ?>
        </div>
        <div class="required input text">
          <label for="nom_complet">Numéro de la personne à contacter en cas d'urgence<span class="required">*</a></label>
          <?php echo form_input(array('name'=>'urgence_tel', 'value'=>set_value('urgence_tel'))); ?>
          <?php echo form_error('urgence_tel'); ?>
        </div>
				<div class="input submit">
        	<input type="submit" value="Envoyer ma candidature" />
				</div>
      </div>
      <?php else: ?>
        <h3 class="box-header">Inscription complétée</h3>
        <div class="rs-content-box">
					<p>Merci! Nous vous contacterons à <?php echo $_POST['courriel'] ?> après le 11 novembre.
					<p>Bonne chance!</p>
				</div>
      <?php endif ?>
    </div>

  </div>

</div>



