<div id="map_page" data-add-back-btn=”true” data-role="page" data-theme="a">
    <?php include_partial('global/header', array('title' => 'Competition')) ?>
    <div id="map" data-role="content">
        <script type="text/javascript">
            function mapCanvas() {
              var latlng = new google.maps.LatLng(<?php echo $latitude ?>,<?php echo $longitude ?>);
              var myOptions = {
                  zoom: 12,
                  center: latlng,
                  mapTypeControl: false,
                  navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
                  mapTypeId: google.maps.MapTypeId.ROADMAP
              };
              var map = new google.maps.Map(document.getElementById("map"), myOptions);
              var marker = new google.maps.Marker({
                  position: latlng,
                  map: map,
              });

            }
            function height() {
              var pageHeight = $(document).height();
              $("#map").css("height",pageHeight);
            }

            $('#map_page').bind('pageshow',height);
            $('#map_page').bind('pageshow',mapCanvas);
        </script>
    </div>
    <?php include_partial('global/footer', array('competition_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
