<div data-role="footer" data-id="footer" data-position="fixed" data-tap-toggle="false">

    <script type="text/javascript"><!--
        google_ad_client = "ca-pub-3051896224981468";
        /* iWCA */
        google_ad_slot = "5369636483";
        google_ad_width = 320;
        google_ad_height = 50;
        //-->
    </script>
    <script type="text/javascript" src="//pagead2.googlesyndication.com/pagead/show_ads.js"></script>

    <div data-role="navbar">
        <ul>
          <li><?php echo link_to('Ranking', 'ranking/index',     array('class' => $ranking_class)) ?></li>
          <li><?php echo link_to('Record',  'record/index',      array('class' => $record_class)) ?></li>
          <li><?php echo link_to('Comps',   'competition/index', array('class' => $competition_class)) ?></li>
          <li><?php echo link_to('Person',  'person/index',      array('class' => $person_class)) ?></li>
        </ul>
    </div>
</div>
