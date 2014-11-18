<div id="page" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Live')) ?>
    <div data-role="content">
        <ul data-role="listview" data-theme="a" data-divider-theme="a">
            <?php foreach($past_list['past'] as $key => $list): ?>
                <li>
                    <a href="<?php echo url_for('live/event?competitionId='.$list['id']) ?>" class="ui-link-inherit">
                        <?php echo $list['name'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php include_partial('global/footer', array('live_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
