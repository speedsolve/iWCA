<?php foreach (sfConfig::get('app_event_id') as $event => $value): ?>
    <?php foreach ($histories[$event] as $history): ?>
        <?php if ($history['regionalsinglerecord']): ?>
            <li>
                <a href="<?php echo url_for('competition/detail?competitionId='.$history['competitionid']) ?>" class="ui-link-inherit">
                    <span class="event-name"><?php echo $value['cellname'] ?></span><br />
                    <?php echo $history['best'] ?><br />
                    <span class="competition-name"><?php echo $history['competitionname'] ?>,&nbsp;&nbsp;<?php echo $history['roundid'] ?></span><br />
                </a>
            </li>
        <?php endif ?>
        <?php if ($history['regionalaveragerecord']): ?>
            <li>
                <a href="<?php echo url_for('competition/detail?competitionId='.$history['competitionid']) ?>" class="ui-link-inherit">
                    <span class="event-name"><?php echo $value['cellname'] ?></span><br />
                    <?php echo $history['average'] ?><br />
                    <span class="subrecord">
                        <?php foreach($history['subrecord'] as $subrecord):?>
                            <?php echo $subrecord ?>&nbsp;
                        <?php endforeach; ?>
                    </span><br />
                    <span class="competition-name"><?php echo $history['competitionname'] ?>&nbsp;&nbsp;<?php echo $history['roundid'] ?></span><br />
                </a>
            </li>
        <?php endif ?>
    <?php endforeach ?>
<?php endforeach ?>
