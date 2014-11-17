<div id="page" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Live')) ?>
    <div data-role="content">
        <ul data-role="listview" data-theme="a" data-divider-theme="a">
            <?php foreach($live_list as $key => $some_list): ?>
                <li data-role="list-divider">
                    <?php if ($key == "in_progress"): ?>
                        In Progress
                    <?php elseif ($key == "past"): ?>
                        Past
                    <?php elseif ($key == "upcoming"): ?>
                        Upcoming
                    <?php endif;?>
                </li>
                <?php if (count($some_list) > 0): ?>
                    <?php foreach($some_list as $list): ?>
                        <li>
                            <a href="<?php echo url_for('live/event?competitionId='.$list['id']) ?>" class="ui-link-inherit">
                                <?php echo $list['name'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php include_partial('global/footer', array('live_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
