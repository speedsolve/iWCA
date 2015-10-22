<div data-role="footer" data-id="footer" data-position="fixed" data-tap-toggle="false">
    <div data-role="navbar">
        <ul>
          <li><?php echo link_to('<i class="fa fa-signal"></i>&nbsp;&nbsp;Ranking', 'ranking/index',     array('class' => $ranking_class)) ?></li>
          <li><?php echo link_to('<i class="fa fa-trophy"></i>&nbsp;&nbsp;Record',  'record/index',      array('class' => $record_class)) ?></li>
          <li><?php echo link_to('<i class="fa fa-globe"></i>&nbsp;&nbsp;Comps',   'competition/index', array('class' => $competition_class)) ?></li>
          <li><?php echo link_to('<i class="fa fa-user"></i>&nbsp;&nbsp;Person',  'person/index',      array('class' => $person_class)) ?></li>
        </ul>
    </div>
</div>
