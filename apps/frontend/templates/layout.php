<!DOCTYPE html>
<html xml:lang="en" lang="ja">
    <head>
        <meta name="viewport" content="initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="white">
        <meta name="format-detection" content="telephone=no">
        <link rel="apple-touch-icon" href="images/ios_icon.png"/>
        <link rel="apple-touch-startup-image" href="images/ios_startup.png" />
        <?php include_title() ?>
        <?php include_metas() ?>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <?php include_javascripts() ?>
        <?php use_stylesheet('http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css') ?>
        <?php include_stylesheets() ?>
    </head>
    <body>
        <?php echo $sf_content ?>
    </body>
</html>
