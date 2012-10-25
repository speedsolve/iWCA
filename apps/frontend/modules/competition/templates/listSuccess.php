<div id="page" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Competition')) ?>
    <div data-role="content">
        <ul data-role="listview" data-theme="a" data-dividertheme="b">
            <?php foreach($results as $result): ?>
                <li>
                    <a href="<?php echo url_for('competition/detail?competitionId='.$result['id']) ?>" class="ui-link-inherit">
                        <?php if ($result['day'] == $result['endday']): ?>
                            <?php echo $result['year'].'/'.$result['month'].'/'.$result['day'] ?><br />
                        <?php else: ?>
                            <?php echo $result['year'].'/'.$result['month'].'/'.$result['day'] ?>&nbsp;-&nbsp;<?php echo $result['endmonth'].'/'.$result['endday'] ?><br />
                        <?php endif ?>
                        <?php echo $result['cellname'] ?><?php echo image_tag('flag/' . $result['countryid'] . '.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:5px;')) ?><br />
                        <span class="venue"><?php echo $result['cityname'].',&nbsp;'.$result['countryid'] ?></span><br />
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php include_partial('global/footer', array('competition_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
