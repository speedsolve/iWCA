<div data-role="footer" data-id="footer" data-position="fixed" data-tap-toggle="false">
    <div data-role="navbar">
        <ul>
          <li><?php echo link_to('Ranking', 'ranking/index',     array('class' => $ranking_class)) ?></li>
          <li><?php echo link_to('Record',  'record/index',      array('class' => $record_class)) ?></li>
          <li><?php echo link_to('Comps',   'competition/index', array('class' => $competition_class)) ?></li>
          <li><?php echo link_to('Person',  'person/index',      array('class' => $person_class)) ?></li>
          <li><?php echo link_to('Live',    'live/list',         array('class' => $live_class)) ?></li>
        </ul>
    </div>
</div>
