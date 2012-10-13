// Google Analytics設定
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-35513474-1']);

$(document).bind('mobileinit', function(){

    // ページトラッキング
    $(':jqmData(role="page")').live('pageshow', function (event, ui) {
        _gaq.push(['_trackPageview', $.mobile.activePage.jqmData('url')]);
    });
}

// Google Analytics読み込み
$(document).ready(function(){
    var ga = document.createElement('script'); ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
});
