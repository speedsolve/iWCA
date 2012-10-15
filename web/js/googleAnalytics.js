// Google Analytics設定
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-35513474-1']);

// async
(function () {
    var ga = document.createElement('script');
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
})();

// exe
$('[data-role="page"]').live('pageshow', function () {
    var u = location.hash.replace('#', '');
    u ? _gaq.push(['_trackPageview', u]) : _gaq.push(['_trackPageview']);
});
