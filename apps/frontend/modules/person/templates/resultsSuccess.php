<div id="page" data-role="page"  data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Person')) ?>
    <div data-role="content">
        <ul data-role="listview" data-inset="true" class="ui-listview">
            <li>
                <?php $event = sfConfig::get('app_event_id') ?>
                <?php echo $event[$eventId]['cellname'] ?>
            </li>
        </ul>
        <ul data-role="listview" data-theme="a" data-divider-theme="a" data-inset="true">
            <?php foreach($competitions[$eventId] as $competition): ?>
                <li>
                    <a href="<?php echo url_for('competition/detail?competitionId='.$competition[0]['competitionid']) ?>" class="ui-link-inherit">
                        <?php foreach($competition as $key => $round): ?>
                            <?php if ($key == 0): ?>
                                <?php if ($round['day'] == $round['endday']): ?>
                                    <span class="person-competition-date"><?php echo $round['year'].'/'.$round['month'].'/'.$round['day'] ?></span><br />
                                <?php else: ?>
                                    <span class="person-competition-date"><?php echo $round['year'].'/'.$round['month'].'/'.$round['day'] ?>&nbsp;-&nbsp;<?php echo $round['endmonth'].'/'.$round['endday'] ?></span><br />
                                <?php endif ?>
                                <?php echo $round['competitionname'] ?><br />
                            <?php endif ?>
                            <span class="person-round-title"><?php echo $round['roundid'] ?></span><br />
                            <?php if ($round['average']): ?>
                                <span class="person-rank-title">Average</span>&nbsp;&nbsp;<?php echo $round['average'] ?>&nbsp;
                            <?php endif ?>
                            <span class="person-rank-title">Best</span>&nbsp;&nbsp;<?php echo $round['best'] ?><br />
                            <span class="person-subrecord">
                                <?php foreach($round['subrecord'] as $subrecord):?>
                                    <?php echo $subrecord ?>&nbsp;
                                <?php endforeach; ?>
                            </span><br />
                         <?php endforeach ?>
                     </a>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
    <?php include_partial('global/footer', array('person_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
