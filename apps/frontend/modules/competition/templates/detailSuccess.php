<div id="page" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Competition')) ?>
    <div data-role="content">
        <ul data-role="listview" data-inset="true" class="ui-listview">
            <li>
                <?php echo image_tag('flag/' . $competition['countryid'] . '.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:6px;')) ?><?php echo $competition['name'] ?><br />
                <?php if ($competition['day'] == $competition['endday']): ?>
                    <span class="competition-detail-date"><?php echo $competition['year'].'/'.$competition['month'].'/'.$competition['day'] ?></span><br />
                <?php else: ?>
                    <span class="competition-detail-date"><?php echo $competition['year'].'/'.$competition['month'].'/'.$competition['day'] ?>&nbsp;-&nbsp;<?php echo $competition['endmonth'].'/'.$competition['endday'] ?></span><br />
                <?php endif ?>
            </li>
        </ul>
        <ul data-role="listview" data-inset="true" class="ui-listview">
            <li>
                <a href="<?php echo url_for('competition/map?competitionId='.$competition['id']) ?>">
                    <?php echo $competition['cityname'].',&nbsp;'.$competition['countryid'] ?><br />
                </a>
            </li>
            <li>
                <?php if (is_object($venue)): ?>
                   <a href="<?php echo $venue[2][0] ?>"><?php echo $venue[1][0] ?></a>
                <?php else: ?>
                   <?php echo $venue ?>
                <?php endif ?>
            </li>
        </ul>
        <?php if ($end): ?>
            <div data-role="collapsible-set" data-theme="a" data-content-theme="a" class="ui-collapsible-set" data-inset="true">
                <div data-role="collapsible">
                    <h2>Winners</h2>
                    <ul data-role="listview" data-theme="a" data-divider-theme="a">
                        <?php foreach (sfConfig::get('app_event_id') as $event => $value): ?>
                            <?php if (isset($winners[$event])): ?>
                               <li data-role="list-divider">
                                    <?php echo $value['cellname'] ?>
                                </li>
                            <?php endif ?>
                            <?php foreach($winners[$event] as $key => $winner): ?>
                                <li>
                                    <a href="<?php echo url_for('person/detail?id='.$winner['personid']) ?>" class="ui-link-inherit">
                                        <?php echo $key + 1 ?>.&nbsp;<?php echo image_tag('flag/' . $winner['personcountryid'] . '.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:5px;')) ?>&nbsp;<?php echo $winner['personname'] ?><br />
                                        <?php if ($winner['average']): ?>
                                            <span class="winner-rank-title">Average</span>&nbsp;<?php include_partial('global/title_record', array('result' => $winner, 'type' => 'average')) ?>&nbsp;<span class="winner-time"><?php echo $winner['average'] ?></span>&nbsp;
                                        <?php endif ?>
                                        <span class="winner-rank-title">Best</span>&nbsp;<?php include_partial('global/title_record', array('result' => $winner, 'type' => 'single')) ?>&nbsp;<span class="winner-time"><?php echo $winner['best'] ?></span><br />
                                        <span class="winner-subrecord">
                                            <?php foreach($winner['subrecord'] as $subrecord):?>
                                                <?php echo $subrecord ?>&nbsp;
                                            <?php endforeach; ?>
                                        </span><br />
                                    </a>
                                </li>
                            <?php endforeach ?>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <ul data-role="listview" data-theme="a" data-inset="true" class="ui-listview">
               <?php foreach ($events as $key => $event): ?>
                    <li>
                        <a href="<?php echo url_for('competition/results?competitionId='.$competition['id'].'&eventId='.$key) ?>" class="ui-link-inherit">
                            <?php echo $event ?><br />
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php else: ?>
            <ul data-role="listview" data-inset="true" class="ui-listview">
                <?php foreach ($events as $key => $event): ?>
                    <li>
                        <?php echo $event ?><br />
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
    <?php include_partial('global/footer', array('competition_class' => 'ui-btn-active ui-state-persist')) ?>
</div>

