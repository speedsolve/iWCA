<div id="page" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => $name)) ?>
    <div data-role="content">
        <ul data-role="listview" data-theme="a" data-divider-theme="a">
            <?php $event = '' ?>
            <?php foreach (sfConfig::get('app_event_id') as $eventId => $event_value): ?>
                <?php foreach (sfConfig::get('app_round_reverse_id') as $roundid => $value): ?>
                    <?php if (isset($results[$eventId][$value['name']])): ?>
                        <?php if ($eventId != $event): ?>
                            <li data-role="list-divider">
                                <?php echo $event_value['name'].'&nbsp;-&nbsp;'.$results[$eventId][$value['name']][0]['formatid'] ?>
                            </li>
                            <?php $event = $eventId ?>
                        <?php endif; ?>
                    <?php endif ?>
                    <?php foreach($results[$eventId][$value['name']] as $id => $result): ?>
                        <li>
                            <a href="<?php echo url_for('person/detail?id='.$result['personid']) ?>" class="ui-link-inherit">
                               <div class="personal-round"><?php echo $value['name'] ?></div>
                                <?php echo $result['pos'] ?>.&nbsp;<?php echo image_tag('flag/' . $result['personcountryid'] . '.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:5px;')) ?><?php echo $result['personname'] ?><br />
                                <?php if ($result['average']): ?>
                                    <span class="results-rank-title">Average</span>&nbsp;<?php include_partial('global/title_record', array('result' => $result, 'type' => 'average')) ?>&nbsp;<span class="results-time"><?php echo $result['average'] ?></span>&nbsp;
                                <?php endif ?>
                                <span class="results-rank-title">Best</span>&nbsp;<?php include_partial('global/title_record', array('result' => $result, 'type' => 'single')) ?>&nbsp;<span class="results-time"><?php echo $result['best'] ?></span><br />
                                <span class="results-subrecord">
                                    <?php foreach($result['subrecord'] as $subrecord):?>
                                        <?php echo $subrecord ?>&nbsp;
                                    <?php endforeach; ?>
                                </span><br />
                            </a>
                        </li>
                    <?php endforeach ?>
                <?php endforeach ?>
            <?php endforeach ?>
        </ul>
    </div>
    <?php include_partial('global/footer', array('competition_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
