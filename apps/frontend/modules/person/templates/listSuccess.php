<div id="page" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Person')) ?>
    <div data-role="content">
        <div class="content-primary">
            <ul data-role="listview">
                <?php foreach($results as $result): ?>
                    <li>
                        <a href="<?php echo url_for('person/detail?id='.$result['id']) ?>" class="ui-link-inherit">
                            <?php echo $result['name'] ?><?php echo image_tag('flag/' . $result['countryid'] . '@2x.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:5px;left:5px;')) ?><br />
                            <span class="id-name">
                                <?php echo $result['id'] ?>, &nbsp;<?php echo $result['countryid'] ?>,&nbsp;
                                <?php if ($result['gender']): ?>
                                    <?php echo $result['gender'] ?>
                                <?php else: ?>
                                    Unknown
                               <?php endif ?>
                           </span><br />
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php include_partial('global/footer', array('person_class' => 'ui-btn-active ui-state-persist')) ?>
</div>

