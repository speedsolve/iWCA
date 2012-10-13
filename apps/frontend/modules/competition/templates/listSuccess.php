<div data-role="page">
    <?php include_partial('global/header', array('title' => 'Competition')) ?>
    <div data-role="content">
        <ul data-role="listview" data-theme="a" data-dividertheme="b">
            <?php foreach($results as $result): ?>
                <li>
                    <?php echo $result['year'].'/'.$result['month'].'/'.$result['day'] ?> -  <?php echo $result['endmonth'].'/'.$result['endday'] ?><br />
                    <?php echo $result['cellname'] ?><?php echo image_tag('flag/' . $result['countryid'] . '@2x.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:5px;')) ?><br />
                    <span class="venue"><?php echo $result['cityname'].',&nbsp;'.$result['countryid'] ?></span><br />
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php include_partial('global/footer', array('competition_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
