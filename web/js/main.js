/**
 * All
 */
$(document).bind('mobileinit', function(){
    /* ページアニメーションを無効化する */
    $.mobile.defaultPageTransition = 'none';
    /* アドレスバーを隠す */
    window.onload = function() { setTimeout(scrollTo, 100, 0, 1); }
});

$(document).delegate('#ranking_index', 'pageinit', function(){
    /**
     * average記録のない時ボタンを無効にする
     */
    $('#event_ranking').change(function() {
        if($(this).val() == '444bf'||$(this).val() == '555bf'||$(this).val() == '333mbf'||$('#misc_ranking').val() == 'prize'){
           $('.average').button('disable');
        } else {
           $('.average').button('enable');
        }
    });

    /**
     * フォームのactionをsubmitボタンで分ける
     **/
    $('[action]').click(function(){
        if($(this).attr('action') != ""){
            $('form').attr('action', $(this).attr('action'));
        }
    });
});

$(document).delegate('#ranking_index', 'pageinit', function(){
    /**
     * average記録のない時ボタンを無効にする
     */
    $('#misc_ranking').change(function() {
        if($(this).val() == 'prize'){
           $('.average').button('disable');
           $('.result').checkboxradio('disable');
           $('.region').checkboxradio('disable');
        } else if($(this).val() == 'rank'){
           $('.average').button('enable');
           $('#event_ranking').selectmenu('disable');
           $('#year_ranking').selectmenu('disable');
           $('.result').checkboxradio('disable');
           $('.region').checkboxradio('disable');
        } else {
           $('.average').button('enable');
           $('#event_ranking').selectmenu('enable');
           $('#year_ranking').selectmenu('enable');
           $('.result').checkboxradio('enable');
           $('.region').checkboxradio('enable');
        }
    });

    /**
     * フォームのactionをsubmitボタンで分ける
     **/
    $('[action]').click(function(){
        if($(this).attr('action') != ""){
            $('form').attr('action', $(this).attr('action'));
        }
    });
});

$(document).delegate('#record_index', 'pageinit', function(){
    /**
     * average記録のない時ボタンを無効にする
     */
    $('#event_record').change(function() {
        if($(this).val() == '444bf'||$(this).val() == '555bf'||$(this).val() == '333mbf'){
           $('.average').button('disable');
        } else {
           $('.average').button('enable');
        }
    });

    /**
     * フォームのactionをsubmitボタンで分ける
     **/
    $('[action]').click(function(){
        if($(this).attr('action') != ""){
            $('form').attr('action', $(this).attr('action'));
        }
    });
});

// $(document).delegate('#person_index', 'pageinit', function(){
// });
