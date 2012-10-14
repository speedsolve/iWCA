<div data-role="page" data-add-back-btn=”true”>
    <?php include_partial('global/header', array('title' => 'Ranking')) ?>
    <div data-role="content">
        <ul data-role="listview" data-theme="a" data-dividertheme="b">
            <?php foreach($results as $result): ?>
                <li>
                    <?php echo $result['rank'] ?>.&nbsp;<?php echo image_tag('flag/' . $result['personcountryid'] . '@2x.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:5px;')) ?>&nbsp;<?php echo $result['personname'] ?><br />
                    <?php echo $result['record'] ?><br />
                    <span class="subrecord">
                        <?php foreach($result['subrecord'] as $subrecord):?>
                            <?php echo $subrecord ?>&nbsp;
                        <?php endforeach; ?>
                    </span><br />
                    <span class="competition-name"><?php echo $result['competitionname'] ?></span><br />
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php include_partial('global/footer',  array('ranking_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
