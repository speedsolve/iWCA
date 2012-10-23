<?php if ($result['regionalsinglerecord'] == 'WR' && $type == 'single'): ?>
    <span class="world_record">WR</span>
<?php elseif($result['regionalaveragerecord'] == 'WR' && $type == 'average'): ?>
    <span class="world_record">WR</span>
<?php elseif ($result['regionalsinglerecord'] == 'NR' && $type == 'single'): ?>
    <span class="national_record">NR</span>
<?php elseif ($result['regionalaveragerecord'] == 'NR' && $type == 'average'): ?>
    <span class="national_record">NR</span>
<?php elseif ($result['regionalsinglerecord'] != '' && $type == 'single'): ?>
    <span class="continent_record"><?php echo $result['regionalsinglerecord'] ?></span>
<?php elseif ($result['regionalaveragerecord'] != '' && $type == 'average'): ?>
    <span class="continent_record"><?php echo $result['regionalaveragerecord'] ?></span>
<?php endif ?>
