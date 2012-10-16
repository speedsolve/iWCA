<div id="page" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Record')) ?>
    <div data-role="content">
        <ul data-role="listview" data-theme="a" data-dividertheme="b">
            <?php foreach($results as $result): ?>
                <li>
                    <span class="event-name"><?php echo $result['eventname'] ?></span><br />
                    <?php echo image_tag('flag/' . $result['personcountryid'] . '@2x.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:5px;')) ?><?php echo $result['personname'] ?><br />
                    <?php echo $result['best'] ?><br />
                    <span class="competition-name"><?php echo $result['competitionname'] ?></span><br />
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php include_partial('global/footer', array('record_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
