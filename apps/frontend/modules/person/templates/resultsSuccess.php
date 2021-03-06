<div id="page" data-role="page"  data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Person')) ?>
    <div data-role="content">
        <ul data-role="listview" data-theme="a" data-divider-theme="a" data-inset="false">
            <li data-role="list-divider">
                <?php $event = sfConfig::get('app_event_id') ?>
                <?php echo $event[$eventId]['cellname'] ?>
            </li>
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
                                <div class="mb">
                                    <span class="person-competition-title"><?php echo $round['competitionname'] ?></span><br />
                                </div>
                            <?php endif ?>
                            <div class="mb">
                                <span class="person-round-title"><?php echo $round['roundid'] ?></span><br />
                                <?php if ($round['pos'] == 1): ?>
                                    <span class="person-1st">1st&nbsp;place</span><br />
                                <?php elseif ($round['pos'] == 2): ?>
                                    <span class="person-2nd">2nd&nbsp;place</span><br />
                                <?php elseif ($round['pos'] == 3): ?>
                                    <span class="person-3rd">3rd&nbsp;place</span><br />
                                <?php else: ?>
                                    <span class="person-xth"><?php echo $round['pos'] ?>th&nbsp;place</span><br />
                                <?php endif ?>

                                <?php if ($round['average'] && $round['average_pb']): ?>
                                    <span class="person-rank-title">Average</span>&nbsp;<?php include_partial('global/title_record', array('result' => $round, 'type' => 'average')) ?>&nbsp;<span class="pb"><?php echo $round['average'] ?></span>&nbsp;
                                <?php elseif ($round['average']): ?>
                                    <span class="person-rank-title">Average</span>&nbsp;<?php include_partial('global/title_record', array('result' => $round, 'type' => 'average')) ?>&nbsp;<?php echo $round['average'] ?>&nbsp;
                                <?php endif ?>

                                <?php if ($round['best_pb']): ?>
                                    <span class="person-rank-title">Best</span>&nbsp;<?php include_partial('global/title_record', array('result' => $round, 'type' => 'single')) ?>&nbsp;<span class="pb"><?php echo $round['best'] ?></span><br />
                                <?php else: ?>
                                    <span class="person-rank-title">Best</span>&nbsp;<?php include_partial('global/title_record', array('result' => $round, 'type' => 'single')) ?>&nbsp;<?php echo $round['best'] ?><br />
                                <?php endif ?>
                                <span class="person-subrecord">
                                    <?php foreach($round['subrecord'] as $subrecord):?>
                                        <?php echo $subrecord ?>&nbsp;
                                    <?php endforeach; ?>
                                </span><br />
                            </div>
                         <?php endforeach ?>
                     </a>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
    <?php include_partial('global/footer', array('person_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
