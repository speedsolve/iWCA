<div id="information_index" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => 'Information')) ?>
    <div data-role="content">
        <ul data-role="listview" data-inset="true" class="ui-listview">
            <li>
                <span class="information_subtitle">Last&nbsp;Updated</span><?php echo $updated ?>
            </li>
        </ul>
        <ul data-role="listview" data-inset="true" class="ui-listview">
            <li>
                <a href="http://www.facebook.com/speedsolve">
                    <?php echo image_tag('facebook.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:8px;left:8px;')) ?>&nbsp;Sinpei Araki<br />
                </a>
            </li>
            <li>
                <a href="http://www.twitter.com/speedsolve">
                    <?php echo image_tag('twitter.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:8px;left:8px;')) ?>&nbsp;@speedsolve<br />
                </a>
            </li>
            <li>
                <a href="http://www.youtube.com/user/Speedcuber">
                    <?php echo image_tag('youtube.png', array('class' => 'ui-li-icon', 'style' => 'max-width:28px;max-height:28px;top:8px;left:8px;')) ?>&nbsp;Speedcuber<br />
                </a>
            </li>
        </ul>
        <div align="center" class="information_copyright">
            @2012 Sinpei Araki, iWCA<br />
        </div>
    </div>
    <?php include_partial('global/footer', array('ranking_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
