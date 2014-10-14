<div id="page" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Person')) ?>
    <div data-role="content">
        <ul data-role="listview" data-inset="true" class="ui-listview">
            <li>
                <?php echo image_tag('flag/' . $person['countryid'] . '.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:6px;')) ?><?php echo $person['name'] ?><br />
                <span class="id-name">
                    <?php echo $person['id'] ?>,&nbsp;<?php echo $person['countryid'] ?>,&nbsp;
                    <?php if ($person['gender']): ?>
                        <?php echo $person['gender'] ?>,&nbsp;
                    <?php else: ?>
                        Unknown,&nbsp;
                    <?php endif ?>
                        Competitions&nbsp;<?php echo $competition_count ?>
                </span><br />
            </li>
        </ul>
        <div data-role="collapsible-set" data-theme="a" data-content-theme="a" class="ui-collapsible-set" data-inset="true">
           <?php if (isset($histories['world'])): ?>
                   <div data-role="collapsible">
                       <h2>History World Record</h2>
                       <ul data-role="listview" data-theme="a" data-divider-theme="a">
                           <?php include_partial('global/history', array('target' => 'WR', 'histories' => $histories['world'])) ?>
                       </ul>
                   </div>
           <?php endif ?>
           <?php if (isset($histories['continent'])): ?>
                   <div data-role="collapsible">
                       <h2>History Continent Record</h2>
                       <ul data-role="listview" data-theme="a" data-divider-theme="a">
                           <?php include_partial('global/history', array('target' => sfConfig::get('app_record_id'), 'histories' => $histories['continent'])) ?>
                       </ul>
                   </div>
           <?php endif ?>
           <?php if (isset($histories['national'])): ?>
                   <div data-role="collapsible">
                       <h2>History National Record</h2>
                       <ul data-role="listview" data-theme="a" data-divider-theme="a">
                           <?php include_partial('global/history', array('target' => 'NR', 'histories' => $histories['national'])) ?>
                       </ul>
                   </div>
           <?php endif ?>
        </div>
        <ul data-role="listview" data-theme="a" data-inset="true" class="ui-listview">
            <?php foreach (sfConfig::get('app_event_id') as $event => $value): ?>
                <?php if (isset($singles[$event])): ?>
                    <li>
                        <a href="<?php echo url_for('person/results?id='.$person['id'].'&eventId='.$event) ?>" class="ui-link-inherit">
                            <span class="person-event-name"><?php echo $value['cellname'] ?></span><br />
                            <span style="margin-top:5px;">
                                <span class="person-rank-title">Single</span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $singles[$event]['best'] ?>&nbsp;
                                <span class="person-rank-title">WR&nbsp;<?php echo $single_ranks[$event]['worldrank'] ?>&nbsp;</span>
                                <span class="person-rank-title">CR&nbsp;<?php echo $single_ranks[$event]['continentrank'] ?>&nbsp;</span>
                                <span class="person-rank-title">NR&nbsp;<?php echo $single_ranks[$event]['countryrank'] ?>&nbsp;</span>
                            </span><br />
                            <?php if (isset($averages[$event])): ?>
                                <span style="margin-top:5px;">
                                    <span class="person-rank-title">Average</span>&nbsp;&nbsp;<?php echo $averages[$event]['average'] ?>&nbsp;
                                    <span class="person-rank-title">WR&nbsp;<?php echo $average_ranks[$event]['worldrank'] ?>&nbsp;</span>
                                    <span class="person-rank-title">CR&nbsp;<?php echo $average_ranks[$event]['continentrank'] ?>&nbsp;</span>
                                    <span class="person-rank-title">NR&nbsp;<?php echo $average_ranks[$event]['countryrank'] ?>&nbsp;</span>
                                </span>
                            <?php endif ?>
                        </a>
                    </li>
                <?php endif ?>
            <?php endforeach ?>
        </ul>
    </div>
    <?php include_partial('global/footer', array('person_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
