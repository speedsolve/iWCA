<div id="page" data-role="page"  data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Competition')) ?>
    <div data-role="content">
        <ul data-role="listview" data-inset="true" class="ui-listview">
            <li>
                <?php echo image_tag('flag/' . $competition['countryid'] . '@2x.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:6px;')) ?><?php echo $competition['name'] ?><br />
                <?php if ($competition['day'] == $competition['endday']): ?>
                    <span class="competition-detail-date"><?php echo $competition['year'].'/'.$competition['month'].'/'.$competition['day'] ?></span><br />
                <?php else: ?>
                    <span class="competition-detail-date"><?php echo $competition['year'].'/'.$competition['month'].'/'.$competition['day'] ?>&nbsp;-&nbsp;<?php echo $competition['endmonth'].'/'.$competition['endday'] ?></span><br />
                <?php endif ?>
            </li>
        </ul>
        <ul data-role="listview" data-inset="true" class="ui-listview">
            <li>
                <?php echo $competition['cityname'].',&nbsp;'.$competition['countryid'] ?><br />
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
                                        <?php echo $key + 1 ?>.&nbsp;<?php echo image_tag('flag/' . $winner['personcountryid'] . '@2x.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:5px;')) ?>&nbsp;<?php echo $winner['personname'] ?><br />
                                        <?php if ($winner['average']): ?>
                                            <span class="winner-rank-title">Average</span>&nbsp;&nbsp;<?php echo $winner['average'] ?>&nbsp;
                                        <?php endif ?>
                                        <span class="winner-rank-title">Best</span>&nbsp;&nbsp;<?php echo $winner['best'] ?><br />
                                        <?php if ($winner['average']): ?>
                                            <span class="winner-subrecord">
                                                <?php foreach($winner['subrecord'] as $subrecord):?>
                                                    <?php echo $subrecord ?>&nbsp;
                                                <?php endforeach; ?>
                                            </span><br />
                                        <?php endif ?>
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

