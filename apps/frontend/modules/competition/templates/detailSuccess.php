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
        <?php if (!empty($results)): ?>
            <div data-role="collapsible-set" data-theme="a" data-content-theme="a" class="ui-collapsible-set" data-inset="true">
                <div data-role="collapsible">
                    <h2>Winners</h2>
                    <ul data-role="listview" data-theme="a" data-divider-theme="a">
                        <?php foreach (sfConfig::get('app_event_id') as $event => $value): ?>
                            <?php if (isset($winners[$event])): ?>
                               <li data-role="list-divider">
                                    <span class="winner-titie"><?php echo $value['cellname'] ?></span>
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
            <div data-role="collapsible-set" data-theme="a" data-content-theme="a" class="ui-collapsible-set" data-inset="true">
                <?php foreach ($events as $key => $event): ?>
                <div data-role="collapsible">
                    <h2>
                       <?php echo $event ?><br />
                    </h2>
                    <ul data-role="listview" data-theme="a" data-divider-theme="a">
                        <?php foreach (sfConfig::get('app_round_id') as $roundid => $value): ?>
                            <?php if (isset($competition_resutls[$key])): ?>
                               <li data-role="list-divider">
                                    <span class="winner-titie"><?php echo $value['name'] ?></span>
                                </li>
                            <?php endif ?>
                            <?php foreach($competition_results[$key][$value['name']] as $id => $result): ?>
                                <li>
                                    <a href="<?php echo url_for('person/detail?id='.$result['personid']) ?>" class="ui-link-inherit">
                                        <?php echo $id + 1 ?>.&nbsp;<?php echo image_tag('flag/' . $result['personcountryid'] . '@2x.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:5px;')) ?>&nbsp;<?php echo $result['personname'] ?><br />
                                        <?php if ($result['average']): ?>
                                            <span class="winner-rank-title">Average</span>&nbsp;&nbsp;<?php echo $result['average'] ?>&nbsp;
                                        <?php endif ?>
                                        <span class="winner-rank-title">Best</span>&nbsp;&nbsp;<?php echo $result['best'] ?><br />
                                        <?php if ($result['average']): ?>
                                            <span class="winner-subrecord">
                                                <?php foreach($result['subrecord'] as $subrecord):?>
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
                <?php endforeach ?>
            </div>
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

