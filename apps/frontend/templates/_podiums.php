<?php foreach ($podiums as $year => $values): ?>
    <li data-role="list-divider">
        <?php echo $year ?><br />
    </li>
    <?php foreach ($values as $podium): ?>
        <?php foreach (sfConfig::get('app_event_id') as $event => $value): ?>
            <?php if ((string)$event == $podium['eventid']): ?>
                <li>
                    <a href="<?php echo url_for('competition/detail?competitionId='.$podium['competitionid']) ?>" class="ui-link-inherit">
                        <?php if ($podium['pos'] == 1): ?>
                            <span class="person-1st">1st&nbsp;place</span><br />
                        <?php elseif ($podium['pos'] == 2): ?>
                            <span class="person-2nd">2nd&nbsp;place</span><br />
                        <?php elseif ($podium['pos'] == 3): ?>
                            <span class="person-3rd">3rd&nbsp;place</span><br />
                        <?php endif ?>
                        <span class="event-name"><?php echo $value['cellname'] ?></span><br />
                        <?php if ($podium['average']): ?>
                            <span class="person-rank-title">Average</span>&nbsp;<?php include_partial('global/title_record', array('podium' => $podium, 'type' => 'average')) ?>&nbsp;<?php echo $podium['average'] ?>&nbsp;
                        <?php endif ?>
                        <span class="person-rank-title">Best</span>&nbsp;<?php include_partial('global/title_record', array('podium' => $podium, 'type' => 'single')) ?>&nbsp;<?php echo $podium['best'] ?><br />
                        <span class="person-subrecord">
                            <?php foreach($podium['subrecord'] as $subrecord):?>
                                <?php echo $subrecord ?>&nbsp;
                            <?php endforeach; ?>
                        </span><br />
                    </a>
                </li>
            <?php endif ?>
        <?php endforeach ?>
    <?php endforeach ?>
<?php endforeach ?>
