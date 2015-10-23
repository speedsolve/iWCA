<div id="page" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Competition', 'isWcaCompetition' => true, 'competitionId' => $competition['id'])) ?>
    <div data-role="content">
        <ul data-role="listview" data-inset="true" class="ui-listview">
            <li>
                <?php echo image_tag('flag/' . CompetitionsService::getChangeCountryId($competition['countryid'],  $competition['continentid']) . '.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:6px;')) ?><?php echo $competition['name'] ?><br />
                <?php if ($competition['day'] == $competition['endday']): ?>
                    <span class="competition-detail-date"><?php echo $competition['year'].'/'.$competition['month'].'/'.$competition['day'] ?></span><br />
                <?php else: ?>
                    <span class="competition-detail-date"><?php echo $competition['year'].'/'.$competition['month'].'/'.$competition['day'] ?>&nbsp;-&nbsp;<?php echo $competition['endmonth'].'/'.$competition['endday'] ?></span><br />
                <?php endif ?>
                <?php if ($competitorNumber > 0): ?>
                    <span class="competition-detail-number"><i class="fa fa-male"></i>&nbsp;&nbsp;<?php echo $competitorNumber ?>&nbsp;Competitors</span>
                <?php endif ?>
            </li>
        </ul>
        <ul data-role="listview" data-inset="true" class="ui-listview">
            <li>
                <a href="<?php echo url_for('competition/map?competitionId='.$competition['id']) ?>">
                    <i class="fa fa-map-marker"></i>&nbsp;&nbsp;<?php echo $competition['cityname'].',&nbsp;'.$competition['countryid'] ?><br />
                </a>
            </li>
            <?php if ($website): ?>
                <li>
                    <?php if (is_object($website)): ?>
                       <a href="<?php echo $website['path'][0] ?>"><?php echo $website['string'][0] ?></a>
                    <?php else: ?>
                       <?php if (preg_match('/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$, %#]+)$/', $website)): ?>
                           <a href="<?php echo $website ?>"><?php echo $website ?></a>
                       <?php else: ?>
                           <?php echo $website ?>
                       <?php endif ?>
                    <?php endif ?>
                </li>
            <?php endif ?>
            <?php if ($venue): ?>
                <li>
                    <?php if (is_object($venue)): ?>
                       <a href="<?php echo $venue['path'][0] ?>"><?php echo $venue['string'][0] ?><br />
                           <?php if ($competition['venuedetails']): ?>
                               <span class="competition-detail-venue"><?php echo $competition['venuedetails'] ?></span><br />
                           <?php endif ?>
                           <?php if ($competition['venueaddress']): ?>
                               <span class="competition-detail-venue"><?php echo $competition['venueaddress'] ?></span><br />
                           <?php endif ?>
                       </a>
                    <?php else: ?>
                       <?php echo $venue ?><br />
                       <?php if ($competition['venuedetails']): ?>
                           <span class="competition-detail-venue"><?php echo $competition['venuedetails'] ?></span><br />
                       <?php endif ?>
                       <?php if ($competition['venueaddress']): ?>
                           <span class="competition-detail-venue"><?php echo $competition['venueaddress'] ?></span><br />
                       <?php endif ?>
                    <?php endif ?>
                </li>
            <?php endif ?>
        </ul>
        <?php if ($end): ?>
            <div data-role="collapsible-set" data-theme="a" data-content-theme="a" class="ui-collapsible-set" data-inset="true">
                <div data-role="collapsible">
                    <h2><i class="fa fa-trophy"></i>&nbsp;&nbsp;Winners</h2>
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

        <?php if ($wcadelegates): ?>
            <ul data-role="listview" data-inset="true" class="ui-listview">
                <?php $name = '' ?>
                <?php foreach ($wcadelegates['string'] as $key => $string): ?>
                    <?php if ($name != $string): ?>
                        <li>
                            <?php if (isset($wcadelegates['path'][$key])): ?>
                                <a href="<?php echo $wcadelegates['path'][$key] ?>">
                                    <i class="fa fa-envelope"></i>&nbsp;&nbsp;<?php echo $string ?>
                                </a>
                            <?php else: ?>
                                <?php echo $string ?>
                            <?php endif ?>
                        </li>
                    <?php endif; ?>
                    <?php $name = $string ?>
                <?php endforeach ?>
            </ul>

        <?php endif ?>
    </div>
    <?php include_partial('global/footer', array('competition_class' => 'ui-btn-active ui-state-persist')) ?>
</div>

