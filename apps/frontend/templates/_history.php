<?php foreach (sfConfig::get('app_event_id') as $event => $value): ?>
    <?php foreach ($histories[$event] as $history): ?>
        <?php if ($target == $history['regionalsinglerecord']): ?>
            <li>
                <a href="<?php echo url_for('competition/detail?competitionId='.$history['competitionid']) ?>" class="ui-link-inherit">
                    <span class="event-name"><?php echo $value['cellname'] ?></span><br />
                    <?php echo $history['best'] ?><br />
                    <span class="competition-name"><?php echo $history['competitionname'] ?>,&nbsp;&nbsp;<?php echo $history['roundid'] ?></span><br />
                </a>
            </li>
        <?php endif ?>
        <?php if ($target == $history['regionalaveragerecord']): ?>
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
        <?php // 大陸記録 ?>
        <?php foreach ($target as $record): ?>
            <?php if ($record == $history['regionalsinglerecord']): ?>
                <li>
                    <a href="<?php echo url_for('competition/detail?competitionId='.$history['competitionid']) ?>" class="ui-link-inherit">
                        <span class="event-name"><?php echo $value['cellname'] ?></span><br />
                        <?php echo $history['best'] ?><br />
                        <span class="competition-name"><?php echo $history['competitionname'] ?>,&nbsp;&nbsp;<?php echo $history['roundid'] ?></span><br />
                    </a>
                </li>
            <?php endif ?>
            <?php if ($record == $history['regionalaveragerecord']): ?>
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
<?php endforeach ?>
