<div id="page" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Ranking')) ?>
    <div data-role="content">
        <ul data-role="listview" data-theme="a" data-dividertheme="b">
            <?php foreach($results as $result): ?>
                <li>
                    <?php if ($type == 'prize'): ?>
                        <a href="<?php echo url_for('person/detail?id='.$result['personid']) ?>" class="ui-link-inherit">
                            <?php echo $result['rank'] ?>.&nbsp;<?php echo image_tag('flag/' . $result['personcountryid'] . '.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:5px;')) ?>&nbsp;<?php echo $result['personname'] ?><br />
                            <?php echo $result['record'] ?>&nbsp;<span class="ranking-prize-point">pt</span><br />
                            <?php if (isset($result['first'])): ?>
                                <span class="ranking-prize-1st">1st</span>&nbsp;&nbsp;<span class="ranking-prize-count"><?php echo $result['first'] ?></span>&nbsp;
                            <?php endif ?>
                            <?php if (isset($result['second'])): ?>
                                <span class="ranking-prize-2nd">2nd</span>&nbsp;&nbsp;<span class="ranking-prize-count"><?php echo $result['second'] ?></span>&nbsp;
                            <?php endif ?>
                            <?php if (isset($result['third'])): ?>
                                <span class="ranking-prize-3rd">3rd</span>&nbsp;&nbsp;<span class="ranking-prize-count"><?php echo $result['third'] ?></span>&nbsp;
                            <?php endif ?>
                        </a>
                    <?php elseif ($type == 'rank'): ?>
                        <?php echo $result['rank'] ?>.&nbsp;<?php echo image_tag('flag/' . $result['personcountryid'] . '.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:5px;')) ?>&nbsp;<?php echo $result['personname'] ?><br />
                        <?php echo $result['record'] ?>&nbsp;<span class="ranking-prize-point">pt</span><br />
                        <?php foreach (sfConfig::get('app_event_id') as $event => $target): ?>
                            <?php if (!in_array($event, sfConfig::get('app_event_abolition'))): ?>
                                <?php if ($result[$event] == $counts[$event] + 1): ?>
                                    <span class="rank-event-title"><?php echo $event ?></span>&nbsp;<span class="rank-event-dead-rank"><?php echo $result[$event] ?></span>
                                <?php else: ?>
                                    <span class="rank-event-title"><?php echo $event ?></span>&nbsp;<span class="rank-event-rank"><?php echo $result[$event] ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <a href="<?php echo url_for('person/detail?id='.$result['personid']) ?>" class="ui-link-inherit">
                            <?php echo $result['rank'] ?>.&nbsp;<?php echo image_tag('flag/' . $result['personcountryid'] . '.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:5px;')) ?>&nbsp;<?php echo $result['personname'] ?><br />
                            <?php echo $result['record'] ?><br />
                            <span class="competition-name"><?php echo $result['competitionname'] ?></span><br />
                        </a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php include_partial('global/footer', array('ranking_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
