<div data-role="header" data-position="fixed" data-theme="a" data-tap-toggle="false">
    <?php if ($index): ?>
        <?php echo link_to('information', 'information/index', array('data-iconpos' => 'notext', 'data-icon' => 'info', 'class' => 'ui-btn-left')) ?>
    <?php endif; ?>
    <h3>
        <?php echo $title ?>
    </h3>
</div>
