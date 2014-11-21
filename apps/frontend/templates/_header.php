<div data-role="header" data-position="fixed" data-theme="a" data-tap-toggle="false">
    <?php if ($index): ?>
        <?php echo link_to('information', 'information/index', array('data-iconpos' => 'notext', 'data-icon' => 'info', 'class' => 'ui-btn-left')) ?>
    <?php endif; ?>
    <?php if ($isScramble): ?>
        <?php echo link_to('scramble', 'competition/scrambles?competitionId='.$competitionId.'&eventId='.$eventId, array('data-role' => 'button', 'class' => 'ui-btn-right')) ?>
    <?php elseif ($isLive): ?>
        <?php echo link_to('Live', 'live/list', array('data-role' => 'button', 'data-icon' => 'star', 'class' => 'ui-btn-right')) ?>
    <?php endif; ?>
    <h3>
        <?php echo $title ?>
    </h3>
</div>
