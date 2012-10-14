/**
 * average記録のない時ボタンを隠す
 */
$(document).ready(function(){
   $('#event').change(function() {
       if($(this).val() == '333bf'||$(this).val() == '333fm'||$(this).val() == '444bf'||$(this).val() == '555bf'||$(this).val() == '333mbf'){
          $('.average').button('disable');
       } else {
          $('.average').button('enable');
       }
   });
});

/**
 * フォームのactionをsubmitボタンで分ける
 **/
$(document).ready(function(){
    $('[action]').click(function(){
        if($(this).attr('action') != ""){
            $('form').attr('action', $(this).attr('action'));
        }
    });
});

/**
 * ページアニメーションを無効化する
 */
$(document).bind('mobileinit', function(){
    $.mobile.defaultPageTransition = 'none';
});
