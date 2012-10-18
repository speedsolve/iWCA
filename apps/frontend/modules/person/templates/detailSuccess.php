<div id="page" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Person')) ?>
    <div data-role="content">
        <ul data-role="listview" data-inset="true" class="ui-listview">
            <li>
                <?php echo image_tag('flag/' . $person['countryid'] . '@2x.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:6px;')) ?><?php echo $person['name'] ?><br />
                <span class="id-name"><?php echo $person['id'] ?>,&nbsp;<?php echo $person['countryid'] ?>,&nbsp;<?php echo $person['gender'] ?></span><br />
            </li>
        </ul>
        <div data-role="collapsible-set" data-theme="a" data-content-theme="a" class="ui-collapsible-set" data-inset="true">
           <?php if (isset($histories['world'])): ?>
                   <div data-role="collapsible">
                       <h2>History World Record</h2>
                       <ul data-role="listview" data-theme="a" data-divider-theme="a">
                           <?php include_partial('global/history', array('histories' => $histories['world'])) ?>
                       </ul>
                   </div>
           <?php endif ?>
           <?php if (isset($histories['continent'])): ?>
                   <div data-role="collapsible">
                       <h2>History Continent Record</h2>
                       <ul data-role="listview" data-theme="a" data-divider-theme="a">
                           <?php include_partial('global/history', array('histories' => $histories['continent'])) ?>
                       </ul>
                   </div>
           <?php endif ?>
           <?php if (isset($histories['national'])): ?>
                   <div data-role="collapsible">
                       <h2>History National Record</h2>
                       <ul data-role="listview" data-theme="a" data-divider-theme="a">
                           <?php include_partial('global/history', array('histories' => $histories['national'])) ?>
                       </ul>
                   </div>
           <?php endif ?>
        </div>
        <div data-role="collapsible-set" data-theme="a" data-content-theme="a" class="ui-collapsible-set" data-inset="true">
            <?php foreach (sfConfig::get('app_event_id') as $event => $value): ?>
                <?php if (isset($singles[$event])): ?>
                    <div data-role="collapsible">
                        <h2>
                           <span class="person-event-name"><?php echo $value['cellname'] ?></span><br />
                           <div style="margin-top:5px;">
                               <span class="person-rank-title">Single</span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $singles[$event]['best'] ?>&nbsp;
                               <span class="person-rank-title">WR&nbsp;<?php echo $single_ranks[$event]['worldrank'] ?>&nbsp;</span>
                               <span class="person-rank-title">CR&nbsp;<?php echo $single_ranks[$event]['continentrank'] ?>&nbsp;<span>
                               <span class="person-rank-title">NR&nbsp;<?php echo $single_ranks[$event]['countryrank'] ?>&nbsp;<span>
                           </div>
                           <?php if (isset($averages[$event])): ?>
                               <div style="margin-top:5px;">
                                   <span class="person-rank-title">Average</span>&nbsp;&nbsp;<?php echo $averages[$event]['average'] ?>&nbsp;
                                   <span class="person-rank-title">WR&nbsp;<?php echo $average_ranks[$event]['worldrank'] ?>&nbsp;</span>
                                   <span class="person-rank-title">CR&nbsp;<?php echo $average_ranks[$event]['continentrank'] ?>&nbsp;<span>
                                   <span class="person-rank-title">NR&nbsp;<?php echo $average_ranks[$event]['countryrank'] ?>&nbsp;<span>
                               </div>
                           <?php endif ?>
                        </h2>
                        <ul data-role="listview" data-theme="a" data-divider-theme="a">
                            <?php foreach($competitions[$event] as $competition): ?>
                                <li>
                                    <a href="<?php echo url_for('competition/detail?competitionId='.$competition[0]['competitionid']) ?>" class="ui-link-inherit">
                                        <?php foreach($competition as $key => $round): ?>
                                            <?php if ($key == 0): ?>
                                                <?php if ($round['day'] == $round['endday']): ?>
                                                    <span class="person-competition-date"><?php echo $round['year'].'/'.$round['month'].'/'.$round['day'] ?></span><br />
                                                <?php else: ?>
                                                    <span class="person-competition-date"><?php echo $round['year'].'/'.$round['month'].'/'.$round['day'] ?>&nbsp;-&nbsp;<?php echo $round['endmonth'].'/'.$round['endday'] ?></span><br />
                                                <?php endif ?>
                                                <?php echo $round['competitionname'] ?><br />
                                            <?php endif ?>
                                            <span class="person-round-title"><?php echo $round['roundid'] ?></span><br />
                                            <?php if ($round['average']): ?>
                                                <span class="person-rank-title">Average</span>&nbsp;&nbsp;<?php echo $round['average'] ?>&nbsp;
                                            <?php endif ?>
                                            <span class="person-rank-title">Best</span>&nbsp;&nbsp;<?php echo $round['best'] ?><br />
                                            <?php if ($round['average']): ?>
                                                <span class="person-subrecord">
                                                    <?php foreach($round['subrecord'] as $subrecord):?>
                                                        <?php echo $subrecord ?>&nbsp;
                                                    <?php endforeach; ?>
                                                </span><br />
                                            <?php endif ?>
                                         <?php endforeach ?>
                                     </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </div>
    <?php include_partial('global/footer', array('person_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
