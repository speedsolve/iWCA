<div id="page" data-role="page"  data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Competition')) ?>
    <div data-role="content">
        <ul data-role="listview" data-inset="true" class="ui-listview">
            <li>
                <?php echo image_tag('flag/' . $results['countryid'] . '@2x.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:6px;')) ?><?php echo $results['name'] ?><br />
                <?php if ($results['day'] == $results['endday']): ?>
                    <span class="competition-detail-date"><?php echo $results['year'].'/'.$results['month'].'/'.$results['day'] ?></span><br />
                <?php else: ?>
                    <span class="competition-detail-date"><?php echo $results['year'].'/'.$results['month'].'/'.$results['day'] ?>&nbsp;-&nbsp;<?php echo $results['endmonth'].'/'.$results['endday'] ?></span><br />
                <?php endif ?>
            </li>
        </ul>
        <ul data-role="listview" data-inset="true" class="ui-listview">
            <li>
                <a href="<?php echo url_for('competition/map?latitude=' . $latitude . '&longitude=' . $longitude) ?>">
                    <?php echo $results['cityname'].',&nbsp;'.$results['countryid'] ?><br />
                </a>
            </li>
        </ul>
        <div data-role="collapsible-set" data-theme="a" data-content-theme="a" class="ui-collapsible-set" data-inset="true">
            <div data-role="collapsible">
                <h2>Winners</h2>
                <ul data-role="listview" data-theme="a" data-divider-theme="a">
                </ul>
            </div>
        </div>
        <div data-role="collapsible-set" data-theme="a" data-content-theme="a" class="ui-collapsible-set" data-inset="true">
            <?php foreach ($events as $key => $event): ?>
            <div data-role="collapsible">
                <h2>
                   <?php echo $event ?><br />
                </h2>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    <?php include_partial('global/footer', array('competition_class' => 'ui-btn-active ui-state-persist')) ?>
</div>

