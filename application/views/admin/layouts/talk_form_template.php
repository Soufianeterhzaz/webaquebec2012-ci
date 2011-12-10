
<section class="clearfix">
  <header>
    <h1>Conférence</h1>
  </header>

  <label>
    <span class="label">Titre :&nbsp;</span>
    <input type="text" name="title" value="<?php if(isset($item->title)) { echo $item->title; } ?>" />
  </label>

  <label>
    <span class="label">Résumé :&nbsp;</span>
    <textarea id="summary" name="summary"><?php if(isset($item->summary)) { echo $item->summary; } ?></textarea>
  </label>

  <label>
    <span class="label">Description :&nbsp;</span>
    <textarea id="description" name="description"><?php if(isset($item->description)) { echo $item->description; } ?></textarea>
  </label>

  <label>
    <span class="label">Mots-clés :&nbsp;</span>
    <input type="text" name="keywords" value="<?php if(isset($item->keywords)) { echo $item->keywords; } ?>" />
  </label>

  <label>
    <span class="label">Date :&nbsp;</span>
    <input type="text" name="date" value="<?php if(isset($item->date)) { echo $item->date; } ?>" />
    <span class="note">(ex: 2012-02-25)</span>
  </label>

  <label>
    <span class="label">Heure de début :&nbsp;</span>
    <input type="text" name="start_hour" value="<?php if(isset($item->start_hour)) { echo $item->start_hour; } ?>" />
    <span class="note">(ex: 14:30)</span>
  </label>

  <label>
    <span class="label">Heure de fin :&nbsp;</span>
    <input type="text" name="end_hour" value="<?php if(isset($item->end_hour)) { echo $item->end_hour; } ?>" />
    <span class="note">(ex: 14:30)</span>
  </label>

  <label>
    <span class="label">Salle :&nbsp;</span>
    <input type="text" name="room" value="<?php if(isset($item->room)) { echo $item->room; } ?>" />
  </label>

</section>

<section class="clearfix">
  <header class="clearfix">
    <h1>Conférenciers</h1>
  </header>

  <div class="multiple-select clearfix">

    <label class="left">
      <span class="label">Choix de conférenciers :</span>
      <select multiple>
        <?php foreach($speaker_choices as $speaker): ?>

          <option value="<?php echo $speaker->id ?>"><?php echo $speaker->first_name.' '.$speaker->last_name ?></option>

        <?php endforeach ?>
      </select>
    </label>

    <div class="button-container left">
      <span class="button button-add">&gt;</span>
      <span class="button button-remove">&lt;</span>
    </div>

    <label class="right">
      <span class="label">Conférencier(s) sélectionné(s) :</span>
      <select name="speakers[]" multiple>
        <?php if(isset($item->speakers)): ?>

          <?php foreach($item->speakers as $speaker): ?>

            <option value="<?php echo $speaker->id ?>"><?php echo $speaker->first_name.' '.$speaker->last_name ?></option>

          <?php endforeach ?>

        <?php endif ?>
      </select>
    </label>

  </div>

</section>

<script src="<?php echo base_url() ?>assets/js/libs/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>assets/js/libs/ckeditor/adapters/jquery.js"></script>
<script src="<?php echo base_url() ?>assets/js/libs/ckeditor/config.js"></script>

<script>
  $('textarea').ckeditor();
</script>