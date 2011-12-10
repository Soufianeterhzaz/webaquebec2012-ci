<section class="clearfix">
  <header>
    <h1>Conférence</h1>
  </header>

  <label>
    <span class="label">Prénom :&nbsp;</span>
    <input type="text" name="first_name" value="<?php if(isset($item->first_name)) { echo $item->first_name; } ?>" />
  </label>

  <label>
    <span class="label">Nom :&nbsp;</span>
    <input type="text" name="last_name" value="<?php if(isset($item->last_name)) { echo $item->last_name; } ?>" />
  </label>

  <label>
    <span class="label">URL :&nbsp;</span>
    <input type="text" name="site_url" value="<?php if(isset($item->site_url)) { echo $item->site_url; } ?>" />
  </label>

  <label>
    <span class="label">Twitter :&nbsp;</span>
    <input type="text" name="twitter_url" value="<?php if(isset($item->twitter_url)) { echo $item->twitter_url; } ?>" />
  </label>

  <label>
    <span class="label">Biographie :&nbsp;</span>
    <textarea id="bio" name="bio"><?php if(isset($item->bio)) { echo $item->bio; } ?></textarea>
  </label>

  <label>
    <span class="label">Photo :&nbsp;</span>
    <input type="file" name="photo_path" />
    <?php if (isset($item->photo_path)): ?>
      <img src="<?php echo $photo_path.'/'.$item->photo_path ?>" />
    <?php endif ?>
  </label>

</section>