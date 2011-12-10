<div id="sidebar">
  <nav>
    <h1>Événement</h1>

    <ul>
      <li <?php echo ($controller == 'speaker') ? 'class="active"' : '' ?>>
        <a id="sidebar-speakers" href="<?php echo base_url() ?>admin/speaker/">Conférenciers</a>
      </li>
      <li <?php echo ($controller == 'talk') ? 'class="active"' : '' ?>>
        <a id="sidebar-talks" href="<?php echo base_url() ?>admin/talk/">Conférences</a>
      </li>
    </ul>

  </nav>

  <? /*
  <nav>
    <h1>Iron web</h1>

    <ul>

    </ul>

  </nav>
  */ ?>

</div>