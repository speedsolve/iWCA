<div id="page" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => $name)) ?>
    <div data-role="content">
        <div data-role="collapsible-set" data-theme="a" data-content-theme="a" class="ui-collapsible-set" data-inset="true">
            <?php foreach($event_list as $lists): ?>
                <div data-role="collapsible">
                    <h2><?php echo $lists['name'] ?></h2>
                    <ul data-role="listview" data-theme="a" data-divider-theme="a">
                        <?php foreach($lists['rounds'] as $list): ?>
                            <li>
                                <a href="<?php echo url_for('live/detail?competitionId='.$list['competition_id'].'&eventId='.$list['event_id'].'&id='.$list['id']) ?>" class="ui-link-inherit">
                                    <?php echo $list['name'] ?><br />
                                    <?php if ($list['live'] == true): ?>
                                        <span class="ui-li-count">Live!</span>
                                    <?php elseif ($list['live'] == false): ?>
                                        <span class="ui-li-count">Done!</span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <?php include_partial('global/footer', array('live_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
