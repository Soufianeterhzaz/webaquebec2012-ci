<table data-controller="<?php echo $controller; ?>">
  <tr class="table-header">
    <?php foreach($columns as $i => $column): ?>
    
      <th><?php echo $column ?></th>
    
    <?php endforeach ?>
  </tr>
  
  <?php $count = 0; ?>
  
  <?php foreach($list as $item): ?>
    <tr <?php echo ($count % 2 == 0 || $count == 0) ? 'class="odd"' : '' ?> data-id="<?php echo $item->id; ?>">
      
      <?php $this->load->view('admin/layouts/'.$row_template.'.php', $item) ?>
      
    </tr>
    <?php $count++ ?>
  <?php endforeach ?>

</table>

<div class="toolbar">
  <ul class="clearfix">
    <li class="toolbar-button">
      <a href="<?php echo current_url() ?>/add/" id="toolbar-button-add">+</a>
    </li>
    <li class="toolbar-button">
      <a href="<?php echo current_url() ?>/#" id="toolbar-button-delete">-</a>
    </li>
  </ul>
</div>