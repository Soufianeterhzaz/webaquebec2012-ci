<td>
  <?php echo $title ?>
</td>
<td>
  <?php
    $speakersNames = array();
    foreach ($speakers as $speaker) {
      $speakersNames[] = $speaker->first_name.' '.$speaker->last_name;
    }
    echo implode(', ', $speakersNames);
  ?>
</td>
<td>
  <?php echo $date ?>
</td>
<td>
  <?php echo $start_hour ?>
</td>
<td>
  <?php echo $end_hour ?>
</td>
<td>
  <?php echo $room ?>
</td>