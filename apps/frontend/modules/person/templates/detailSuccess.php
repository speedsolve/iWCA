<div id="page" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Person', 'isWcaPerson' => true, 'personId' => $person['id'])) ?>
    <div data-role="content">
        <ul data-role="listview" data-inset="true" class="ui-listview">
            <li>
                <?php echo image_tag('flag/' . $person['countryid'] . '.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:6px;')) ?><?php echo $person['name'] ?><br />
                <span class="id-name">
                    <?php echo $person['id'] ?>,&nbsp;
                    <?php echo $person['countryid'] ?>,&nbsp;
                    <?php if ($person['gender']): ?>
                        <?php echo $person['gender'] ?>,&nbsp;
                    <?php else: ?>
                        Unknown,&nbsp;
                    <?php endif ?>
                        Competitions&nbsp;<?php echo $competition_count ?><br />
                        <i class="fa fa-plane"></i>&nbsp;&nbsp;Distance&nbsp;<?php echo floor($distance) ?>&nbsp;km
                </span><br />
            </li>
        </ul>
        <div data-role="collapsible-set" data-theme="a" data-content-theme="a" class="ui-collapsible-set" data-inset="true">
           <?php if (count($world_podiums) > 0): ?>
               <div data-role="collapsible">
                   <h2>World Championship Podiums</h2>
                   <ul data-role="listview" data-theme="a" data-divider-theme="a">
                       <?php include_partial('global/podiums', array('podiums' => $world_podiums)) ?>
                   </ul>
               </div>
           <?php endif ?>
        </div>
        <div data-role="collapsible-set" data-theme="a" data-content-theme="a" class="ui-collapsible-set" data-inset="true">
           <?php if (count($euro_podiums) > 0): ?>
               <div data-role="collapsible">
                   <h2>European Championship Podiums</h2>
                   <ul data-role="listview" data-theme="a" data-divider-theme="a">
                       <?php include_partial('global/podiums', array('podiums' => $euro_podiums)) ?>
                   </ul>
               </div>
           <?php endif ?>
        </div>
        <div data-role="collapsible-set" data-theme="a" data-content-theme="a" class="ui-collapsible-set" data-inset="true">
           <?php if (count($asian_podiums) > 0): ?>
               <div data-role="collapsible">
                   <h2>Asian Championship Podiums</h2>
                   <ul data-role="listview" data-theme="a" data-divider-theme="a">
                       <?php include_partial('global/podiums', array('podiums' => $asian_podiums)) ?>
                   </ul>
               </div>
           <?php endif ?>
        </div>
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
        <?php if (isset($prizes)): ?>
            <ul data-role="listview" data-inset="true" >
                <li>
                    <span class="person-prize-title"><i class="fa fa-trophy"></i>&nbsp;&nbsp;Prizes</span><br />
                    <?php foreach ($prizes as $pos => $count): ?>
                        <?php if ($pos == 1): ?>
                            <span class="person-1st">Gold</span>&nbsp;&nbsp;<?php echo $count ?>&nbsp;
                        <?php elseif ($pos == 2): ?>
                            <span class="person-2nd">Silver</span>&nbsp;&nbsp;<?php echo $count ?>&nbsp;
                        <?php elseif ($pos == 3): ?>
                            <span class="person-3rd">Bronze</span>&nbsp;&nbsp;<?php echo $count ?>&nbsp;
                        <?php endif ?>
                    <?php endforeach ?>
                </li>
            </ul>
        <?php endif ?>
        <ul data-role="listview" data-inset="true" class="ui-listview">
            <?php foreach (sfConfig::get('app_event_id') as $event => $value): ?>
                <?php if (isset($singles[$event])): ?>
                    <li>
                        <a href="<?php echo url_for('person/results?id='.$person['id'].'&eventId='.$event) ?>" class="ui-link-inherit">
                            <span class="person-event-name"><?php echo $value['cellname'] ?></span><br />
                            <table class="person-rank-table">
                                <tr>
                                    <td>
                                    </td>
                                    <td class="person-rank-table-title-time">
                                        Time
                                    </td>
                                    <td class="person-rank-table-title-rank">
                                        WR
                                    </td>
                                    <td class="person-rank-table-title-rank">
                                        CR
                                    </td>
                                    <td class="person-rank-table-title-rank">
                                        NR
                                    </td>
                                </tr>
                                <tr>
                                    <td class="person-rank-format-name">
                                        Single
                                    </td>
                                    <td class="person-rank-best">
                                        <?php echo $singles[$event]['best'] ?>
                                    </td>
                                    <?php if (!in_array($event,  sfConfig::get('app_event_abolition'))): ?>
                                        <td class="person-place">
                                            <?php echo $single_ranks[$event]['worldrank'] ?>
                                        </td>
                                        <td class="person-place">
                                            <?php echo $single_ranks[$event]['continentrank'] ?>
                                        </td>
                                        <td class="person-place">
                                            <?php echo $single_ranks[$event]['countryrank'] ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php if (isset($averages[$event])): ?>
                                    <tr>
                                        <td class="person-rank-format-name">
                                            Average
                                        </td>
                                        <td class="person-rank-average">
                                            <?php echo $averages[$event]['average'] ?>
                                        </td>
                                        <?php if (!in_array($event,  sfConfig::get('app_event_abolition'))): ?>
                                            <td class="person-place">
                                                <?php echo $average_ranks[$event]['worldrank'] ?>
                                            </td>
                                            <td class="person-place">
                                                <?php echo $average_ranks[$event]['continentrank'] ?>
                                            </td>
                                            <td class="person-place">
                                                <?php echo $average_ranks[$event]['countryrank'] ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endif ?>
                            </table>
                        </a>
                    </li>
                <?php endif ?>
            <?php endforeach ?>
        </ul>
    </div>
    <?php include_partial('global/footer', array('person_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
