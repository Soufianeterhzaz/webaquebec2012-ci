<div id="form-content">
  
  <form action="<?php echo base_url() ?>admin/<?php echo $controller ?>/save/" method="post" enctype="multipart/form-data">
    
    <?php if(isset($item->id)): ?>
      <input type="hidden" name="id" value="<?php echo $item->id ?>" />
    <?php endif ?>
    
    <?php $this->load->view('admin/layouts/'.$form_template.'.php') ?>
    
    <div class="button-container clearfix">
      <button type="submit" class="right">Enregister</button>
      <a href="<?php echo base_url() ?>admin/<?php echo $controller ?>/" class="cancel-button button right">Annuler</a>
    </div>
    
  </form>
  
</div>
<div class="spacer"></div>