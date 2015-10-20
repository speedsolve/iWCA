<div id="page" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Ranking')) ?>
    <div data-role="content">
        <ul data-role="listview" data-theme="a" data-dividertheme="b">
            <?php foreach($results as $result): ?>
                <li>
                    <?php if ($type == 'rank'): ?>
                        <a href="<?php echo url_for('person/detail?id='.$result['personid']) ?>" class="ui-link-inherit">
                            <?php echo $result['rank'] ?>.&nbsp;<?php echo image_tag('flag/' . $result['personcountryid'] . '.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:5px;')) ?>&nbsp;<?php echo $result['personname'] ?><br />
                            <?php echo $result['record'] ?>&nbsp;<span class="ranking-prize-point">pt</span><br />
                            <?php foreach (sfConfig::get('app_event_id') as $event => $target): ?>
                                <?php if (!in_array($event, sfConfig::get('app_event_abolition'))): ?>
                                    <?php if ($target['format'] == 'Average'): ?>
                                        <?php if ($result[$event] == $counts[$event] + 1): ?>
                                            <span class="rank-event-title"><?php echo $event ?></span>&nbsp;<span class="rank-event-dead-rank"><?php echo $result[$event] ?></span>
                                        <?php else: ?>
                                            <span class="rank-event-title"><?php echo $event ?></span>&nbsp;<span class="rank-event-rank"><?php echo $result[$event] ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo url_for('person/detail?id='.$result['personid']) ?>" class="ui-link-inherit">
                            <?php echo $result['rank'] ?>.&nbsp;<?php echo image_tag('flag/' . $result['personcountryid'] . '.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:5px;')) ?>&nbsp;<?php echo $result['personname'] ?><br />
                            <?php echo $result['record'] ?><br />
                            <span class="subrecord">
                                <?php foreach($result['subrecord'] as $subrecord):?>
                                    <?php echo $subrecord ?>&nbsp;
                                <?php endforeach; ?>
                            </span><br />
                            <span class="competition-name"><?php echo $result['competitionname'] ?></span><br />
                        </a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php include_partial('global/footer',  array('ranking_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
