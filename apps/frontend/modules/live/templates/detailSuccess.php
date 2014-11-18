<div id="page" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => $names['compName'])) ?>
    <div data-role="content">
        <h2><?php echo $names['eventName'] . '&nbsp;-&nbsp;' . $names['roundName'] ?></h2>
        <table class="live_table">
            <thead class="live_thead">
                <tr>
                    <td></td>
                    <td></td>
                    <td class="live_name"><div class="live_div_name">Name</div></td>
                    <td class="live_average"> <div class="live_div_average"><?php echo $type == 'average' ? 'Average' : 'Mean' ?></div></td>
                    <td class="live_best"><div class="live_div_best">Best</div></td>
                </tr>
            </thead>
            <?php foreach ($detail_list as $key => $list): ?>
                <tr class="live_tr_bg_<?php echo $key % 2 + 1 ?>">
                    <td class="<?php echo $list['top_position'] ? 'live_top_position' : 'live_position' ?>"><div class="live_div_position"><?php echo $list['position'] ?></div></td>
                    <td class="live_flag"><?php echo image_tag('flag/' . $list['country'] . '.png', array('class' => 'live_image')) ?></td>
                    <td class="live_name"><div class="live_div_name"><?php echo $list['name'] ?></div></td>
                    <td class="live_average">
                        <div class="live_div_average">
                            <?php $record_type = $type == 'average' ? 'average_record' : 'mean_record' ?>
                            <?php $average = $list['average'] ? $list['average'] : $list['mean'] ?>
                            <?php if ($list[$record_type] == 'WR'): ?>
                                <span class="world_record">WR</span>&nbsp;<?php echo $average ?>
                            <?php elseif ($list[$record_type] == 'CR'): ?>
                                <span class="continent_record">CR</span>&nbsp;<?php echo $average ?>
                            <?php elseif ($list[$record_type] == 'NR'): ?>
                                <span class="national_record">NR</span>&nbsp;<?php echo $average ?>
                            <?php else: ?>
                                <?php echo $average ?>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td class="live_best">
                        <div class="live_div_best">
                            <?php if ($list['best_record'] == 'WR'): ?>
                                <span class="world_record">WR</span>&nbsp;<?php echo $list['best'] ?>
                            <?php elseif ($list['best_record'] == 'CR'): ?>
                                <span class="continent_record">CR</span>&nbsp;<?php echo $list['best'] ?>
                            <?php elseif ($list['best_record'] == 'NR'): ?>
                                <span class="national_record">NR</span>&nbsp;<?php echo $list['best'] ?>
                            <?php else: ?>
                                <?php echo $list['best'] ?>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php include_partial('global/footer', array('live_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
