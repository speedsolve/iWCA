<div id="page" data-role="page"  data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Competition')) ?>
    <div data-role="content">
        <ul data-role="listview" data-theme="a" data-divider-theme="a">
            <?php foreach (sfConfig::get('app_round_reverse_id') as $roundid => $value): ?>
                <?php if (isset($competition_results[$eventId][$value['name']])): ?>
                    <li data-role="list-divider">
                        <?php echo $value['name'] ?>
                    </li>
                <?php endif ?>
                <?php foreach($competition_results[$eventId][$value['name']] as $id => $result): ?>
                    <li>
                        <a href="<?php echo url_for('person/detail?id='.$result['personid']) ?>" class="ui-link-inherit">
                            <?php echo $result['pos'] ?>.&nbsp;<?php echo image_tag('flag/' . $result['personcountryid'] . '@2x.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:5px;')) ?>&nbsp;<?php echo $result['personname'] ?><br />
                            <?php if ($result['average']): ?>
                                <span class="results-rank-title">Average</span>&nbsp;&nbsp;<?php echo $result['average'] ?>&nbsp;
                            <?php endif ?>
                            <span class="results-rank-title">Best</span>&nbsp;&nbsp;<?php echo $result['best'] ?><br />
                            <span class="results-subrecord">
                                <?php foreach($result['subrecord'] as $subrecord):?>
                                    <?php echo $subrecord ?>&nbsp;
                                <?php endforeach; ?>
                            </span><br />
                        </a>
                    </li>
                <?php endforeach ?>
            <?php endforeach ?>
        </ul>
    </div>
    <?php include_partial('global/footer', array('competition_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
